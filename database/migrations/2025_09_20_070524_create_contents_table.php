<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentsTable extends Migration
{
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt');
            $table->longText('content');
            $table->string('category'); // berita, smanung_today, siswa_prestasi, agenda_sekolah
            $table->string('image')->nullable();
            $table->string('author');
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->date('published_date');
            $table->timestamps();
            
            $table->index(['category', 'status']);
            $table->index('published_date');
        });
    }

    public function down()
    {
        Schema::dropIfExists('contents');
    }
}