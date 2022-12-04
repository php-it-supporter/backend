<?php

namespace App\Http\Controllers;

use App\Models\Financial;
use Illuminate\Http\Request;

class FinancialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Financial::all();
        return response()->json(['data' => $records], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->event || !$request->totalPaid) {
            return response([
                'message' => 'Nhập đầy đủ trường!'
            ], 422);
        }

        $record = Financial::where('event', $request->event)->first();
        if ($record) {
            return response([
                'message' => 'Sự kiện chi tiêu đã tồn tại!'
            ], 409);
        }

        Financial::create($request->all());

        return response()->json([
            'message' => 'Tạo mới sự kiện chi tiêu thành công!',
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Financial  $financial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $financialId)
    {
        $isExist = Financial::find($financialId);
        if (!$isExist) {
            return response([
                'message' => 'Không tìm thấy!'
            ], 404);
        }

        if ($request->event != $isExist->event) {
            $record = Financial::where('event', $request->event)->first();
            if ($record) {
                return response([
                    'message' => 'Sự kiện chi tiêu đã tồn tại!'
                ], 409);
            }
        }

        $isExist->update($request->all());

        return response()->json([
            'message' => 'Sửa sự kiện chi tiêu thành công!',
            'data' => $isExist,
        ], 200);
    }
}
