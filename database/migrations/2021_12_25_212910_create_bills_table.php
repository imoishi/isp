<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 10, 2);
            $table->decimal('due', 10, 2)->nullable();
            $table->decimal('package_price', 10, 2)->nullable();
            $table->longText('note')->nullable();
            $table->tinyInteger('status')->default(1)->comment('0 for due, 1 for paid, 2 for partially paid');
            $table->date('date');
            $table->unsignedBigInteger('user_id')->nullable()->comment('ie. customer id');
            $table->unsignedBigInteger('package_id')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('package_id')
                ->references('id')
                ->on('packages')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bills');
    }
}
