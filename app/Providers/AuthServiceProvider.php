<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate; 
use App\Models\User; 

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('view-login-histories', function (User $user) {
            // Đây là dòng debug mới trong Gate
            $is_admin_casted = (bool) $user->is_admin;
            $is_admin_strict = $user->is_admin === 1; // Kiểm tra so sánh nghiêm ngặt
            $result = $is_admin_casted; // Kết quả cuối cùng của Gate

            // Đặt dd() này để xem chính xác các giá trị trong Gate
            // dd([
            //     'location' => 'AuthServiceProvider@Gate_view-login-histories',
            //     'user_id' => $user->id,
            //     'user_email' => $user->email,
            //     'raw_is_admin_from_user_object' => $user->getRawOriginal('is_admin'), // Lấy giá trị thô từ DB
            //     'casted_is_admin_value' => $user->is_admin, // Giá trị sau khi cast bởi Model
            //     '(bool) $user->is_admin_explicit_cast' => (bool) $user->is_admin, // Ép kiểu tường minh
            //     'is_admin_strict_comparison_to_int_1' => $is_admin_strict,
            //     'gate_will_return' => $result,
            // ]);

            return $result;
        });

        Gate::define('manage-admin-features', function (User $user) {
            return (bool) $user->is_admin; // Giữ nguyên hoặc sửa lại tương tự nếu cần
        });
    }
}