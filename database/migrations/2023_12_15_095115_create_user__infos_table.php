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
        Schema::create('user__infos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('contact');
            $table->string('gender');
            $table->string('address');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('user__categories')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->string('password');
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
        Schema::dropIfExists('user__infos');
    }
};
