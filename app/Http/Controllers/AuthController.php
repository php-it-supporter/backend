<?php

namespace App\Http\Controllers;

use App\Models\Auth;
use App\Http\Requests\StoreAuthRequest;
use App\Http\Requests\UpdateAuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $fields = $request->validate([
            'username' => 'required|string',
            'password' => 'required'
        ]);

        // Check username
        $user = User::where('username', $fields['username'])->first();

        // Check password
        if (
            !$user
            || !Hash::check($fields['password'], $user->password)
            || $user["isActive"] == false
            || $user["isDelete"] == true
        ) {
            return response([
                'message' => 'Đăng nhập thất bại!'
            ], 401);
        }

        $token = $user->createToken($user["username"])->plainTextToken;

        $response = [
            'data' => $user,
            'access_token' => $token,
            'message' => 'Đăng nhập thành công!'
        ];

        return response($response, 200);
    }

    public function register(Request $request)
    {
        $fields = $request->validate([
            'username' => 'required|string',
            'password' => 'required',
        ]);

        // Check user
        $user = User::where('username', $fields['username'])->first();
        if ($user) {
            return response([
                'message' => 'Tài khoản đã tồn tại!'
            ], 409);
        }

        $body = $request->all();
        $body['password'] = bcrypt($fields['password']);
        $body['isActive'] = false;

        if ($request->hasFile('avatar')) {
            $ext = $request->file('avatar')->extension();
            $generate_unique_file_name = md5(time()) . '.' . $ext;
            $request->file('avatar')->move('images', $generate_unique_file_name, 'local');

            $body['avatar'] = 'images/' . $generate_unique_file_name;
        }

        User::create($body);

        $response = [
            'message' => 'Đăng ký thành công, hãy chờ sét duyệt!'
        ];

        return response($response, 200);
    }
}
