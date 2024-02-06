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
            CREATE TRIGGER barang_stok_after_insert
            AFTER INSERT ON barang_masuk
            FOR EACH ROW
                UPDATE barang
                SET stok = stok + NEW.qty_masuk
                WHERE id = NEW.barang_id;
        ");

        DB::statement("
            CREATE TRIGGER barang_stok_after_delete
            AFTER DELETE ON barang_masuk
            FOR EACH ROW
            BEGIN
                UPDATE barang
                SET stok = stok - OLD.qty_masuk
                WHERE id = OLD.barang_id;
            END;
        ");

        DB::statement("
            CREATE TRIGGER barang_stok_after_update
            AFTER UPDATE ON barang_masuk
            FOR EACH ROW
            BEGIN
                UPDATE barang
                SET stok = stok + NEW.qty_masuk - OLD.qty_masuk
                WHERE id = NEW.barang_id;
            END;        
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS barang_stok_after_insert");
        DB::unprepared("DROP TRIGGER IF EXISTS barang_stok_after_delete");
        DB::unprepared("DROP TRIGGER IF EXISTS barang_stok_after_update");
    }
};
