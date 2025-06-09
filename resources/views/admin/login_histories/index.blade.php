@extends('admin.layout')

@section('content')

<div class="bg-gray-100 p-8">
    <div class="container mx-auto bg-white shadow-md p-6 rounded-lg">
        <h1 class="font-sans text-2xl font-semibold mb-6 text-center">Lịch sử Đăng nhập</h1>

        <div class="overflow-x-auto rounded-lg border border-gray-300 shadow-sm">
            <table class="min-w-full bg-white divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID
                        </th>
                        <th scope="col"
                            class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tài
                            khoản</th>
                        <th scope="col"
                            class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Địa
                            chỉ IP</th>
                        <th scope="col"
                            class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thông
                            tin trình duyệt</th>
                        <th scope="col"
                            class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thời
                            gian đăng nhập</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($loginHistories as $history)
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 px-4 whitespace-nowrap text-sm text-gray-900">{{ $history->id }}</td>
                            <td class="py-3 px-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $history->user->name ?? 'Người dùng không tồn tại' }}
                                ({{ $history->user->email ?? 'N/A' }})
                            </td>
                            <td class="py-3 px-4 whitespace-nowrap text-sm text-gray-900">{{ $history->ip_address }}
                            </td>
                            <td class="py-3 px-4 text-sm text-gray-500 max-w-xs truncate"
                                title="{{ $history->user_agent }}">
                                {{ $history->user_agent }}
                            </td>
                            <td class="py-3 px-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $history->logged_in_at->format('d/m/Y H:i:s') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-4 px-4 text-center text-sm text-gray-500">Chưa có lịch sử đăng
                                nhập nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $loginHistories->links() }}
        </div>
    </div>
</div>
@endsection
