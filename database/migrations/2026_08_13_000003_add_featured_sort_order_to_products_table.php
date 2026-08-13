<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('products', 'featured_sort_order')) {
            Schema::table('products', function (Blueprint $table) {
                $table->integer('featured_sort_order')->default(0)->after('sort_order');
            });

            // Initialize featured_sort_order for existing featured products sequentially
            $featuredProducts = DB::table('products')->where('is_popular', true)->orderBy('id', 'asc')->get();
            foreach ($featuredProducts as $index => $fp) {
                DB::table('products')->where('id', $fp->id)->update([
                    'featured_sort_order' => $index + 1
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('products', 'featured_sort_order')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('featured_sort_order');
            });
        }
    }
};
