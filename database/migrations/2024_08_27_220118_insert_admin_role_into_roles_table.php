<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class InsertAdminRoleIntoRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Insert default administrator role
        DB::table('roles')->insert([
            'name' => 'Administrador',
            'guard_name' => 'web', // Valor predeterminado para guard_name
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Optionally, you can remove the inserted role if the migration is rolled back
        DB::table('roles')->where('name', 'Administrador')->delete();
    }
}
