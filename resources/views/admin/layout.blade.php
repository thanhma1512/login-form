<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>

    @vite('resources/css/app.css')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @stack('styles')
</head>
<body class="bg-gray-100 font-sans antialiased flex">

    <aside class="w-64 bg-gray-800 text-white min-h-screen p-4 flex flex-col shadow-lg">

        <nav class="flex-grow">
            <ul>
                <li class="mb-2">
                    <a href="#"
                       class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition-colors duration-200
                              {{ Request::routeIs('admin.dashboard') ? 'bg-gray-700 text-blue-300' : '' }}">
                        <i class="fas fa-tachometer-alt mr-3"></i> Bảng điều khiển
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('admin.login_histories.index') }}"
                       class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition-colors duration-200
                              {{ Request::routeIs('admin.login_histories.index') ? 'bg-gray-700 text-blue-300' : '' }}">
                        <i class="fas fa-history mr-3"></i> Lịch sử Đăng nhập
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('admin.posts.index') }}"
                       class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition-colors duration-200
                              {{ Request::routeIs('admin.posts.index') || Request::routeIs('admin.posts.create') || Request::routeIs('admin.posts.edit') || Request::routeIs('admin.posts.show') ? 'bg-gray-700 text-blue-300' : '' }}">
                        <i class="fas fa-newspaper mr-3"></i> Quản lý Bài viết
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('admin.tags.index') }}"
                       class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition-colors duration-200
                              {{ Request::routeIs('admin.tags.index') || Request::routeIs('admin.tags.create') || Request::routeIs('admin.tags.edit') || Request::routeIs('admin.tags.show') ? 'bg-gray-700 text-blue-300' : '' }}">
                        <i class="fas fa-tags mr-3"></i> Quản lý Tags
                    </a>
                </li>
                {{-- Thêm các mục menu khác tại đây --}}
                {{-- Ví dụ: Quản lý người dùng --}}
                {{--
                <li class="mb-2">
                    <a href="{{ route('admin.users.index') }}"
                       class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition-colors duration-200
                              {{ Request::routeIs('admin.users.*') ? 'bg-gray-700 text-blue-300' : '' }}">
                        <i class="fas fa-users mr-3"></i> Quản lý Người dùng
                    </a>
                </li>
                --}}
            </ul>
        </nav>

        <div class="mt-auto pt-4 border-t border-gray-700">
            <a href="{{ route('logout') }}"
               class="flex items-center p-3 rounded-lg bg-red-600 hover:bg-red-700 text-white font-semibold transition-colors duration-200">
                <i class="fas fa-sign-out-alt mr-3"></i> Đăng xuất
            </a>
        </div>
    </aside>

    <div class="flex-1 flex flex-col">
        <header class="bg-white shadow-sm py-4 px-6 flex justify-between items-center">
            <div class="text-xl font-semibold text-gray-800">
                @yield('header_title', 'Dashboard') {{-- Tiêu đề cho từng trang --}}
            </div>
            <div class="flex items-center">
                <span class="mr-3 text-gray-700">Chào mừng, {{ Auth::user()->name }}!</span>
                {{-- Có thể thêm dropdown menu cho user tại đây --}}
            </div>
        </header>

        <main class="flex-1 p-6">
            @yield('content')
        </main>

        <footer class="bg-white shadow-inner py-4 px-6 text-center text-gray-500 text-sm">
            <p>&copy; {{ date('Y') }} Admin Panel. Bảo lưu mọi quyền.</p>
        </footer>
    </div>

    @stack('scripts')
</body>
</html>