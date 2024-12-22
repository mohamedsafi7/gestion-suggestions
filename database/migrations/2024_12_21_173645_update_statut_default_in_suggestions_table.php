<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateStatutDefaultInSuggestionsTable extends Migration
{
    public function up()
    {
        Schema::table('suggestions', function (Blueprint $table) {
            $table->string('statut')->nullable()->default('en attente')->change();
        });
    }

    public function down()
    {
        Schema::table('suggestions', function (Blueprint $table) {
            $table->string('statut')->nullable(false)->default('')->change();
        });
    }
}

