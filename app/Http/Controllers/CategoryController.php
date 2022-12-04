<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Category::with('posts')->get();
        return response()->json(['data' => $records], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $record = Category::where('name', $request->name)->first();
        if ($record) {
            return response([
                'message' => 'Thể loại đã tồn tại!'
            ], 409);
        }

        Category::create($request->all());

        return response()->json([
            'message' => 'Tạo mới thể loại thành công!',
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $categoryId)
    {
        $isExist = Category::find($categoryId);
        if (!$isExist) {
            return response([
                'message' => 'Không tìm thấy!'
            ], 404);
        }

        if ($request->name != $isExist->name) {
            $record = Category::where('name', $request->name)->first();
            if ($record) {
                return response([
                    'message' => 'Thể loại đã tồn tại!'
                ], 409);
            }
        }

        $isExist->update($request->all());

        return response()->json([
            'message' => 'Sửa thể loại thành công!',
            'data' => $isExist,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($categoryId)
    {
        $record = Category::find($categoryId);
        if (!$record) {
            return response([
                'message' => 'Không tìm thấy!'
            ], 404);
        }

        $record->delete();

        return response()->json([
            'message' => 'Xóa thể loại thành công!',
        ], 200);
    }
}
