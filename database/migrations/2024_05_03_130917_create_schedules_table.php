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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->date("date");
            $table->json("data");
            $table->foreignId("organization_id")->references("id")->on("organizations")->onDelete("cascade")->onUpdate("cascade");
            $table->foreignId("service_id")->references("id")->on("services")->onDelete("cascade")->onUpdate("cascade");
            $table->foreignId("branch_id")->references("id")->on("branches")->onDelete("cascade")->onUpdate("cascade");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
