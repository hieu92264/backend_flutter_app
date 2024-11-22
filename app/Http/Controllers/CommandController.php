<?php

namespace App\Http\Controllers;

use App\Models\Command; // Đảm bảo bạn đã tạo Model Command
use Illuminate\Http\Request;

class CommandController extends Controller
{
    // Trả về lệnh mới nhất cho ESP
    public function getLatestCommand()
    {
        // Lấy lệnh mới nhất, sắp xếp theo created_at giảm dần
        $command = Command::latest()->first();

        if ($command) {
            return response()->json(['command' => $command->command]);
        }

        return response()->json(['message' => 'No command available'], 404);
    }

    public function store(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $validated = $request->validate([
            'command' => 'required|string|max:255',  // Lệnh phải là chuỗi và không vượt quá 255 ký tự
            'user' => 'required|string|max:255',     // Người dùng phải là chuỗi và không vượt quá 255 ký tự
        ]);

        // Tạo mới một bản ghi lệnh và lưu vào cơ sở dữ liệu
        $command = Command::create([
            'command' => $validated['command'],
            'user' => $validated['user'],
        ]);

        // Trả về phản hồi JSON khi lưu thành công
        return response()->json([
            'message' => 'Lệnh đã được lưu thành công',
            'command' => $command,  // Trả về dữ liệu lệnh đã lưu
        ], 201);  // Mã trạng thái HTTP 201 cho thành công khi tạo mới
    }
}
