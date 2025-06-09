<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\LoginHistory;
use Illuminate\Support\Facades\Auth;

class LoginHistoryController extends Controller
{
    public function index()
    {
        // dd("Đã vào LoginHistoryController@index. User is_admin: " . (Auth::user()->is_admin ?? 'N/A'));
        $loginHistories = LoginHistory::with('user')
            ->latest('logged_in_at')
            ->paginate(20);

        return view('admin.login_histories.index', compact('loginHistories'));
    }
}
