@extends('frontend.layouts.app')

@section('content')
<section class="contact-section pb-150" style="padding-top: 200px; min-height: 100vh; display: flex; align-items: center;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-5">
                <div class="contact-form-area has-shadow p-5 rounded-4" style="background: #ffffff; border: 1px solid #e5e7eb;">
                    <h2 class="title text-center mb-4" style="color: #030712;">Kayıt Ol</h2>
                    
                    @if($errors->any())
                        <div class="alert alert-danger" style="background: #fef2f2; color: #991b1b; border: 1px solid #f87171;">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="form-group mb-4">
                            <label class="mb-2 fw-semibold" style="color: #374151;">Ad Soyad</label>
                            <input type="text" name="name" class="form-control" style="background: #f9fafb; border: 1px solid #d1d5db; color: #111827; padding: 12px 15px;" value="{{ old('name') }}" required>
                        </div>
                        <div class="form-group mb-4">
                            <label class="mb-2 fw-semibold" style="color: #374151;">E-Posta Adresi</label>
                            <input type="email" name="email" class="form-control" style="background: #f9fafb; border: 1px solid #d1d5db; color: #111827; padding: 12px 15px;" value="{{ old('email') }}" required>
                        </div>
                        <div class="form-group mb-4">
                            <label class="mb-2 fw-semibold" style="color: #374151;">Şifre</label>
                            <input type="password" name="password" class="form-control" style="background: #f9fafb; border: 1px solid #d1d5db; color: #111827; padding: 12px 15px;" required>
                        </div>
                        <div class="form-group mb-4">
                            <label class="mb-2 fw-semibold" style="color: #374151;">Şifre Tekrar</label>
                            <input type="password" name="password_confirmation" class="form-control" style="background: #f9fafb; border: 1px solid #d1d5db; color: #111827; padding: 12px 15px;" required>
                        </div>
                        <div class="text-center mt-2">
                            <button type="submit" class="btn px-5 py-3" style="background: #661414; color: #ffffff; border: none; font-size: 1.1rem; font-weight: 600; border-radius: 50px; letter-spacing: 0.5px; min-width: 200px; display: inline-flex; align-items: center; justify-content: center;">Kayıt Ol</button>
                        </div>
                    </form>
                    
                    <div class="text-center mt-4 pt-3 border-top" style="border-color: #e5e7eb !important;">
                        <span style="color: #6b7280;">Zaten hesabınız var mı?</span>
                        <a href="{{ route('login') }}" class="fw-bold ms-1" style="color: #661414; text-decoration: underline;">Giriş Yap</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
