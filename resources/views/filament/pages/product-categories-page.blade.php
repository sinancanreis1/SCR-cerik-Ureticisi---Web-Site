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
        
        .card-emerald .custom-icon-wrapper { background-color: #d1fae5; color: #059669; }
        .dark .card-emerald .custom-icon-wrapper { background-color: rgba(5, 150, 105, 0.2); }
        .card-orange .custom-icon-wrapper { background-color: #ffedd5; color: #ea580c; }
        .dark .card-orange .custom-icon-wrapper { background-color: rgba(234, 88, 12, 0.2); }
        .card-rose .custom-icon-wrapper { background-color: #ffe4e6; color: #e11d48; }
        .dark .card-rose .custom-icon-wrapper { background-color: rgba(225, 29, 72, 0.2); }
    </style>

    <div class="custom-dashboard-grid">
        
        <a href="{{ url('admin/products?tableFilters[category][value]=Yazılım') }}" class="custom-dashboard-card card-emerald">
            <div class="custom-icon-wrapper">
                @svg('heroicon-o-code-bracket')
            </div>
            <h3 class="custom-title">Yazılım</h3>
            <p class="custom-description">Geliştirdiğiniz yazılım projelerini, web sitelerini ve uygulamaları listeleyin.</p>
        </a>

        <a href="{{ url('admin/products?tableFilters[category][value]=Yapay Zeka') }}" class="custom-dashboard-card card-orange">
            <div class="custom-icon-wrapper">
                @svg('heroicon-o-cpu-chip')
            </div>
            <h3 class="custom-title">Yapay Zeka</h3>
            <p class="custom-description">Makine öğrenimi modelleri, yapay zeka asistanları ve veri analizi projeleriniz.</p>
        </a>

        <a href="{{ url('admin/products?tableFilters[category][value]=Tasarım') }}" class="custom-dashboard-card card-rose">
            <div class="custom-icon-wrapper">
                @svg('heroicon-o-paint-brush')
            </div>
            <h3 class="custom-title">Tasarım</h3>
            <p class="custom-description">UI/UX tasarımlarınız, kurumsal kimlik çalışmaları ve diğer kreatif projeleriniz.</p>
        </a>

    </div>
</x-filament-panels::page>
