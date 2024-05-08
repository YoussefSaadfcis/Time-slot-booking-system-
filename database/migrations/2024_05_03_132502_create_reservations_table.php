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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->references("id")->on("users")->onDelete("cascade")->onUpdate("cascade");
            $table->foreignId("service_id")->references("id")->on("services")->onDelete("cascade")->onUpdate("cascade");
            $table->foreignId("branch_id")->references("id")->on("branches")->onDelete("cascade")->onUpdate("cascade");
            $table->date("date");
            $table->integer("state");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
