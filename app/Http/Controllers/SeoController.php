<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Category;
use App\Models\Product;
use App\Models\Blog;
use App\Models\HeaderLink;
use App\Models\DynamicItem;

class SeoController extends Controller
{
    public function robots()
    {
        $content = "User-agent: *\n";
        $content .= "Disallow: /admin\n";
        $content .= "Disallow: /livewire\n";
        $content .= "Allow: /\n\n";
        $content .= "Sitemap: " . url('/sitemap.xml') . "\n";

        return Response::make($content, 200, ['Content-Type' => 'text/plain']);
    }

    public function llms()
    {
        $content = "# Samsun Şehir İşitme Cihazları Merkezi - LLM Dosyası\n";
        $content .= "Samsun'da uzman odyologlar eşliğinde ücretsiz işitme testi ve işitme cihazı satış ve uygulama merkezi.\n\n";
        
        $content .= "## Önemli Sayfalar\n";
        $content .= "- Ana Sayfa: " . url('/') . "\n";
        $content .= "- İletişim: " . url('/iletisim') . "\n";
        
        $links = HeaderLink::where('is_active', true)->get();
        foreach($links as $link) {
            $content .= "- " . $link->label . ": " . url(ltrim($link->url, '/')) . "\n";
        }

        return Response::make($content, 200, ['Content-Type' => 'text/plain']);
    }

    public function sitemap()
    {
        $urls = [];
        $now = now()->toAtomString();

        // Static routes
        $urls[] = ['loc' => url('/'), 'lastmod' => $now, 'priority' => '1.0'];
        $urls[] = ['loc' => url('/hakkimizda'), 'lastmod' => $now, 'priority' => '0.8'];
        $urls[] = ['loc' => url('/iletisim'), 'lastmod' => $now, 'priority' => '0.8'];
        $urls[] = ['loc' => url('/hizmetlerimiz'), 'lastmod' => $now, 'priority' => '0.8'];
        $urls[] = ['loc' => url('/urunler'), 'lastmod' => $now, 'priority' => '0.9'];
        $urls[] = ['loc' => url('/blog'), 'lastmod' => $now, 'priority' => '0.8'];

        // Dynamic Header Links (Panelden eklenen kategoriler / sayfalar)
        $headerLinks = HeaderLink::where('is_active', true)->get();
        foreach ($headerLinks as $link) {
            $urls[] = [
                'loc' => url(ltrim($link->url, '/')),
                'lastmod' => $link->updated_at->toAtomString(),
                'priority' => '0.9'
            ];
            
            // Eğer dynamic page ise, alt sayfalarını da bul
            if ($link->is_dynamic_page) {
                $items = DynamicItem::where('header_link_id', $link->id)->active()->get();
                foreach ($items as $item) {
                    $urls[] = [
                        'loc' => url(ltrim($link->url, '/') . '/' . $item->slug),
                        'lastmod' => $item->updated_at->toAtomString(),
                        'priority' => '0.8'
                    ];
                }
            }
        }

        // Generate XML
        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        // Add unique URLs to XML to avoid duplicates
        $added = [];
        foreach ($urls as $url) {
            if (!in_array($url['loc'], $added)) {
                $xml .= '<url>';
                $xml .= '<loc>' . htmlspecialchars($url['loc']) . '</loc>';
                $xml .= '<lastmod>' . $url['lastmod'] . '</lastmod>';
                $xml .= '<priority>' . $url['priority'] . '</priority>';
                $xml .= '</url>';
                $added[] = $url['loc'];
            }
        }

        $xml .= '</urlset>';

        return Response::make($xml, 200, ['Content-Type' => 'text/xml']);
    }
}
