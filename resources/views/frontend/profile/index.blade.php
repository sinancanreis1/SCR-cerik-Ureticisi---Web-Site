@extends('frontend.layouts.app')

@section('content')
<section class="breadcrumb-section pb-0" style="padding-top: 160px;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <h1 class="title mb-1">Merhaba, {{ $user->name }}</h1>
                        <p style="color: #661414; font-weight: 500; margin: 0;">Profilinize hoş geldiniz.</p>
                    </div>
                    <div class="d-flex gap-2 align-items-center">
                        <a href="{{ route('profile.create_post') }}" class="btn px-4 py-2" style="background: #661414; color: #fff; border: none; border-radius: 50px; font-weight: 600; white-space: nowrap; display: inline-flex; align-items: center; gap: 6px;"><i class="bi bi-pencil-square"></i> Yeni Yazı Gönder</a>
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

        {{-- Üst satır: Yazılar + İstatistikler --}}
        <div class="row">
            <div class="col-12 col-lg-8">
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
                                            @if($blog->is_active)
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

            <div class="col-12 col-lg-4 mt-5 mt-lg-0">
                <h3 class="mb-4" style="color: #030712; font-size: 1.2rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">İstatistikler</h3>
                <div class="rounded-4 overflow-hidden" style="border: 1px solid #e5e7eb;">
                    <div class="d-flex justify-content-between align-items-center p-4" style="border-bottom: 1px solid #f3f4f6;">
                        <div class="d-flex align-items-center gap-3">
                            <div style="width: 36px; height: 36px; background: #fef2f2; border-radius: 9px; display:flex; align-items:center; justify-content:center;">
                                <i class="bi bi-file-earmark-text" style="color: #661414;"></i>
                            </div>
                            <span style="color: #374151; font-weight: 500; font-size: 0.95rem;">Yazı Sayısı</span>
                        </div>
                        <span style="color: #030712; font-size: 1.5rem; font-weight: 700;">{{ $blogs->count() }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center p-4" style="border-bottom: 1px solid #f3f4f6;">
                        <div class="d-flex align-items-center gap-3">
                            <div style="width: 36px; height: 36px; background: #fef2f2; border-radius: 9px; display:flex; align-items:center; justify-content:center;">
                                <i class="bi bi-chat-left-text" style="color: #661414;"></i>
                            </div>
                            <span style="color: #374151; font-weight: 500; font-size: 0.95rem;">Yorumlar</span>
                        </div>
                        <span style="color: #030712; font-size: 1.5rem; font-weight: 700;">{{ $comments->count() }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center p-4">
                        <div class="d-flex align-items-center gap-3">
                            <div style="width: 36px; height: 36px; background: #fef2f2; border-radius: 9px; display:flex; align-items:center; justify-content:center;">
                                <i class="bi bi-heart" style="color: #661414;"></i>
                            </div>
                            <span style="color: #374151; font-weight: 500; font-size: 0.95rem;">Beğeniler</span>
                        </div>
                        <span style="color: #030712; font-size: 1.5rem; font-weight: 700;">{{ $likes->count() }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Profil Düzenle Bölümü --}}
        <div class="row mt-5">
            <div class="col-12">
                <hr style="border-color: #e5e7eb; margin-bottom: 35px;">
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
                        <div class="col-12 mb-4">
                            <label class="mb-2 fw-semibold d-block" style="color: #374151;">Profil Fotoğrafı</label>
                            <div class="d-flex align-items-center gap-4">
                                <div style="width: 80px; height: 80px; border-radius: 50%; overflow: hidden; background: #fef2f2; border: 3px solid #e5e7eb; display:flex; align-items:center; justify-content:center; flex-shrink: 0;">
                                    @if($user->avatar_url)
                                        <img src="{{ asset('storage/' . $user->avatar_url) }}" alt="{{ $user->name }}" style="width:100%; height:100%; object-fit:cover;">
                                    @else
                                        <span style="font-size: 1.8rem; font-weight: 700; color: #661414;">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                    @endif
                                </div>
                                <div style="flex: 1;">
                                    <div class="p-3 rounded-3" style="background: #f9fafb; border: 2px dashed #d1d5db;">
                                        <input type="file" name="avatar" class="form-control" accept="image/*"
                                            style="background: transparent; border: none; color: #6b7280; padding: 4px;">
                                        <small style="color: #9ca3af;" class="d-block mt-1">JPG, PNG veya WEBP · Maks. 2MB</small>
                                    </div>
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

        {{-- Çıkış Yap en altta ve formların tamamen dışında --}}
        <div class="row mt-4">
            <div class="col-12 col-lg-8">
                <hr style="border-color: #e5e7eb;">
                <div class="text-center mt-4">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn px-5 py-2"
                            style="background: transparent; color: #9ca3af; border: 1px solid #e5e7eb; border-radius: 50px; font-size: 0.9rem;">
                            <i class="bi bi-box-arrow-right me-1"></i> Oturumu Kapat
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
