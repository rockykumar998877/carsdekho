@extends('admin.layouts.auth')
@section('title')
    Forgot Password
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
                                    <h1 class="my-2 text-center fw-bold text-dark">Forgot Password</h1>
                                    <p class="text-center text-muted mb-4">Enter your email address and we'll send you a link to reset your password.</p>
                                    
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif

                                    <form method="POST" action="{{ route('admin.password.email') }}" class="row g-3">
                                        @csrf
                                        <x-nodespace-input-field :label="__('labels.email')" name="email" type="email" placeholder="Enter your email"  class="col-md-12" />
                                        
                                        <div class="gap-2 d-grid">
                                            <button class="btn btn-primary" type="submit">Send Password Reset Link</button>
                                        </div>
                                        
                                        <div class="text-center mt-3">
                                            <a href="{{ route('admin.login') }}" class="text-decoration-none">Back to Login</a>
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
