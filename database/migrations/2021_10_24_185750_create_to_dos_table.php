<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
//use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\Schema;

class CreateToDosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('to_dos', function (Blueprint $table) {
            $currTime = new DateTime();
            //$table->id();
            //$table->timestamps();
            $table->increments('id');
            $table->boolean('checked')->default(false);
            $table->timestamp('created_at', $precision = 0)->useCurrent();//->default(new Expression('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at', $precision = 0)->useCurrent()->useCurrentOnUpdate();
            $table->timestamp('checked_at', $precision = 0)->nullable($value = true);
            $table->string('title');
            $table->text('description')->nullable($value = true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('to_dos');
    }
}
