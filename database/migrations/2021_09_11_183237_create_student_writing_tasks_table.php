<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentWritingTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_writing_tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_log_id');
            $table->foreignId('writing_task_id')->constrained()->onUpdate('cascade')
              ->onDelete('cascade');
            $table->text('task_answer');
            $table->integer('points')->nullable();
            $table->timestamps();



            $table->foreign('student_log_id')
                ->references('id')
                ->on('student_logs')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_writing_tasks');
    }
}
