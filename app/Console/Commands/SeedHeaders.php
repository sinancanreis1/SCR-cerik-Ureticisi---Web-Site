<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:seed-headers')]
#[Description('Command description')]
class SeedHeaders extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (\App\Models\HeaderLink::count() === 0) {
            $links = [
                ['label' => 'Ana Sayfa', 'url' => '/', 'sort_order' => 1, 'is_active' => true],
                ['label' => 'İçerikler', 'url' => '/icerikler', 'sort_order' => 2, 'is_active' => true],
                ['label' => 'Projelerim', 'url' => '/projelerim', 'sort_order' => 3, 'is_active' => true],
                ['label' => 'Hakkımda', 'url' => '/hakkimda', 'sort_order' => 4, 'is_active' => true],
                ['label' => 'İletişim', 'url' => '/iletisim', 'sort_order' => 5, 'is_active' => true],
            ];

            foreach ($links as $link) {
                \App\Models\HeaderLink::create($link);
            }
            $this->info('Header links seeded.');
        } else {
            $this->info('Already seeded.');
        }
    }
}
