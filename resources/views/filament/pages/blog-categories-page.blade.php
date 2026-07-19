<x-filament-panels::page>
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
        
        .card-blue .custom-icon-wrapper { background-color: #e0f2fe; color: #0284c7; }
        .dark .card-blue .custom-icon-wrapper { background-color: rgba(2, 132, 199, 0.2); }
        .card-indigo .custom-icon-wrapper { background-color: #e0e7ff; color: #4f46e5; }
        .dark .card-indigo .custom-icon-wrapper { background-color: rgba(79, 70, 229, 0.2); }
        .card-purple .custom-icon-wrapper { background-color: #f3e8ff; color: #9333ea; }
        .dark .card-purple .custom-icon-wrapper { background-color: rgba(147, 51, 234, 0.2); }
    </style>

    <div class="custom-dashboard-grid">
        
        <a href="{{ url('admin/blogs?tableFilters[category][value]=Sektörden Notlar') }}" class="custom-dashboard-card card-blue">
            <div class="custom-icon-wrapper">
                @svg('heroicon-o-bookmark-square')
            </div>
            <h3 class="custom-title">Sektörden Notlar</h3>
            <p class="custom-description">Bilişim sektöründen son dakika notlarını, gelişmeleri ve deneyimlerinizi paylaşın.</p>
        </a>

        <a href="{{ url('admin/blogs?tableFilters[category][value]=Bilimden Notlar') }}" class="custom-dashboard-card card-indigo">
            <div class="custom-icon-wrapper">
                @svg('heroicon-o-beaker')
            </div>
            <h3 class="custom-title">Bilimden Notlar</h3>
            <p class="custom-description">Bilimsel araştırmalar, yeni teknolojiler ve bilgilendirici içeriklerinizi buradan yönetin.</p>
        </a>

        <a href="{{ url('admin/blogs?tableFilters[category][value]=Yapay Zeka') }}" class="custom-dashboard-card card-purple">
            <div class="custom-icon-wrapper">
                @svg('heroicon-o-cpu-chip')
            </div>
            <h3 class="custom-title">Yapay Zeka</h3>
            <p class="custom-description">Yapay zeka araçları, AI gelişmeleri ve makine öğrenimi hakkında içerikler ekleyin.</p>
        </a>

    </div>
</x-filament-panels::page>
