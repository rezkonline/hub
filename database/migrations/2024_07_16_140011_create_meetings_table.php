<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->dateTime('start_at');
            $table->string('duration');
            $table->timestamps();
        });
        Schema::create('meeting_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('meeting_id');
            $table->foreign('meeting_id')->on('meetings')->references('id')->onDelete('cascade');
            $table->string('locale');
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->unique(['locale', 'meeting_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meeting_translations');
        Schema::dropIfExists('meetings');
    }
}
