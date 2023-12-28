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
        Schema::create('inv__manufacturer__infos', function (Blueprint $table) {
            $table->id();
            $table->string('manufacturer_name');
            $table->string('manufacturer_email');
            $table->string('manufacturer_contact');
            $table->tinyInteger('status')->default('1')->comment('1 for Active 0 for Incative');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('user__infos')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->timestamp('added_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inv__manufacturer__infos');
    }
};
