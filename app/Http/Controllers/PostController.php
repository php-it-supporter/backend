<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\User;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type = request()->type ?? '0';
        $records = Post::with(['author', 'category'])->where('type', $type)->where('isActive', '1')->orderByDesc('created_at')->get();
        return response()->json(['data' => $records], 200);
    }

    public function waiting()
    {
        $type = request()->type ?? '0';
        $records = Post::with(['author', 'category'])->where('type', $type)->where('isActive', false)->orderByDesc('created_at')->get();
        return response()->json(['data' => $records], 200);
    }

    public function active($postId)
    {
        $post = Post::find($postId);

        if (!$post) {
            return response()->json([
                'message' => 'Không tìm thấy bài đăng!'
            ], 404);
        }

        $post->isActive = true;
        $post->save();

        return response()->json([
            'message' => 'Sét duyệt bài đăng thành công!'
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $record = Post::where('title', $request->title)->first();
        if ($record) {
            return response([
                'message' => 'Bài đăng đã tồn tại!'
            ], 409);
        }

        if (!$request->author) {
            return response([
                'message' => 'Thiếu trường "author"!'
            ], 422);
        }

        $user = User::where('id', $request->author)->first();
        if (!$user) {
            return response([
                'message' => 'User không tồn tại!'
            ], 409);
        }

        $body = $request->all();
        if ($user->role == 'r4') {
            $body['isActive'] = false;
        }

        if ($request->hasFile('image')) {
            $ext = $request->file('image')->extension();
            $generate_unique_file_name = md5(time()) . '.' . $ext;
            $request->file('image')->move('images', $generate_unique_file_name, 'local');

            $body['image'] = 'images/' . $generate_unique_file_name;
        }

        Post::create($body);

        return response()->json([
            'message' => 'Tạo mới bài đăng thành công!',
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($postId)
    {
        $record = Post::find($postId);
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
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $postId)
    {
        $isExist = Post::find($postId);
        if (!$isExist) {
            return response([
                'message' => 'Không tìm thấy!'
            ], 404);
        }

        $body = $request->all();

        if ($body['title'] != $isExist->title) {
            $record = Post::where('title', $request->title)->first();
            if ($record) {
                return response([
                    'message' => 'Bài đăng đã tồn tại!'
                ], 409);
            }
        }

        if ($request->hasFile('image')) {
            $ext = $request->file('image')->extension();
            $generate_unique_file_name = md5(time()) . '.' . $ext;
            $request->file('image')->move('images', $generate_unique_file_name, 'local');

            $body['image'] = 'images/' . $generate_unique_file_name;
        }

        $isExist->update($body);

        return response()->json([
            'message' => 'Sửa bài đăng thành công!',
            'data' => $isExist,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($postId)
    {
        $record = Post::find($postId);
        if (!$record) {
            return response([
                'message' => 'Không tìm thấy!'
            ], 404);
        }

        $record->delete();

        return response()->json([
            'message' => 'Xóa bài đăng thành công!',
        ], 200);
    }
}
