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
        Schema::create('inv__receive__main__infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->string('batch_no');
            $table->string('invoice_no');
            $table->float('invoice_amount');
            $table->float('discount');
            $table->float('net_amount');
            $table->float('paid');
            $table->float('due_amount');
            $table->tinyInteger('status')->default('0')->comment('1 for Active 0 for Inacative');
            $table->unsignedBigInteger('user_id');
            $table->timestamp('receive_date')->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->foreign('supplier_id')->references('id')->on('inv__supplier__infos')
                    ->onUpdate('cascade')
                    ->onDelete('set null');
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
        Schema::dropIfExists('inv__receive__main__infos');
    }
};
