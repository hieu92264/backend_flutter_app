<?php

namespace App\Http\Controllers;

use App\Models\Wifi;
use Illuminate\Http\Request;

class WifiController extends Controller
{
    // Lấy danh sách WiFi
    public function index()
    {
        return response()->json(Wifi::all());
    }

    public function findBySsidTypeAndPassword(Request $request)
    {
        $validated = $request->validate([
            'ssid' => 'required|string|max:255',      // Tên WiFi
            'type' => 'required|string|max:50',      // Loại WiFi
            'password' => 'required|string|max:255', // Mật khẩu
        ]);

        $ssid = $validated['ssid'];
        $type = $validated['type'];
        $password = $validated['password'];

        // Tìm WiFi dựa trên ssid, type và password
        $wifi = Wifi::where('ssid', $ssid)
            ->where('type', $type)
            ->where('password', $password)
            ->first();

        if ($wifi) {
            return response()->json($wifi, 200);
        }

        return response()->json(['message' => 'WiFi not found'], 404);
    }

    // Thêm mới WiFi
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ssid' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'type' => 'required|string|max:50',
        ]);

        $wifi = Wifi::create($validated);

        return response()->json($wifi, 201);
    }

    // Cập nhật thông tin WiFi
    public function update(Request $request, Wifi $wifi)
    {
        $validated = $request->validate([
            'ssid' => 'sometimes|required|string|max:255',
            'password' => 'sometimes|required|string|max:255',
            'type' => 'sometimes|required|string|max:50',
        ]);

        $wifi->update($validated);

        return response()->json($wifi);
    }

    // Xóa WiFi
    public function destroy(Wifi $wifi)
    {
        $wifi->delete();

        return response()->json(null, 204);
    }
}
