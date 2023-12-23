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
        Schema::create('inv__stores', function (Blueprint $table) {
            $table->id();
            $table->string('store_name');
            $table->unsignedBigInteger('location_id');
            $table->foreign('location_id')->references('id')->on('inv__locations')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->tinyInteger('status')->default('0')->comment('1 for Active 0 for Incative');
            $table->timestamp('added_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inv__stores');
    }
};
