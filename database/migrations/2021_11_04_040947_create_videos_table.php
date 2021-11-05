<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('status');
            $table->unsignedInteger('likes');
            $table->unsignedInteger('dislikes');
            $table->string('author');
            $table->timestamps();
            $table->rawIndex('
            case
                when status = "Pendiente" then 1
                when status = "Activo" then 2
                when status = "Cancelado" then 3
            end
            ', 'videos_status_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
