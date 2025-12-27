<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void
    {
        Schema::table('loans', function (Blueprint $table) {

            // TAMBAH tool_id kalau belum ada
            if (!Schema::hasColumn('loans', 'tool_id')) {
                $table->foreignId('tool_id')->after('user_id')->constrained()->cascadeOnDelete();
            }

            // TAMBAH jumlah
            if (!Schema::hasColumn('loans', 'jumlah')) {
                $table->integer('jumlah')->default(1)->after('tool_id');
            }

            // GANTI NAMA TANGGAL
            if (Schema::hasColumn('loans', 'loan_date')) {
                $table->renameColumn('loan_date', 'tanggal_pinjam');
            }

            if (Schema::hasColumn('loans', 'return_date')) {
                $table->renameColumn('return_date', 'tanggal_kembali');
            }
          
        });
    }

    public function down(): void
    {
        // rollback sederhana (optional)
    }
};


    /**
     * Reverse the migrations.
     */
  
