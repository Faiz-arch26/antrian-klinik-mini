<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    Schema::create('queues', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('doctor_id')->constrained()->onDelete('cascade');
        $table->date('visit_date'); // Tanggal kunjungan [cite: 54]
        $table->text('complaint'); // Keluhan pasien [cite: 56]
        $table->integer('queue_number'); // Nomor antrian otomatis [cite: 57]
        // Status antrian [cite: 61]
        $table->enum('status', ['WAITING', 'CALLED', 'DONE', 'CANCELED'])->default('WAITING');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('queues');
    }
};
