<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateUserPermissionTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 重置角色和权限缓存
        app()['cache']->forget('spatie.permission.cache');

        // 创建角色
        $role = Role::create(['name' => '超管', 'guard_name' => 'admin']);

        // 創建使用者並分配角色
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('asd123456'),
            'promotion' => \Str::random(12)
        ]);
        $user->assignRole('超管');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // 刪除使用者並刪除角色
        $user = User::where(['email' => 'admin@gmail.com'])->first();
        $user->removeRole('超管');
        $user->delete();

        // 刪除角色
        $role = Role::where(['name' => '超管'])->first();
        $role->delete();
    }

}
