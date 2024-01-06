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
        Schema::create('inv__product__sub__categories', function (Blueprint $table) {
            $table->id();
            $table->string('sub_category_name');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('inv__product__categories')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
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
        Schema::dropIfExists('inv__product__sub__categories');
    }
};
