<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('Register') }} | TravelXplorer</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        /* Full Page Centering */
        .register-page {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #E5F3FD;
            padding: 40px;
        }

        /* Register Container with increased width */
        .register-container {
            max-width: 600px;
            width: 100%;
            min-height: 500px;
            padding: 50px;
            background-color: #fff;
            border: 2px solid #6A1B9A;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            margin: 60px auto;
        }

        /* Form group for floating labels */
        .form-group {
            position: relative;
            margin-bottom: 30px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 10px;
            font-size: 1.1rem;
            border: 2px solid #6A1B9A;
            border-radius: 5px;
            background-color: transparent;
            outline: none;
        }

        .form-group label {
            position: absolute;
            top: 10px;
            left: 12px;
            color: #6A1B9A;
            font-weight: bold;
            pointer-events: none;
            transition: all 0.3s ease;
        }

        .form-group input:focus + label,
        .form-group input:not(:placeholder-shown) + label {
            top: -12px;
            font-size: 0.8rem;
            color: #3F51B5;
        }

        /* Placeholder */
        .form-group input::placeholder {
            color: transparent;
        }

        /* Button */
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

        /* Login Link */
        .login-link {
            text-align: center;
            margin-top: 30px;
        }

        .login-link a {
            color: #6A1B9A;
            text-decoration: none;
            font-weight: bold;
        }

        .login-link a:hover {
            color: #3F51B5;
        }
    </style>
</head>
<body>

    <div class="register-page">
        <div class="register-container">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="form-group">
                    <input id="name" type="text" class="form-control" name="name" placeholder=" " value="{{ old('name') }}" required autofocus>
                    <label for="name">{{ __('Name') }}</label>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="form-group">
                    <input id="email" type="email" class="form-control" name="email" placeholder=" " value="{{ old('email') }}" required>
                    <label for="email">{{ __('Email') }}</label>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <input id="password" type="password" class="form-control" name="password" placeholder=" " required>
                    <label for="password">{{ __('Password') }}</label>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" placeholder=" " required>
                    <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                    @error('password_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Register Button -->
                <div class="form-group">
                    <button type="submit" class="submit-button">
                        {{ __('Register') }}
                    </button>
                </div>

                <!-- Already registered link -->
                <div class="login-link">
                    <p>{{ __('Already registered?') }} <a href="{{ route('login') }}">{{ __('Log in') }}</a></p>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
