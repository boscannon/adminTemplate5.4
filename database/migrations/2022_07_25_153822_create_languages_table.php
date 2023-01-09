<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->comment('名稱')->unique();
            $table->string('lang', 50)->comment('lang')->unique();
            $table->timestamps();
        });

        DB::table('languages')->insert(['name' => '中文', 'lang'=> 'zh-Hant']);
        DB::table('languages')->insert(['name' => '英文', 'lang'=> 'en']);

        dump('建立資料夾');
        $dir = 'public/'.config('app.upload');
        !is_dir($dir) && mkdir($dir);
        $dir = 'public/'.config('app.tmp');
        !is_dir($dir) && mkdir($dir);        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('languages');
    }
}
