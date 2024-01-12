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
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->float('invoice_no');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->float('batch_no');
            $table->float('cp');
            $table->float('discount');
            $table->date('expiry_date');
            $table->float('quantity');
            $table->float('mrp');
            $table->tinyInteger('status')->default('0')->comment('1 for Active 0 for Inactive');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamp('receive_date')->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->foreign('supplier_id')->references('id')->on('inv__supplier__infos')
                   ->cascadeOnUpdate()
                   ->nullOnDelete();
            $table->foreign('product_id')->references('id')->on('inv__products')
                   ->cascadeOnUpdate()
                   ->nullOnDelete();
            $table->foreign('user_id')->references('id')->on('user__infos')
                   ->cascadeOnUpdate()
                   ->nullOnDelete();
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
