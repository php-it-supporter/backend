<?php

namespace App\Http\Controllers;

use App\Models\Major;
use App\Http\Requests\StoreMajorRequest;
use App\Http\Requests\UpdateMajorRequest;

class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Major::all();
        return response()->json(['data' => $records], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMajorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMajorRequest $request)
    {
        $record = Major::where('name', $request->name)->first();
        if ($record) {
            return response([
                'message' => 'Chuyên ngành đã tồn tại!'
            ], 409);
        }

        Major::create($request->all());

        return response()->json([
            'message' => 'Tạo mới chuyên ngành thành công!',
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Major  $major
     * @return \Illuminate\Http\Response
     */
    public function show(Major $major)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMajorRequest  $request
     * @param  \App\Models\Major  $major
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMajorRequest $request, $majorId)
    {
        $isExist = Major::find($majorId);
        if (!$isExist) {
            return response([
                'message' => 'Không tìm thấy!'
            ], 404);
        }

        if ($request->name != $isExist->name) {
            $record = Major::where('name', $request->name)->first();
            if ($record) {
                return response([
                    'message' => 'Chuyên ngành đã tồn tại!'
                ], 409);
            }
        }

        $isExist->update($request->all());

        return response()->json([
            'message' => 'Sửa chuyên ngành thành công!',
            'data' => $isExist,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Major  $major
     * @return \Illuminate\Http\Response
     */
    public function destroy($majorId)
    {
        $record = Major::find($majorId);
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
