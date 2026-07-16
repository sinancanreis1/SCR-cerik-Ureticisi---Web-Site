<x-filament::widget>
    <style>
        .custom-dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-top: 1rem;
        }
        .custom-dashboard-card {
            position: relative;
            display: block;
            background-color: #ffffff;
            border-radius: 1.5rem;
            padding: 2rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            border: 1px solid #f3f4f6;
            overflow: hidden;
            text-decoration: none;
        }
        .dark .custom-dashboard-card {
            background-color: #1f2937;
            border-color: #374151;
        }
        .custom-dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04);
        }
        .custom-icon-wrapper {
            width: 4rem;
            height: 4rem;
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            transition: transform 0.3s ease;
        }
        .custom-dashboard-card:hover .custom-icon-wrapper {
            transform: scale(1.1);
        }
        .custom-icon-wrapper svg {
            width: 2rem;
            height: 2rem;
        }
        .custom-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: 0.75rem;
        }
        .dark .custom-title {
            color: #ffffff;
        }
        .custom-description {
            color: #6b7280;
            font-size: 0.875rem;
            line-height: 1.5;
        }
        .dark .custom-description {
            color: #9ca3af;
        }
        
        /* Renkler */
        .card-blue .custom-icon-wrapper { background-color: #e0f2fe; color: #0284c7; }
        .dark .card-blue .custom-icon-wrapper { background-color: rgba(2, 132, 199, 0.2); }
        .card-indigo .custom-icon-wrapper { background-color: #e0e7ff; color: #4f46e5; }
        .dark .card-indigo .custom-icon-wrapper { background-color: rgba(79, 70, 229, 0.2); }
        .card-purple .custom-icon-wrapper { background-color: #f3e8ff; color: #9333ea; }
        .dark .card-purple .custom-icon-wrapper { background-color: rgba(147, 51, 234, 0.2); }
        .card-emerald .custom-icon-wrapper { background-color: #d1fae5; color: #059669; }
        .dark .card-emerald .custom-icon-wrapper { background-color: rgba(5, 150, 105, 0.2); }
        .card-orange .custom-icon-wrapper { background-color: #ffedd5; color: #ea580c; }
        .dark .card-orange .custom-icon-wrapper { background-color: rgba(234, 88, 12, 0.2); }
    </style>

    <div class="custom-dashboard-grid">
        
        <!-- Ana Sayfa -->
        @if(auth()->user()?->hasRole('super_admin'))
        <a href="{{ url('admin/home-page') }}" class="custom-dashboard-card card-orange">
            <div class="custom-icon-wrapper">
                @svg('heroicon-o-home')
            </div>
            <h3 class="custom-title">Ana Sayfa</h3>
            <p class="custom-description">Ana sayfadaki işitme testi, hakkımızda özeti, avantajlarımız, adımlar, istatistikler, referanslar ve SSS gibi tüm alanları buradan yönetin.</p>
        </a>
        @endif

        <!-- Hakkımızda -->
        @if(auth()->user()?->hasRole('super_admin'))
        <a href="{{ url('admin/about-page') }}" class="custom-dashboard-card card-blue">
            <div class="custom-icon-wrapper">
                @svg('heroicon-o-building-office-2')
            </div>
            <h3 class="custom-title">Hakkımızda</h3>
            <p class="custom-description">Sitenizin kurumsal vizyon, misyon ve tanıtım yazılarını yönetin. Değerler ekleyin.</p>
        </a>
        @endif

        <!-- Ürünler -->
        @can('viewAny', App\Models\Product::class)
        <a href="{{ url('admin/products') }}" class="custom-dashboard-card card-indigo">
            <div class="custom-icon-wrapper">
                @svg('heroicon-o-shopping-bag')
            </div>
            <h3 class="custom-title">Ürünler</h3>
            <p class="custom-description">İşitme cihazı ürünlerinizi, fiyat, görsel ve detaylı özelliklerini anında güncelleyin.</p>
        </a>
        @endcan

        <!-- Hizmetlerimiz -->
        @can('viewAny', App\Models\Category::class)
        <a href="{{ url('admin/categories') }}" class="custom-dashboard-card card-purple">
            <div class="custom-icon-wrapper">
                @svg('heroicon-o-squares-2x2')
            </div>
            <h3 class="custom-title">Hizmetlerimiz</h3>
            <p class="custom-description">Sunduğunuz hizmet alanlarını ve varsa alt kategorileri organize edin.</p>
        </a>
        @endcan

        <!-- Blog -->
        @can('viewAny', App\Models\Blog::class)
        <a href="{{ url('admin/blogs') }}" class="custom-dashboard-card card-emerald">
            <div class="custom-icon-wrapper">
                @svg('heroicon-o-newspaper')
            </div>
            <h3 class="custom-title">Blog Yönetimi</h3>
            <p class="custom-description">Yeni haber, duyuru ve bilgilendirici makalelerinizi yazıp sitenizde yayınlayın.</p>
        </a>
        @endcan

        <!-- Genel Ayarlar -->
        @if(auth()->user()?->hasRole('super_admin'))
        <a href="{{ url('admin/settings-page') }}" class="custom-dashboard-card card-orange">
            <div class="custom-icon-wrapper">
                @svg('heroicon-o-cog-6-tooth')
            </div>
            <h3 class="custom-title">Genel Ayarlar</h3>
            <p class="custom-description">İletişim bilgileri, sosyal medya hesapları ve footer metinlerini ayarlayın.</p>
        </a>
        @endif

        @php
            $dynamicPages = [];
            if (\Illuminate\Support\Facades\Schema::hasTable('header_links')) {
                $dynamicPages = \App\Models\HeaderLink::where('is_dynamic_page', true)->where('is_active', true)->get();
            }
        @endphp

        @foreach($dynamicPages as $page)
        @can('viewAny', App\Models\DynamicItem::class)
        <a href="{{ \App\Filament\Resources\DynamicItems\DynamicItemResource::getUrl('index', ['tableFilters' => ['header_link_id' => ['value' => $page->id]]]) }}" class="custom-dashboard-card card-blue">
            <div class="custom-icon-wrapper">
                @svg('heroicon-o-document-duplicate')
            </div>
            <h3 class="custom-title">{{ $page->label }}</h3>
            <p class="custom-description">{{ $page->page_description ?: $page->label . ' sayfa içeriklerini yönetin.' }}</p>
        </a>
        @endcan
        @endforeach

    </div>
</x-filament::widget>
