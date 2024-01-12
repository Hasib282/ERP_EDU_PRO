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
        Schema::create('inv__supplier__infos', function (Blueprint $table) {
            $table->id();
            $table->string('sup_name');
            $table->string('sup_email');
            $table->string('sup_contact');
            $table->string('sup_address');
            $table->tinyInteger('status')->default('1')->comment('1 for Active 0 for Inactive');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('user__infos')
                    ->nullOnDelete()
                    ->cascadeOnUpdate();
            $table->timestamp('added_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inv__supplier__infos');
    }
};
