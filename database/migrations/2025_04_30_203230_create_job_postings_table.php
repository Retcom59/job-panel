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
        Schema::create('job_postings', function (Blueprint $table) {
            $table->id();                         // Otomatik artan primary key
            $table->string('title');             // İlan başlığı
            $table->text('description');         // Açıklama
            $table->string('location');          // Lokasyon
            $table->boolean('is_active')->default(true); // Yayında mı
            $table->timestamps();                // created_at ve updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_postings');
    }
};
