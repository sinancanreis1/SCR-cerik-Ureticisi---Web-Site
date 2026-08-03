@extends('frontend.layouts.app')

@section('content')
<section class="breadcrumb-section pb-0" style="padding-top: 160px;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <h1 class="title mb-1">Merhaba, {{ $user->name }}</h1>
                        <p style="color: #661414; font-weight: 500; margin: 0;">
                            @if(request('tab', 'yazilar') === 'yazilar')
                                Yazılarınız ve gönderim geçmişiniz.
                            @elseif(request('tab') === 'yorumlar')
                                Yaptığınız yorumlar ve geri bildirimleriniz.
                            @elseif(request('tab') === 'profil')
                                Kişisel profil bilgilerinizi düzenleyin.
                            @endif
                        </p>
                    </div>
                    <div class="d-flex gap-2 align-items-center">
                        @if(request('tab', 'yazilar') === 'yazilar')
                            <a href="{{ route('profile.create_post') }}" class="btn px-4 py-2" style="background: #661414; color: #fff; border: none; border-radius: 50px; font-weight: 600; white-space: nowrap; display: inline-flex; align-items: center; gap: 6px;"><i class="bi bi-pencil-square"></i> Yeni Yazı Gönder</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <hr style="margin-top: 25px; border-color: #e5e7eb;">
    </div>
</section>

<section class="explore-area pt-4 pb-150">
    <div class="container">

        @if(session('success'))
            <div class="alert mb-4 p-3 rounded-3" style="background: #f0fdf4; color: #166534; border: 1px solid #bbf7d0;">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            </div>
        @endif

        {{-- Sekme 1: Yazılarım --}}
        @if(request('tab', 'yazilar') === 'yazilar')
            <div class="row" id="yazilarim">
                <div class="col-12">
                    <h3 class="mb-4" style="color: #030712; font-size: 1.2rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">Gönderdiğiniz Yazılar</h3>
                    <div class="p-4 rounded-4" style="background: #f9fafb; border: 1px solid #e5e7eb;">
                        @if($blogs->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-borderless mb-0">
                                    <thead>
                                        <tr style="border-bottom: 1px solid #e5e7eb;">
                                            <th style="color: #6b7280; font-weight: 600; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px;">Başlık</th>
                                            <th style="color: #6b7280; font-weight: 600; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px;">Durum</th>
                                            <th style="color: #6b7280; font-weight: 600; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px;">Tarih</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($blogs as $blog)
                                        <tr style="border-bottom: 1px solid #f3f4f6;">
                                            <td class="py-3">
                                                @if($blog->is_active)
                                                    <a href="{{ route('icerik.detay', $blog->slug) }}" style="color: #030712; font-weight: 500; text-decoration: none;">{{ $blog->title }}</a>
                                                @else
                                                    <span style="color: #374151; font-weight: 500;">{{ $blog->title }}</span>
                                                @endif
                                            </td>
                                            <td class="py-3">
                                                @if($blog->is_rejected)
                                                    <span style="background: #fee2e2; color: #991b1b; border-radius: 20px; padding: 4px 12px; font-size: 0.8rem; font-weight: 600;">Reddedildi</span>
                                                @elseif($blog->is_active)
                                                    <span style="background: #dcfce7; color: #166534; border-radius: 20px; padding: 4px 12px; font-size: 0.8rem; font-weight: 600;">Yayında</span>
                                                @else
                                                    <span style="background: #fef9c3; color: #854d0e; border-radius: 20px; padding: 4px 12px; font-size: 0.8rem; font-weight: 600;">Onay Bekliyor</span>
                                                @endif
                                            </td>
                                            <td class="py-3" style="color: #6b7280; font-size: 0.9rem;">{{ $blog->created_at->format('d.m.Y') }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="bi bi-file-earmark-text" style="font-size: 2.5rem; color: #d1d5db;"></i>
                                <p class="mt-3 mb-0" style="color: #9ca3af;">Henüz bir yazı göndermediniz.</p>
                                <a href="{{ route('profile.create_post') }}" class="btn btn-outline content-btn mt-3" style="font-size: 0.9rem;">İlk Yazını Gönder</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        {{-- Sekme 2: Yorumlarım --}}
        @if(request('tab') === 'yorumlar')
            <div class="row" id="yorumlarim">
                <div class="col-12">
                    <h3 class="mb-4" style="color: #030712; font-size: 1.2rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">Yaptığınız Yorumlar</h3>
                    <div class="p-4 rounded-4" style="background: #f9fafb; border: 1px solid #e5e7eb;">
                        @if($comments->count() > 0)
                            <div class="comments-list">
                                @foreach($comments as $comment)
                                    <div class="comment-item p-3 mb-3 rounded-3" style="background: #ffffff; border: 1px solid #e5e7eb; word-wrap: break-word; overflow-wrap: break-word; word-break: break-word;">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <small style="color: #6b7280; font-weight: 500;">
                                                <i class="bi bi-chat-left-text me-1" style="color: #661414;"></i> 
                                                @if($comment->commentable)
                                                    <a href="{{ route('icerik.detay', $comment->commentable->slug) }}" class="fw-bold" style="color: #661414; text-decoration: none;">{{ $comment->commentable->title }}</a>
                                                @else
                                                    Silinmiş İçerik
                                                @endif
                                                adlı yazıya yorum yaptınız:
                                            </small>
                                            <small style="color: #9ca3af;">{{ $comment->created_at->diffForHumans() }}</small>
                                        </div>
                                        <p class="mb-0" style="color: #374151; font-size: 0.95rem;">{{ $comment->content }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="bi bi-chat-left-text" style="font-size: 2.5rem; color: #d1d5db;"></i>
                                <p class="mt-3 mb-0" style="color: #9ca3af;">Henüz hiç yorum yapmadınız.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        {{-- Sekme 3: Profilimi Düzenle --}}
        @if(request('tab') === 'profil')
            <div class="row justify-content-center" id="profil-duzenle">
                <div class="col-12 text-center">
                    <h3 class="mb-4" style="color: #030712; font-size: 1.2rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">Profili Düzenle</h3>
                </div>

                <div class="col-12 col-lg-8">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        @if($errors->any())
                            <div class="alert mb-4 p-3 rounded-3" style="background: #fef2f2; color: #991b1b; border: 1px solid #f87171;">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row">
                            {{-- Avatar --}}
                            <div class="col-12 mb-5 text-center">
                                <div class="d-flex flex-column align-items-center gap-3">
                                    <div style="width: 150px; height: 150px; border-radius: 16px; overflow: hidden; background: #ffffff; border: 4px solid #ffffff; box-shadow: 0 10px 25px rgba(0,0,0,0.08); display:flex; align-items:center; justify-content:center; margin: 0 auto;">
                                        @if($user->avatar_url)
                                            <img src="{{ asset('storage/' . $user->avatar_url) }}" alt="{{ $user->name }}" style="width:100%; height:100%; object-fit:cover;">
                                        @else
                                            <span style="font-size: 3.5rem; font-weight: 700; color: #661414;">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                        @endif
                                    </div>
                                    <div style="max-width: 250px;" class="mx-auto">
                                        <input type="file" name="avatar" class="form-control form-control-sm" accept="image/*" style="font-size: 0.8rem; border-radius: 8px;">
                                        <small style="color: #9ca3af;" class="d-block mt-1">JPG, PNG veya WEBP (Maks. 2MB)</small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-6 mb-4">
                                <label class="mb-2 fw-semibold" style="color: #374151;">Ad Soyad</label>
                                <input type="text" name="name" class="form-control"
                                    style="background: #f9fafb; border: 1px solid #d1d5db; color: #111827; padding: 12px 15px; border-radius: 10px;"
                                    value="{{ old('name', $user->name) }}" required>
                            </div>

                            <div class="col-12 col-md-6 mb-4">
                                <label class="mb-2 fw-semibold" style="color: #374151;">E-Posta</label>
                                <input type="email" name="email" class="form-control"
                                    style="background: #f9fafb; border: 1px solid #d1d5db; color: #111827; padding: 12px 15px; border-radius: 10px;"
                                    value="{{ old('email', $user->email) }}" required>
                            </div>

                            <div class="col-12 col-md-6 mb-4">
                                <label class="mb-2 fw-semibold" style="color: #374151;">Yeni Şifre <small style="color:#9ca3af; font-weight:400;">(boş bırakın = değişmez)</small></label>
                                <input type="password" name="password" class="form-control"
                                    style="background: #f9fafb; border: 1px solid #d1d5db; color: #111827; padding: 12px 15px; border-radius: 10px;">
                            </div>

                            <div class="col-12 col-md-6 mb-4">
                                <label class="mb-2 fw-semibold" style="color: #374151;">Şifre Tekrar</label>
                                <input type="password" name="password_confirmation" class="form-control"
                                    style="background: #f9fafb; border: 1px solid #d1d5db; color: #111827; padding: 12px 15px; border-radius: 10px;">
                            </div>

                            <div class="col-12 col-md-6 mb-4">
                                <label class="mb-2 fw-semibold" style="color: #374151;">Unvan / Başlık</label>
                                <input type="text" name="title" class="form-control"
                                    style="background: #f9fafb; border: 1px solid #d1d5db; color: #111827; padding: 12px 15px; border-radius: 10px;"
                                    value="{{ old('title', $user->title) }}" placeholder="örn. İçerik Üreticisi">
                            </div>

                            <div class="col-12 mb-5">
                                <label class="mb-2 fw-semibold" style="color: #374151;">Kısa Biyografi</label>
                                <textarea name="description" class="form-control" rows="3"
                                    style="background: #f9fafb; border: 1px solid #d1d5db; color: #111827; padding: 12px 15px; border-radius: 10px; line-height: 1.6;"
                                    placeholder="Kendinizden kısaca bahsedin...">{{ old('description', $user->description) }}</textarea>
                            </div>

                            <div class="col-12">
                                <div class="text-center">
                                    <button type="submit" class="btn px-5 py-3"
                                        style="background: #661414; color: #fff; border: none; border-radius: 50px; font-weight: 600; font-size: 1rem; display: inline-flex; align-items: center; justify-content: center; gap: 8px;">
                                        <i class="bi bi-check-lg"></i> Değişiklikleri Kaydet
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif

    </div>
</section>
@endsection
