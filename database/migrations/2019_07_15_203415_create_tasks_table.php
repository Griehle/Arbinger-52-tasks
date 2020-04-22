<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('employee_id');
            $table->string('task_Body', 300);
            $table->timestamp('date')
                ->default(DB::raw('CURRENT_TIMESTAMP'))
                ->onUpdate(DB::raw('CURRENT_TIMESTAMP'));
            $table->tinyInteger('posted');
            $table->unsignedInteger('postTask');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
