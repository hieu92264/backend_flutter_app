<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Xác thực dữ liệu đăng nhập
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Kiểm tra thông tin đăng nhập
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // Trả về token và thông tin người dùng
        return response()->json([
            'user' => $user,
            'token' => $user->createToken('authToken')->plainTextToken,
        ], 200);
    }

    //comment
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|string|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json([
            'user' => $user,
            'token' => $user->createToken('authToken')->plainTextToken,
        ], 201);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out'], 200);
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $newPassword = Str::random(8);
        $user->password = bcrypt($newPassword);
        $user->save();
        $messageBody = "<p>Mật khẩu ứng dụng của bạn:</p><h2>$newPassword</h2>";

        Mail::html($messageBody, function ($message) use ($user) {
            $message->to($user->email)->subject('Reset Password');
        });

        return response()->json(['message' => 'New password sent to your email'], 200);
    }
}
