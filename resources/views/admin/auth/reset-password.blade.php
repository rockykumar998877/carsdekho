@extends('admin.layouts.auth')
@section('title')
    Reset Password
@endsection

@section('content')
    <section class="login-sec">
        <div class="container">
            <div class="row justify-content-center flex-column align-items-center">
                <div class="mb-4 col-xl-8 col-lg-6">
                    <div class="text-center d-block card-image">
                        <img src="{{ Vite::asset(config('constants.company_logo')) }}" alt="logo" class="img-fluid" />
                    </div>
                </div>
                <div class="col-xl-7 col-xxl-6 col-lg-8 login-card-col">
                    <div class="shadow-sm card rounded-1">
                        <div class="card-body">
                            <div class="row ">
                                <div class="col-12">
                                    <h1 class="my-2 text-center fw-bold text-dark">Reset Password</h1>
                                    
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form method="POST" action="{{ route('admin.password.update') }}" class="row g-3">
                                        @csrf
                                        <input type="hidden" name="token" value="{{ $token }}">
                                        
                                        <x-nodespace-input-field :label="__('labels.email')" name="email" type="email" placeholder="Enter your email" value="{{ old('email') }}" class="col-md-12" />
                                        <x-nodespace-input-field label="New Password" name="password" type="password" placeholder="Enter new password" class="col-md-12" />
                                        <x-nodespace-input-field label="Confirm Password" name="password_confirmation" type="password" placeholder="Confirm new password" class="col-md-12" />
                                        
                                        <div class="gap-2 d-grid">
                                            <button class="btn btn-primary" type="submit">Reset Password</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
