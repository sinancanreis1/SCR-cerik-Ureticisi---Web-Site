<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DemoProductsSeeder extends Seeder
{
    public function run()
    {
        $demoUrl = 'https://sehirisitedemo.scrbilisim.com.tr/urunler';
        $response = Http::withoutVerifying()->get($demoUrl);
        $html = $response->body();

        // Extract JSON from data-page="app"
        preg_match('/<script data-page="app" type="application\/json">(.*?)<\/script>/s', $html, $matches);
        if (empty($matches[1])) {
            $this->command->error('Could not find data-page JSON');
            return;
        }

        $data = json_decode($matches[1], true);
        $products = $data['props']['products'] ?? [];

        if (empty($products)) {
            $this->command->error('No products found in JSON');
            return;
        }

        foreach ($products as $product) {
            $imageUrl = null;
            if (!empty($product['image'])) {
                // Download image
                $remoteImageUrl = 'https://sehirisitedemo.scrbilisim.com.tr' . $product['image'];
                $context = stream_context_create([
                    'ssl' => [
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                    ],
                ]);
                $imageContent = @file_get_contents($remoteImageUrl, false, $context);
                if ($imageContent !== false) {
                    $filename = 'products/' . basename($product['image']) . '-' . Str::random(5) . '.jpg';
                    Storage::disk('public')->put($filename, $imageContent);
                    $imageUrl = $filename;
                }
            }

            Product::updateOrCreate(
                ['slug' => $product['slug']],
                [
                    'title' => $product['title'],
                    'subtitle' => $product['subtitle'],
                    'desc' => $product['desc'],
                    'long_desc' => $product['long_desc'],
                    'icon' => $product['icon'],
                    'image' => $imageUrl,
                    'features' => $product['features'],
                ]
            );
            $this->command->info("Added: " . $product['title']);
        }
    }
}
