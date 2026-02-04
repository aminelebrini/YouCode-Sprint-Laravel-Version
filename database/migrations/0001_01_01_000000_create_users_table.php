<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role')->default('Etudiant');
            $table->timestamps();
        });

        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->integer('nombre');
            $table->string('promo');
            $table->integer('taux');
            $table->timestamps();
        });

        Schema::create('sprints', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->timestamp('date_debut');
            $table->timestamp('date_fin');
            $table->foreignId('classe_id')->nullable()->constrained('classes')->nullOnDelete();
        });

        Schema::create('etudiants', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->integer('level')->nullable();
            $table->foreignId('classe_id')->nullable()->constrained('classes')->nullOnDelete();
        });

        Schema::create('formateurs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->nullOnDelete();
            $table->string('username');
        });

        Schema::create('formateurs_classe', function (Blueprint $table) {
            $table->id();
            $table->foreignId('formateur_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('classe_id')->nullable()->constrained('classes')->nullOnDelete();
        });

        Schema::create('briefs', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->text('description');
            $table->string('type');
            $table->foreignId('sprint_id')->nullable()->constrained('sprints')->nullOnDelete();
            $table->timestamp('date_debut');
            $table->timestamp('date_fin');
            $table->unsignedBigInteger('formateur_id')->nullable();
            $table->foreign('formateur_id')->references('user_id')->on('formateurs')->onDelete('set null');
        });

        Schema::create('rendu', function (Blueprint $table) {
            $table->id();
            $table->text('text');
            $table->text('description');
            $table->string('link');
            $table->timestamp('date_soumission');
        });

        Schema::create('rendu_etudiant', function (Blueprint $table) {
            $table->id();
            $table->foreignId('etudiant_id')->nullable()->constrained('etudiants')->nullOnDelete();
            $table->foreignId('rendu_id')->nullable()->constrained('rendu')->nullOnDelete();
            $table->foreignId('brief_id')->nullable()->constrained('briefs')->nullOnDelete();
        });

        Schema::create('competences', function (Blueprint $table) {
            $table->id();
            $table->text('nom');
            $table->timestamp('created_at');
        });

        Schema::create('competence_brief', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brief_id')->nullable()->constrained('briefs')->nullOnDelete();
            $table->foreignId('competence_id')->nullable()->constrained('competences')->nullOnDelete();
            $table->timestamp('created_at');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('briefs', function (Blueprint $table) {
            $table->dropForeign(['formateur_id']);
            $table->dropColumn('formateur_id');
        });
        Schema::dropIfExists('competence_brief');
        Schema::dropIfExists('competences');
        Schema::dropIfExists('rendu_etudiant');
        Schema::dropIfExists('rendu');
        Schema::dropIfExists('briefs');
        Schema::dropIfExists('formateurs_classe');
        Schema::dropIfExists('formateurs');
        Schema::dropIfExists('etudiants');
        Schema::dropIfExists('sprints');
        Schema::dropIfExists('classes');
        Schema::dropIfExists('users');

    }

};
