<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Memastikan tabel 'projects' sudah ada sebelum menambah kolom
        if (Schema::hasTable('projects')) {
            Schema::table('projects', function (Blueprint $table) {
                $table->string('category')->default('Kuliah'); // Default kategori
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Hapus kolom 'category' jika rollback
        if (Schema::hasColumn('projects', 'category')) {
            Schema::table('projects', function (Blueprint $table) {
                $table->dropColumn('category');
            });
        }
    }
};
