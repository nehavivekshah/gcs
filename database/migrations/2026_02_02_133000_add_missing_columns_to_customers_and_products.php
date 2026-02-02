<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            if (!Schema::hasColumn('customers', 'username')) {
                $table->string('username')->unique()->nullable()->after('customer_code');
            }
            if (!Schema::hasColumn('customers', 'department')) {
                $table->string('department')->nullable()->after('email');
            }
            if (!Schema::hasColumn('customers', 'designation')) {
                $table->string('designation')->nullable()->after('department');
            }
        });

        Schema::table('customer_products', function (Blueprint $table) {
            if (!Schema::hasColumn('customer_products', 'product_uin')) {
                $table->string('product_uin')->nullable()->after('quantity');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn(['username', 'department', 'designation']);
        });

        Schema::table('customer_products', function (Blueprint $table) {
            $table->dropColumn(['product_uin']);
        });
    }
};
