<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
</head>

<body>
    <h1 class="text-3xl font-bold underline">
        Hello world!
    </h1>
    <form action="{{ route('logout') }}" method="GET">
        @csrf
        <button type="submit"
            class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300">
            Đăng xuất
        </button>
    </form>
</body>

</html>
