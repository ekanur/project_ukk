<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            CREATE TRIGGER barang_stok_after_barang_keluar_insert
            AFTER INSERT ON barang_keluar
            FOR EACH ROW
                UPDATE barang
                SET stok = stok - NEW.qty_keluar
                WHERE id = NEW.barang_id
        ");
        DB::statement("
            CREATE TRIGGER barang_stok_after_barang_keluar_delete
            AFTER DELETE ON barang_keluar
            FOR EACH ROW
                UPDATE barang
                SET stok = stok + OLD.qty_keluar
                WHERE id = OLD.qty_keluar
        ");
        DB::statement("
            CREATE TRIGGER barang_stok_after_barang_keluar_update
            AFTER UPDATE ON barang_keluar
            FOR EACH ROW
                UPDATE barang
                SET stok = stok + OLD.qty_keluar - NEW.qty_keluar
                WHERE id = NEW.barang_id
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS barang_stok_after_barang_keluar_insert");
        DB::unprepared("DROP TRIGGER IF EXISTS barang_stok_after_barang_keluar_delete");
        DB::unprepared("DROP TRIGGER IF EXISTS barang_stok_after_barang_keluar_update");
    }
};
