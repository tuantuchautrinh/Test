<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->bigIncrements('id');
            // string nhập được khoảng 255 ký tự
            $table->string('name');
            // cho giá trị thấp nhất là 10000 - không nhập thì giá trị mặc định là 10000
            $table->integer('price')->default(10000);
            // nullable là được phép trống
            $table->string('image')->nullable();
            // text nhập được rất nhiều ký tự
            $table->text('intro');
            $table->text('content')->nullable();
            // tinyInt chỉ nhập được khoảng 2 hoặc 3 chữ số - giá trị mặc định là 1
            // comment thì trong Database trên server sẽ hiện thêm thông tin trong column đó
            $table->tinyInteger('status')->default(1)->comment('1 Show - 2 Hide');
            // # Foreign Key Constraints
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('category')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // kiểm tra xem bảng 'product' này có tồn tại hay không
        Schema::dropIfExists('product');
    }
}
