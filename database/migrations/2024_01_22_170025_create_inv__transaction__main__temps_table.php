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
        Schema::create('inv__transaction__main__temps', function (Blueprint $table) {
            $table->id();
            $table->string('tran_type');
            $table->string('tran_id')->unique();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->string('invoice_no')->unique();
            $table->float('invoice_amount');
            $table->float('discount');
            $table->float('net_amount');
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('status')->default('0')->comment('1 for Active 0 for Inacative');
            $table->timestamp('tran_date')->useCurrent();
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
        Schema::dropIfExists('inv__transaction__main__temps');
    }
};
