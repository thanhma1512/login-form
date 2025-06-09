<!doctype html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-md p-8 rounded-lg w-full max-w-sm">

        <h1 class="font-sans text-2xl font-semibold text-center">Register</h1>

        <div class="flex justify-center gap-1 mt-2">
            <span>Already have an account?</span>
            <a href="{{ route('login.form') }}" class="font-sans font-semibold hover:text-blue-500 transition-colors duration-300">Sign in !</a>
        </div>

        <div class="flex justify-center gap-1 mt-2">
            <div class="flex space-x-4 p-2">
                <button
                    class="flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-gray-700 bg-white hover:bg-gray-200">
                    <img src="{{ asset('images/gg.png') }}" class="w-5 h-5 mr-2">
                    <span>Use Google</span>
                </button> 

                <button
                    class="flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-gray-700 bg-white hover:bg-gray-200">
                    <img src="{{ asset('images/apple.png') }}" class="w-5 h-5 mr-2">
                    <span>Use Apple</span>
                </button>  
            </div>
        </div>

        <div class="relative flex items-center justify-center pt-2 pb-4">
            <div class="flex-grow border-t border-gray-300"></div>
            <span class="flex-shrink mx-4 text-gray-400">OR</span>
            <div class="flex-grow border-t border-gray-300"></div>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <label for="name" class="font-sans font-semibold">Full name</label>
                <input id="name" class="rounded-lg shadow-sm w-full px-4 py-2 my-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                       type="text" name="name" value="{{ old('name') }}" placeholder="Enter your full name" required autofocus>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-4">
                <label for="email" class="font-sans font-semibold">Email</label>
                <input id="email" class="rounded-lg shadow-sm w-full px-4 py-2 my-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                       type="email" name="email" value="{{ old('email') }}" placeholder="email@example.com" required>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-4">
                <label for="password" class="font-sans font-semibold">Password</label>
                <div class="relative">
                    <input id="password" class="rounded-lg shadow-sm w-full px-4 py-2 my-2 pr-10 border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                           type="password" name="password" placeholder="Enter password" required autocomplete="new-password">
                    <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center"
                            onclick="togglePasswordVisibility('password', this)">
                        <i class="far fa-eye text-gray-400"></i>
                    </button>
                </div>
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-4">
                <label for="password_confirmation" class="font-sans font-semibold">Confirm password</label>
                <div class="relative">
                    <input id="password_confirmation" class="rounded-lg shadow-sm w-full px-4 py-2 my-2 pr-10 border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                           type="password" name="password_confirmation" placeholder="Re-enter password" required autocomplete="new-password">
                    <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center"
                            onclick="togglePasswordVisibility('password_confirmation', this)">
                        <i class="far fa-eye text-gray-400"></i>
                    </button>
                </div>
            </div>

            <button
                class="mt-6 flex items-center justify-center border border-blue-300 rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 w-full px-2 py-2 transition-colors duration-300"
                type="submit">
                Sign up
            </button>
        </form>

        @if($errors->any())
            <div class="mt-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded relative" role="alert">
                <strong class="font-bold">Lỗi đăng ký!</strong>
                <span class="block sm:inline">Vui lòng kiểm tra lại thông tin.</span>
                <ul class="mt-2 list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div>

    <script>
        function togglePasswordVisibility(inputId, buttonElement) {
            const passwordInput = document.getElementById(inputId);
            const eyeIcon = buttonElement.querySelector('i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>