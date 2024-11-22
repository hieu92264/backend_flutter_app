<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandsTable extends Migration
{
    public function up()
    {
        Schema::create('commands', function (Blueprint $table) {
            $table->id();  // Tạo cột id tự động tăng
            $table->string('command');  // Cột chứa lệnh
            $table->string('user');  // Cột lưu tên hoặc ID người dùng
            $table->timestamps();  // Tạo cột created_at và updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('commands');
    }
}
