<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('classification_details', function (Blueprint $table) {
            $table->decimal('numeric_value', 10, 4)->nullable()->after('input_value');
        });
    }

    public function down(): void
    {
        Schema::table('classification_details', function (Blueprint $table) {
            $table->dropColumn('numeric_value');
        });
    }
};
