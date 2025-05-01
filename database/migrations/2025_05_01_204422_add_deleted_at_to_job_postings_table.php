<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('job_postings', function (Blueprint $table) {
            $table->softDeletes(); // Bu satır deleted_at kolonunu ekler
        });
    }
    
    public function down()
    {
        Schema::table('job_postings', function (Blueprint $table) {
            $table->dropSoftDeletes(); // Geri almak için
        });
    }
};
