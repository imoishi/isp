<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('division_id')->unsigned()->nullable();
            $table->bigInteger('district_id')->unsigned()->nullable();
            $table->bigInteger('upazila_id')->unsigned()->nullable();
            $table->boolean('status')->default(1)->nullable();
            $table->timestamps();

            $table->foreign('division_id')
                ->references('id')
                ->on('divisions')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('district_id')
                ->references('id')
                ->on('districts')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('upazila_id')
                ->references('id')
                ->on('upazilas')
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
        Schema::dropIfExists('areas');
    }
}
