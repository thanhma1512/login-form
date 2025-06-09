<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-md p-8 rounded-lg w-full max-w-sm">

        <h1 class="font-sans text-2xl font-semibold text-center">Sign in</h1>

        <div class="flex justify-center gap-1 mt-2">
            <span>Need an account?</span>
            <a href="{{ route('register') }}"
                class="font-sans font-semibold hover:text-blue-500 transition-colors duration-300">Sign up !</a>
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

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <span class="font-sans font-semibold">Email</p>
                    <input class="rounded-lg shadow-sm w-full px-4 py-2 my-2" type="email" name="email"
                        value="{{ old('email') }}" placeholder="email@gmai.com">
                    <div class="flex justify-between items-center">
                        <span class="font-sans font-semibold">Password</span>
                        <span class="text-blue-600">Forgot Password?</span>
                    </div>
                    <div class="relative">
                        <input id="password" class="rounded-lg shadow-sm w-full px-4 py-2 my-2 pr-10" type="password"
                            name="password" placeholder="Enter password">
                        <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center"
                            onclick="togglePasswordVisibility('password', this)">
                            <i class="far fa-eye text-gray-400"></i>
                        </button>
                    </div>
            </div>

            <div class="mb-4 mt-2 flex items-center">
                <input type="checkbox" class="h-4 w-4 text-blue-600 border-gray-300 rounded">
                <span class="ml-2 text-sm text-gray-900">Remember me</span>
            </div>

            <button
                class="flex items-center justify-center border border-blue-300 rounded-lg shadow-sm text-white bg-blue-600 hover:bg-red-500 w-full px-2 py-2"
                type="submit">Sign in
            </button>
        </form>

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
