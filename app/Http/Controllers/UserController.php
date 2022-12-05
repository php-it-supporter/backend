<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $department = request()->departmentId;

        $records = User::with(['major', 'department'])
            ->where('isDelete', '0')
            ->where('isActive', '1')
            ->orderByDesc('created_at');

        if ($department) {
            $records->where('department', $department);
        }

        $response = [
            'data' => $records->get(),
        ];
        return response($response);
    }

    public function waiting()
    {
        $records = User::with(['major', 'department'])->where('isDelete', '0')->where('isActive', '0')->orderByDesc('created_at')->get();
        $response = [
            'data' => $records
        ];
        return response($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $body = $request->all();

        // Check user
        $user = User::where('username', $body['username'])->first();
        if ($user) {
            return response([
                'message' => 'Tài khoản đã tồn tại!'
            ], 409);
        }

        $body['password'] = bcrypt($body['password']);
        $body['isActive'] = true;

        if ($request->hasFile('avatar')) {
            $ext = $request->file('avatar')->extension();
            $generate_unique_file_name = md5(time()) . '.' . $ext;
            $request->file('avatar')->move('images', $generate_unique_file_name, 'local');

            $body['avatar'] = 'images/' . $generate_unique_file_name;
        }

        User::create($body);

        return response()->json([
            'message' => 'Tạo mới thành viên thành công!',
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($userId)
    {
        $record = User::find($userId);
        if (!$record) {
            return response([
                'message' => 'Không tìm thấy!'
            ], 404);
        }

        return response()->json([
            'data' => $record,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $userId)
    {
        $user = User::find($userId);

        if (!$user) {
            return response()->json([
                'message' => 'Không tìm thấy user!'
            ], 404);
        }

        $body = $request->all();

        if (array_key_exists('password', $body)) {
            $body['password'] = bcrypt($body['password']);
        }

        if ($request->hasFile('avatar')) {
            $ext = $request->file('avatar')->extension();
            $generate_unique_file_name = md5(time()) . '.' . $ext;
            $request->file('avatar')->move('images', $generate_unique_file_name, 'local');

            $body['avatar'] = 'images/' . $generate_unique_file_name;
        }

        if ($request->fund) {
            $body['fund'] += $user->fund;
        }

        $user->update($body);

        return response()->json([
            'message' => 'Sửa user thành công!',
            'data' => $user,
            'request' => $request->all()
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($userId)
    {
        $user = User::find($userId);

        if (!$user) {
            return response()->json([
                'message' => 'Không tìm thấy user!'
            ], 404);
        }

        $user->isDelete = true;
        $user->save();

        return response()->json([
            'message' => 'Xóa user thành công!'
        ], 200);
    }

    public function active($userId)
    {
        $user = User::find($userId);

        if (!$user) {
            return response()->json([
                'message' => 'Không tìm thấy user!'
            ], 404);
        }

        $user->isActive = true;
        $user->save();

        return response()->json([
            'message' => 'Sét duyệt tài khoản thành công!'
        ], 200);
    }
}
