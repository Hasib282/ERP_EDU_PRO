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
        Schema::create('inv__receive__details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('receive_id');
            $table->unsignedBigInteger('product_id');
            $table->float('quantity');
            $table->float('cost_price');
            $table->float('mrp');
            $table->float('profit');
            $table->tinyInteger('status')->default('0')->comment('1 for Active 0 for Incative');
            $table->unsignedBigInteger('user_id');
            $table->timestamp('added_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->foreign('receive_id')->references('id')->on('inv__receive__main__infos')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('inv__products')
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
        Schema::dropIfExists('inv__receive__details');
    }
};
