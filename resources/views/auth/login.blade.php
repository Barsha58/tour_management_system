<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title') | TravelXplorer</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flaticon/2.1.0/font/flaticon.css">


    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    
    <style>
        /* Full Page Centering with Spacing */
        .login-page {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #E5F3FD;
            padding: 40px;
        }

        /* Increased Login Container Width and Height */
     
        .login-container {
    max-width: 2800px;  /* Increased width */
    min-height: 500px;  /* Increased height */
    padding: 60px;  /* Increased padding */
    background-color: #fff;
    border: 2px solid #6A1B9A; /* Purple border */
    border-radius: 10px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    margin: 60px auto;  /* Adjust margin for spacing */
}


        /* Floating Label Group */
        .floating-label-group {
            position: relative;
            margin-bottom: 30px; /* Increased margin-bottom for space between fields */
        }

        .floating-input {
            width: 100%;
            padding: 20px; /* Increased padding */
            border: 2px solid #6A1B9A;
            border-radius: 5px;
            font-size: 1.2rem;
            background: transparent;
            transition: border-color 0.3s, padding-top 0.3s, background-color 0.3s;
        }

        .floating-label {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            background-color: white;
            padding: 0 5px;
            font-size: 1.2rem;
            color: #6A1B9A;
            pointer-events: none;
            transition: all 0.3s ease;
        }

        /* Floating effect */
        .floating-input:focus + .floating-label,
        .floating-input:not(:placeholder-shown) + .floating-label {
            top: -15px;
            left: 15px;
            font-size: 0.9rem;
            color: #3F51B5;
            background-color: white;
        }

        /* Error Message */
        .error-message {
            color: red;
            font-size: 0.875rem;
            margin-top: 5px;
        }

        /* Remember Me */
        .remember-me {
            display: flex;
            align-items: center;
        }

        /* Form Actions */
        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Forgot Password */
        .forgot-password {
            color: #6A1B9A;
            text-decoration: none;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        /* Submit Button */
        .submit-button {
            background-color: #6A1B9A;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .submit-button:hover {
            background-color: #3F51B5;
        }

        /* Register Section */
        .register-section {
            text-align: center;
            margin-top: 30px; /* More space above the register section */
        }

        .register-link {
            color: #6A1B9A;
            font-weight: bold;
            text-decoration: none;
            transition: color 0.3s;
        }

        .register-link:hover {
            color: #3F51B5;
        }

        /* Form Actions */
.form-actions {
    display: flex;
    justify-content: flex-start; /* Align elements closer together */
    align-items: center;
    gap: 10px; /* Adjust this value for minimal gap */
}

    </style>
    
</head>
<body>
    <div class="login-page">
        <div class="login-container">
            <!-- Session Status -->
            @if (session('status'))
                <div class="mb-4 text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="login-form">
                @csrf

               <!-- Email Address with Floating Label and Placeholder -->
<div class="form-group floating-label-group">
    <input id="email" class="form-input floating-input" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="" />
    <label for="email" class="floating-label">{{ __('Email') }}</label>
    @error('email')
        <span class="error-message">{{ $message }}</span>
    @enderror
</div>

<!-- Password with Floating Label and Placeholder -->
<div class="form-group floating-label-group">
    <input id="password" class="form-input floating-input" type="password" name="password" required autocomplete="current-password" placeholder="" />
    <label for="password" class="floating-label">{{ __('Password') }}</label>
    @error('password')
        <span class="error-message">{{ $message }}</span>
    @enderror
</div>

                <!-- Remember Me -->
                <div class="form-group remember-me">
                    <label for="remember_me">
                        <input id="remember_me" type="checkbox" name="remember"> 
                        {{ __('Remember me') }}
                    </label>
                </div>

                <!-- Actions -->
                <div class="form-actions">
                    @if (Route::has('password.request'))
                        <a class="forgot-password" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <button type="submit" class="submit-button">
                        {{ __('Log in') }}
                    </button>
                </div>
            </form>

            <!-- Register Button -->
            <div class="register-section">
                <p>Don't have an account? 
                    <a href="{{ route('register') }}" class="register-link">Register</a>
                </p>
            </div>
        </div>
    </div>


    <script>
        // Ensure floating label behavior on page load
        document.addEventListener("DOMContentLoaded", function() {
            const inputs = document.querySelectorAll('.floating-input');

            inputs.forEach(input => {
                if (input.value !== '') {
                    input.classList.add('not-empty');
                }

                input.addEventListener('input', function() {
                    if (this.value !== '') {
                        this.classList.add('not-empty');
                    } else {
                        this.classList.remove('not-empty');
                    }
                });
            });
        });
    </script>

    </body>
    </html>