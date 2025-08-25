<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixUsernameInUsersTable extends Migration
{
    public function up(): void
    {
        // Remplir les valeurs NULL
        \DB::table('users')->whereNull('username')->update(['username' => \DB::raw('CONCAT("user_", id)')]);

        // Supprimer les doublons
        \DB::statement('UPDATE users SET username = CONCAT(username, "_", id) WHERE id IN (
            SELECT id FROM (
                SELECT id FROM users WHERE username IN (
                    SELECT username FROM users GROUP BY username HAVING COUNT(*) > 1
                ) AND id != (SELECT MIN(id) FROM users u2 WHERE u2.username = users.username)
            ) AS sub
        )');

        // Supprimer la contrainte UNIQUE si elle existe
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique('users_username_unique');
        });

        // Appliquer la contrainte UNIQUE
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->change();
        });
    }
};
