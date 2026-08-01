<div 
    x-data="{ 
        isOpen: false,
        copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                alert('İçerik panoya kopyalandı!');
            });
        },
        insertToEditor(html) {
            let editor = document.querySelector('.trix-editor');
            if (editor) {
                editor.editor.insertHTML(html);
                alert('İçerik editöre eklendi!');
                return;
            }
            let tiptap = document.querySelector('.ProseMirror');
            if (tiptap && tiptap.isContentEditable) {
                this.copyToClipboard(html); // Fallback to copy if editor insertion logic is complex
                return;
            }
            this.copyToClipboard(html);
        }
    }"
    style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;"
>
    <style>
        .cursor-ai-btn {
            position: fixed;
            bottom: 24px;
            right: 24px;
            z-index: 999999;
            background-color: #1e1e1e;
            color: #cccccc;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.5);
            border: 1px solid #3c3c3c;
            cursor: pointer;
            transition: all 0.2s;
        }
        .cursor-ai-btn:hover {
            background-color: #2d2d2d;
            border-color: #454545;
        }

        .cursor-backdrop {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999998;
        }

        .cursor-sidebar {
            position: fixed;
            top: 0; right: 0; bottom: 0;
            width: 450px;
            max-width: 100vw;
            background-color: #1e1e1e;
            color: #cccccc;
            z-index: 9999999;
            display: flex;
            flex-direction: column;
            border-left: 1px solid #3c3c3c;
            box-shadow: -5px 0 25px rgba(0,0,0,0.5);
            font-size: 13px;
        }

        .cursor-header {
            display: flex;
            flex-direction: column;
            border-bottom: 1px solid #3c3c3c;
            padding: 12px 16px;
        }
        
        .cursor-header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .cursor-tabs {
            display: flex;
            gap: 16px;
        }
        
        .cursor-tab {
            color: #858585;
            font-weight: 500;
            cursor: pointer;
            font-size: 12px;
            letter-spacing: 0.5px;
            padding-bottom: 4px;
        }
        
        .cursor-tab.active {
            color: #ffffff;
            border-bottom: 1px solid #ffffff;
        }
        
        .cursor-actions {
            display: flex;
            gap: 12px;
            color: #858585;
            align-items: center;
        }
        
        .cursor-actions svg {
            width: 16px; height: 16px;
            cursor: pointer;
        }
        
        .cursor-actions svg:hover {
            color: #cccccc;
        }

        .cursor-header-bottom {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 12px;
            color: #858585;
        }

        .cursor-header-bottom svg {
            width: 14px; height: 14px;
            cursor: pointer;
        }
        
        .cursor-header-bottom svg:hover {
            color: #cccccc;
        }

        .cursor-content {
            flex: 1;
            overflow-y: auto;
            padding: 16px;
            display: flex;
            flex-direction: column;
        }
        
        /* Scrollbar styles */
        .cursor-content::-webkit-scrollbar {
            width: 10px;
        }
        .cursor-content::-webkit-scrollbar-track {
            background: #1e1e1e;
        }
        .cursor-content::-webkit-scrollbar-thumb {
            background: #424242;
            border: 3px solid #1e1e1e;
            border-radius: 5px;
        }
        .cursor-content::-webkit-scrollbar-thumb:hover {
            background: #4f4f4f;
        }

        .cursor-tip {
            border: 1px solid #3c3c3c;
            border-radius: 6px;
            padding: 12px 14px;
            color: #cccccc;
            line-height: 1.5;
            font-size: 13px;
        }
        
        .cursor-tip strong {
            color: #4daafc;
            font-weight: normal;
        }

        /* Chat Bubbles */
        .chat-row {
            display: flex;
            width: 100%;
            margin-bottom: 20px;
        }

        .chat-row.user {
            justify-content: flex-end;
        }

        .chat-row.model {
            justify-content: flex-start;
        }

        .chat-message {
            line-height: 1.6;
            font-size: 13.5px;
        }

        .chat-message.user {
            background-color: #2b2d31;
            padding: 10px 16px;
            border-radius: 16px;
            color: #ffffff;
            max-width: 85%;
        }

        .chat-message.model {
            color: #d1d5db;
            max-width: 100%;
        }

        .chat-message.model h1, .chat-message.model h2, .chat-message.model h3 {
            color: #ffffff;
            margin-top: 12px;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .chat-message.model p {
            margin-bottom: 12px;
        }
        
        .chat-message.model ul, .chat-message.model ol {
            margin-left: 20px;
            margin-bottom: 12px;
        }

        .cursor-btn-group {
            display: flex;
            gap: 12px;
            margin-top: 8px;
            align-items: center;
            color: #858585;
        }

        .cursor-icon-btn {
            background: transparent;
            border: none;
            color: #858585;
            padding: 4px;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }
        
        .cursor-icon-btn:hover {
            color: #cccccc;
            background-color: #2d2d2d;
        }

        .model-info {
            font-size: 11px;
            color: #858585;
            margin-left: 8px;
        }

        .cursor-input-area {
            padding: 16px;
        }

        .cursor-input-box {
            background-color: #1e1e1e;
            border: 1px solid #3c3c3c;
            border-radius: 6px;
            display: flex;
            flex-direction: column;
            padding: 10px 12px;
            transition: border-color 0.2s;
        }
        
        .cursor-input-box:focus-within {
            border-color: #007acc;
        }
        
        .cursor-textarea {
            background: transparent;
            border: none;
            color: #cccccc;
            resize: none;
            font-family: inherit;
            font-size: 13.5px;
            min-height: 48px;
            max-height: 200px;
            outline: none;
            width: 100%;
        }
        
        .cursor-textarea::placeholder {
            color: #6b6b6b;
        }

        .cursor-input-footer {
            display: flex;
            justify-content: flex-end; /* Sadece gönder butonu sağda kalacak */
            align-items: center;
            margin-top: 12px;
        }

        .cursor-submit {
            background: #2d2d2d;
            border: 1px solid #3c3c3c;
            color: #cccccc;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 28px;
            border-radius: 4px;
            transition: background 0.2s;
        }
        
        .cursor-submit:hover:not(:disabled) {
            background: #3c3c3c;
            color: #ffffff;
        }
        
        .cursor-submit:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .cursor-status-bar {
            padding: 8px 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #858585;
            font-size: 11px;
            background-color: #1e1e1e;
            border-top: 1px solid #2d2d2d;
        }
        
        .cursor-status-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .cursor-status-right {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .loading-text {
            color: #4daafc;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .loading-spinner {
            animation: rotate 2s linear infinite;
            width: 14px;
            height: 14px;
        }
        
        .loading-spinner circle {
            stroke: #4daafc;
            stroke-width: 2;
            stroke-dasharray: 1, 200;
            stroke-dashoffset: 0;
            animation: dash 1.5s ease-in-out infinite;
            stroke-linecap: round;
        }
        
        @keyframes rotate {
            100% { transform: rotate(360deg); }
        }
        
        @keyframes dash {
            0% { stroke-dasharray: 1, 200; stroke-dashoffset: 0; }
            50% { stroke-dasharray: 90, 200; stroke-dashoffset: -35px; }
            100% { stroke-dasharray: 90, 200; stroke-dashoffset: -124px; }
        }
    </style>

    <!-- Floating Toggle Button -->
    <button x-show="!isOpen" x-transition.opacity @click="isOpen = true" class="cursor-ai-btn" title="Yapay Zeka">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
        </svg>
    </button>

    <!-- Backdrop -->
    <div x-show="isOpen" 
         x-transition.opacity.duration.300ms
         @click="isOpen = false" 
         class="cursor-backdrop" 
         style="display: none;">
    </div>

    <!-- Sidebar Panel -->
    <div x-show="isOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="transform translate-x-full"
         x-transition:enter-end="transform translate-x-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="transform translate-x-0"
         x-transition:leave-end="transform translate-x-full"
         class="cursor-sidebar" 
         style="display: none;">
         
        <!-- Header -->
        <div class="cursor-header">
            <div class="cursor-header-top">
                <div class="cursor-tabs">
                    <div class="cursor-tab active">SOHBET</div>
                    <div class="cursor-tab" wire:click="clear" title="Sohbeti Temizle">YENİ OTURUM</div>
                </div>
                <div class="cursor-actions">
                    <svg @click="isOpen = false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" title="Kapat"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </div>
            </div>
            
            <div class="cursor-header-bottom">
                <svg wire:click="clear" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" title="Temizle"><polyline points="23 4 23 10 17 10"></polyline><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path></svg>
            </div>
        </div>

        <!-- Content Area -->
        <div class="cursor-content" id="chat-messages-container">
            @if($errorMessage)
                <div style="background: #3f191a; color: #f87171; padding: 12px; border-radius: 6px; margin-bottom: 16px; border: 1px solid #7f1d1d;">
                    {{ $errorMessage }}
                </div>
            @endif

            @if(empty($messages) && !$isGenerating)
                <div class="cursor-tip">
                    <strong>İpucu:</strong> Gemini Yapay Zeka ile sohbet edebilir, blog yazıları, özetler veya web siteniz için içerikler üretebilirsiniz.
                </div>
            @endif

            @foreach($messages as $index => $msg)
                <div class="chat-row {{ $msg['role'] }}">
                    <div class="chat-message {{ $msg['role'] }}">
                        @if($msg['role'] === 'user')
                            {{ $msg['parts'][0]['text'] }}
                        @else
                            <!-- Model Message -->
                            {!! $msg['html'] ?? '' !!}
                            
                            <div class="cursor-btn-group">
                                <button class="cursor-icon-btn" title="Yenile (Mevcut değil)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"></path><path d="M3 3v5h5"></path></svg>
                                </button>
                                <button @click="copyToClipboard(`{{ addslashes($msg['html'] ?? '') }}`)" class="cursor-icon-btn" title="Kopyala">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                                </button>
                                <button @click="insertToEditor(`{{ addslashes($msg['html'] ?? '') }}`)" class="cursor-icon-btn" title="Editöre Aktar">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="12" y1="18" x2="12" y2="12"></line><line x1="9" y1="15" x2="15" y2="15"></line></svg>
                                </button>
                                <button class="cursor-icon-btn" title="Beğen">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path></svg>
                                </button>
                                <button class="cursor-icon-btn" title="Beğenme">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 15v4a3 3 0 0 0 3 3l4-9V2H5.72a2 2 0 0 0-2 1.7l-1.38 9a2 2 0 0 0 2 2.3zm7-13h2a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2h-2"></path></svg>
                                </button>
                                <span class="model-info">Gemini-2.5-Flash</span>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach

            <div wire:loading wire:target="generate" style="margin-top: 16px;">
                <div class="loading-text">
                    <svg class="loading-spinner" viewBox="0 0 50 50">
                        <circle cx="25" cy="25" r="20" fill="none"></circle>
                    </svg>
                    Yanıt oluşturuluyor...
                </div>
            </div>
        </div>

        <!-- Input Area -->
        <div class="cursor-input-area">
            <form wire:submit.prevent="generate">
                <div class="cursor-input-box">
                    <textarea 
                        wire:model.defer="prompt"
                        rows="2" 
                        placeholder="Bir şeyler sorun veya içerik üretmesini isteyin..."
                        class="cursor-textarea"
                        required
                        onkeydown="if(event.keyCode===13 && !event.shiftKey) { event.preventDefault(); this.form.dispatchEvent(new Event('submit', {cancelable: true, bubbles: true})); }"
                    ></textarea>
                    
                    <div class="cursor-input-footer">
                        <button type="submit" wire:loading.attr="disabled" class="cursor-submit" title="Gönder">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="19" x2="12" y2="5"></line><polyline points="5 12 12 5 19 12"></polyline></svg>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- Status Bar -->
        <div class="cursor-status-bar">
            <div class="cursor-status-left">
                <div style="display: flex; align-items: center; gap: 4px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                    Yapay Zeka
                </div>
            </div>
            
            <div class="cursor-status-right">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M8 14s1.5 2 4 2 4-2 4-2"></path><line x1="9" y1="9" x2="9.01" y2="9"></line><line x1="15" y1="9" x2="15.01" y2="9"></line></svg>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('livewire:load', function () {
        Livewire.hook('message.processed', (message, component) => {
            let container = document.getElementById('chat-messages-container');
            if (container) {
                container.scrollTop = container.scrollHeight;
            }
        });
    });
</script>

