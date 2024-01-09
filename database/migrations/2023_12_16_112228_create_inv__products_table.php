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
        Schema::create('inv__products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('sub_category_id');
            $table->unsignedBigInteger('manufacturer_id');
            $table->float('size');
            $table->unsignedBigInteger('unit');
            $table->float('mrp');
            $table->tinyInteger('status')->default('1')->comment('1 for Active 0 for Inacative');
            $table->unsignedBigInteger('user_id');
            $table->timestamp('added_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->foreign('unit')->references('id')->on('inv__units')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('inv__product__categories')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreign('sub_category_id')->references('id')->on('inv__product__sub__categories')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreign('manufacturer_id')->references('id')->on('inv__manufacturer__infos')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('user__infos')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inv__products');
    }
};
