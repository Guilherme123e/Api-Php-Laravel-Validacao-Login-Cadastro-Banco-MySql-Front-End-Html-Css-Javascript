<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
            if (!Schema::hasColumn('usuarios', 'nome')) {
                $table->string('nome', 100)->nullable(false);
            }
            if (!Schema::hasColumn('usuarios', 'cpf')) {
                $table->string('cpf', 11)->unique()->nullable(false);
            }
            if (!Schema::hasColumn('usuarios', 'rg')) {
                $table->string('rg', 20)->unique()->nullable(false);
            }
            if (!Schema::hasColumn('usuarios', 'data_nascimento')) {
                $table->date('data_nascimento')->nullable(false);
            }
            if (!Schema::hasColumn('usuarios', 'endereco')) {
                $table->string('endereco', 200)->nullable(false);
            }
            if (!Schema::hasColumn('usuarios', 'telefone')) {
                $table->string('telefone', 20)->nullable(false);
            }
            if (!Schema::hasColumn('usuarios', 'genero')) {
                $table->enum('genero', ['masculino', 'feminino', 'outro'])->nullable(false);
            }
            if (!Schema::hasColumn('usuarios', 'email')) {
                $table->string('email', 100)->unique()->nullable(false);
            }
            if (!Schema::hasColumn('usuarios', 'senha_hash')) {
                $table->string('senha_hash', 255)->nullable(false);
            }
        });
    }

    public function down(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->dropColumn([
                'nome', 'cpf', 'rg', 'data_nascimento', 'endereco', 'telefone', 'genero',
                'email', 'senha_hash'
            ]);
        });
    }
};
