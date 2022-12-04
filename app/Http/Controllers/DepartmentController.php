<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Department::all();
        return response()->json(['data' => $records], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDepartmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->name) {
            return response([
                'message' => 'Thiếu trường "name"!'
            ], 422);
        }

        $record = Department::where('name', $request->name)->first();
        if ($record) {
            return response([
                'message' => 'Ban đã tồn tại!'
            ], 409);
        }

        Department::create($request->all());

        return response()->json([
            'message' => 'Tạo mới ban thành công!',
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDepartmentRequest  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $departmentId)
    {
        $isExist = Department::find($departmentId);
        if (!$isExist) {
            return response([
                'message' => 'Không tìm thấy!'
            ], 404);
        }

        if (!$request->name) {
            return response([
                'message' => 'Thiếu trường "name"!'
            ], 422);
        }

        if ($request->name != $isExist->name) {
            $record = Department::where('name', $request->name)->first();
            if ($record) {
                return response([
                    'message' => 'Ban đã tồn tại!'
                ], 409);
            }
        }

        $isExist->update($request->all());

        return response()->json([
            'message' => 'Sửa ban thành công!',
            'data' => $isExist,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy($departmentId)
    {
        $record = Department::find($departmentId);
        if (!$record) {
            return response([
                'message' => 'Không tìm thấy!'
            ], 404);
        }

        $record->delete();

        return response()->json([
            'message' => 'Xóa chuyên ngành thành công!',
        ], 200);
    }
}
