<?php

namespace App\Http\Controllers;

use App\Models\SensorData;
use Illuminate\Http\Request;

class SensorDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = SensorData::latest()->first();
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate dữ liệu nhận được
        $validatedData = $request->validate([
            'rain' => 'required|string',
            'light' => 'required|string',
            'temperature' => 'required|numeric',
            'humidity' => 'required|numeric',
        ]);

        // Kiểm tra nếu bản ghi có id = 1 đã tồn tại
        $sensorData = SensorData::find(1);

        if ($sensorData) {
            // Nếu đã tồn tại, cập nhật dữ liệu
            $sensorData->update($validatedData);
        } else {
            // Nếu chưa tồn tại, tạo mới với id = 1
            $sensorData = SensorData::create(array_merge(['id' => 1], $validatedData));
        }

        // Trả về phản hồi JSON
        return response()->json([
            'success' => true,
            'message' => 'Data received successfully',
            'data' => $sensorData
        ], 200);
    }



    /**
     * Display the specified resource.
     */
    public function show(SensorData $sensorData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SensorData $sensorData)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SensorData $sensorData)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SensorData $sensorData)
    {
        //
    }
}
