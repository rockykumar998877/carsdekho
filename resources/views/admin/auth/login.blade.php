@extends('admin.layouts.auth')
@section('title')
    Login
@endsection

@section('content')
    <section class="login-sec">
        <div class="container">
            <div class="row justify-content-center flex-column align-items-center">
                <div class="mb-4 col-xl-12 col-lg-8">
                    <div class="text-center d-block card-image">
                        <img src="{{ Vite::asset(config('constants.company_logo')) }}" alt="logo" class="img-fluid" />
                    </div>
                </div>
                <div class="col-xl-7 col-xxl-6 col-lg-8 login-card-col">
                    <div class="shadow-sm card rounded-1">
                        <div class="card-body">
                            <div class="row ">
                                <div class="col-12">
                                    <h1 class="my-2 text-center fw-bold text-dark">{{ __('labels.login') }}</h1>
                                    @if (session('error'))
                                        <div class="alert alert-danger" role="alert">
                                            {{ session('error') }}
                                        </div>
                                    @elseif(session('message'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session('message') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                    <form method="POST" action="{{ route('admin.post-login') }}" class="row g-3">
                                        @csrf
                                        {{-- Email (no eye icon needed here, right?) --}}
                                        <x-nodespace-input-field :label="__('labels.email')" name="email" type="email" :placeholder="__('labels.name')"  class="col-md-12" />
                                        <x-nodespace-input-field :label="__('labels.password')" name="password" type="password" :placeholder="__('labels.password')"  class="col-md-12" />

                                        <div class="mb-3 d-none form-check">
                                            <input type="checkbox" class="form-check-input" id="rememberCheckbox"
                                                name="remember_me" {{ old('remember_me') ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="rememberCheckbox">{{ __('labels.remember_me') }}</label>
                                        </div>
                                        <div class="gap-2 d-grid">
                                            <button class="btn btn-primary" type="submit">{{ __('buttons.login') }}</button>
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

@section('scripts')
    @parent
    <script type="module"></script>
@endsection
