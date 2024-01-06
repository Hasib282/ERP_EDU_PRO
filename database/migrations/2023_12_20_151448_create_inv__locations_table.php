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
        Schema::create('inv__locations', function (Blueprint $table) {
            $table->id();
            $table->string('division');
            $table->string('district_name');
            $table->string('city_name');
            $table->string('area');
            $table->string('road_no')->nullable();
            $table->tinyInteger('status')->default('1')->comment('1 for Active 0 for Inacative');
            $table->timestamp('added_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inv__locations');
    }
};
