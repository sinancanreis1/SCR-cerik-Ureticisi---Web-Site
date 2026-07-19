<x-filament::page>
    <form wire:submit.prevent="submit">
        {{ $this->form }}

        <div class="mt-8" style="padding: 24px 0 8px 0;">
            <button type="submit" style="
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 14px 36px;
                border-radius: 9999px;
                font-weight: 600;
                font-size: 15px;
                cursor: pointer;
                border: none;
                background-color: #00BCD4;
                color: #ffffff;
                transition: all 0.3s ease;
                box-shadow: 0 4px 15px rgba(0, 188, 212, 0.3);
                letter-spacing: 0.3px;
            "
            onmouseover="this.style.backgroundColor='#0097A7'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 24px rgba(0, 188, 212, 0.45)';"
            onmouseout="this.style.backgroundColor='#00BCD4'; this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(0, 188, 212, 0.3)';">
                💾 Değişiklikleri Kaydet
            </button>
        </div>
    </form>
</x-filament::page>
