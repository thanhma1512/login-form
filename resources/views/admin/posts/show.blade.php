@extends('admin.layout')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">{{ $post->title }}</h1>
        <button onclick="window.history.back()"
                class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
            &larr; Quay về
        </button>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6">
        @if ($post->image)
            <div class="mb-4 text-center">
                <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}" class="max-w-full h-auto mx-auto rounded-md shadow-lg">
            </div>
        @endif

        <div class="mb-4">
            <h2 class="text-2xl font-semibold text-gray-800 mb-2">Tiêu đề:</h2>
            <p class="text-gray-700">{{ $post->title }}</p>
        </div>

        <div class="mb-4">
            <h2 class="text-2xl font-semibold text-gray-800 mb-2">Nội dung:</h2>
            <div class="prose max-w-none text-gray-700"> {{-- Tailwind's prose plugin giúp định dạng nội dung HTML --}}
                {!! $post->content !!}
            </div>
        </div>

        <div class="mb-4">
            <h2 class="text-2xl font-semibold text-gray-800 mb-2">Người đăng:</h2>
            <p class="text-gray-700">{{ $post->user->name }}</p>
        </div>

        <div class="mb-4">
            <h2 class="text-2xl font-semibold text-gray-800 mb-2">Tags:</h2>
            @forelse ($post->tags as $tag)
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 mr-2 mb-2">
                    {{ $tag->name }}
                </span>
            @empty
                <p class="text-gray-500 text-sm">Không có tags nào.</p>
            @endforelse
        </div>

        <div class="mb-4">
            <h2 class="text-2xl font-semibold text-gray-800 mb-2">Trạng thái:</h2>
            <span class="px-2 inline-flex text-sm leading-5 font-semibold rounded-full {{ $post->is_published ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                {{ $post->is_published ? 'Đã xuất bản' : 'Nháp' }}
            </span>
        </div>

        <div class="mb-4 text-gray-600 text-sm">
            <p>Ngày tạo: {{ $post->created_at->format('d/m/Y H:i') }}</p>
            <p>Cập nhật lần cuối: {{ $post->updated_at->format('d/m/Y H:i') }}</p>
        </div>

        <div class="flex justify-end mt-6">
            <a href="{{ route('admin.posts.edit', $post) }}"
               class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-2">
                <i class="fas fa-edit mr-2"></i> Sửa
            </a>
            <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài viết này không?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <i class="fas fa-trash-alt mr-2"></i> Xóa
                </button>
            </form>
        </div>
    </div>
</div>

@endsection
