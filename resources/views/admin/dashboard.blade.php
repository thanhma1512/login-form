@extends('admin.layout')

@section('content')
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Chào mừng, Admin!</h2>

        <p class="text-gray-600 mb-8">
            Bạn đang ở bảng điều khiển quản trị. Tại đây, bạn có thể truy cập các tính năng quản lý hệ thống.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <div class="bg-blue-50 border border-blue-200 rounded-lg p-5 shadow-sm hover:shadow-md transition-shadow duration-200">
                <h3 class="text-xl font-semibold text-blue-800 mb-3">Lịch sử Đăng nhập</h3>
                <p class="text-blue-700 text-sm mb-4">Xem lại các hoạt động đăng nhập của tất cả tài khoản.</p>
                <a href="{{ route('admin.login_histories.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                    Xem lịch sử <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

            <div class="bg-green-50 border border-green-200 rounded-lg p-5 shadow-sm hover:shadow-md transition-shadow duration-200">
                <h3 class="text-xl font-semibold text-green-800 mb-3">Quản lý Bài viết</h3>
                <p class="text-green-700 text-sm mb-4">Thêm, sửa, xóa và quản lý các bài viết trên hệ thống.</p>
                <a href="{{ route('admin.posts.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                    Quản lý bài viết <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

            <div class="bg-purple-50 border border-purple-200 rounded-lg p-5 shadow-sm hover:shadow-md transition-shadow duration-200">
                <h3 class="text-xl font-semibold text-purple-800 mb-3">Quản lý Tags</h3>
                <p class="text-purple-700 text-sm mb-4">Thêm, sửa và xóa các tag để phân loại nội dung.</p>
                <a href="{{ route('admin.tags.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700 active:bg-purple-900 focus:outline-none focus:border-purple-900 focus:ring ring-purple-300 disabled:opacity-25 transition ease-in-out duration-150">
                    Quản lý tags <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

        </div>
    </div>
@endsection