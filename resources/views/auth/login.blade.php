@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="text-center mb-4">
                <i class="bi bi-cup-hot display-1 text-primary"></i>
            </div>
            <div class="card">
                <div class="card-header">
                    <i class="bi bi-lock me-2"></i>{{ __('Login to Your Account') }}
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Field -->
                        <div class="mb-4">
                            <label for="email" class="form-label">
                                <i class="bi bi-envelope me-2"></i>{{ __('Email Address') }}
                            </label>
                            <input id="email" type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email') }}" 
                                   required autocomplete="email" autofocus 
                                   placeholder="Enter your email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div class="mb-4">
                            <label for="password" class="form-label">
                                <i class="bi bi-key me-2"></i>{{ __('Password') }}
                            </label>
                            <input id="password" type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   name="password" required autocomplete="current-password" 
                                   placeholder="Enter your password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Remember Me Checkbox -->
                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" 
                                       id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-box-arrow-in-right me-2"></i>{{ __('Login') }}
                            </button>
                        </div>
                        
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
