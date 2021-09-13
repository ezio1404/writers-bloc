<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentQuizAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_lessons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_log_id');
            $table->foreignId('quiz_id')->constrained();
            $table->foreignId('choice_id')->nullable()->constrained();
            $table->text('answer');
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
        Schema::dropIfExists('student_quiz_answers');
    }
}
