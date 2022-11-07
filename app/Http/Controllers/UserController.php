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
        $records = User::all();
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
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

        $user->update($request->all());

        return response()->json([
            'message' => 'Sửa user thành công!',
            'data' => $user,
            'request' => $request->all()
        ]);
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
