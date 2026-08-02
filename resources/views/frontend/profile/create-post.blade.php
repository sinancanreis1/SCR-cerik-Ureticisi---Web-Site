@extends('frontend.layouts.app')

@section('content')
<section class="breadcrumb-section pb-0" style="padding-top: 140px;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12">
                <a href="{{ route('profile.index') }}" style="color: #661414; font-weight: 500; text-decoration: none; font-size: 0.95rem;">
                    <i class="bi bi-arrow-left me-1"></i> Profile Dön
                </a>
                <h1 class="title mt-3 mb-0">Yeni Yazı Gönder</h1>
            </div>
        </div>
        <hr style="margin-top: 25px; border-color: #e5e7eb;">
    </div>
</section>

<section class="explore-area pt-4 pb-150">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">

                <div class="p-3 mb-4 rounded-3" style="background: #fef9c3; border: 1px solid #fde68a; color: #854d0e;">
                    <i class="bi bi-info-circle me-2"></i>
                    Gönderdiğiniz yazı, yönetici onayından sonra sitede yayınlanacaktır.
                </div>

                @if($errors->any())
                    <div class="alert mb-4 p-3 rounded-3" style="background: #fef2f2; color: #991b1b; border: 1px solid #f87171;">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('profile.store_post') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group mb-4">
                        <label class="mb-2 fw-semibold" style="color: #374151;">Başlık <span style="color: #661414;">*</span></label>
                        <input type="text" name="title" class="form-control" placeholder="Yazınızın başlığını girin"
                            style="background: #f9fafb; border: 1px solid #d1d5db; color: #111827; padding: 12px 15px; border-radius: 10px;"
                            value="{{ old('title') }}" required>
                    </div>

                    <div class="form-group mb-4">
                        <label class="mb-2 fw-semibold" style="color: #374151;">Kategori <span style="color: #661414;">*</span></label>
                        <select name="category" class="form-control"
                            style="background: #f9fafb; border: 1px solid #d1d5db; color: #111827; padding: 12px 15px; border-radius: 10px;" required>
                            <option value="" disabled selected>Kategori Seçin</option>
                            <option value="Yapay Zeka" {{ old('category') == 'Yapay Zeka' ? 'selected' : '' }}>Yapay Zeka</option>
                            <option value="Bilimden Notlar" {{ old('category') == 'Bilimden Notlar' ? 'selected' : '' }}>Bilimden Notlar</option>
                            <option value="Sektörden Notlar" {{ old('category') == 'Sektörden Notlar' ? 'selected' : '' }}>Sektörden Notlar</option>
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label class="mb-2 fw-semibold" style="color: #374151;">Kısa Özet</label>
                        <textarea name="excerpt" class="form-control" rows="2" placeholder="Ana sayfada kart üzerinde görünecek kısa açıklama"
                            style="background: #f9fafb; border: 1px solid #d1d5db; color: #111827; padding: 12px 15px; border-radius: 10px;">{{ old('excerpt') }}</textarea>
                        <small style="color: #9ca3af;">İsteğe bağlı. Boş bırakırsanız içerikten otomatik oluşturulur.</small>
                    </div>

                    <div class="form-group mb-4">
                        <label class="mb-2 fw-semibold" style="color: #374151;">İçerik <span style="color: #661414;">*</span></label>
                        <textarea name="content" class="form-control" rows="10" placeholder="Yazınızın içeriğini buraya girin..."
                            style="background: #f9fafb; border: 1px solid #d1d5db; color: #111827; padding: 12px 15px; border-radius: 10px; line-height: 1.7;" required>{{ old('content') }}</textarea>
                    </div>

                    <div class="form-group mb-5">
                        <label class="mb-2 fw-semibold" style="color: #374151;">Kapak Görseli</label>
                        <div class="p-3 rounded-3" style="background: #f9fafb; border: 2px dashed #d1d5db;">
                            <input type="file" name="image" class="form-control" accept="image/*"
                                style="background: transparent; border: none; color: #6b7280; padding: 5px;">
                            <small style="color: #9ca3af;" class="mt-1 d-block">JPG, PNG veya WEBP · Maks. 2MB</small>
                        </div>
                    </div>

                    <div class="d-flex gap-3 justify-content-between align-items-center">
                        <a href="{{ route('profile.index') }}" class="btn btn-outline content-btn">Vazgeç</a>
                        <button type="submit" class="btn px-5 py-3"
                            style="background: #661414; color: #fff; border: none; border-radius: 50px; font-weight: 600; font-size: 1rem;">
                            <i class="bi bi-send me-2"></i>Gönder ve Onaya Sun
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>
@endsection

