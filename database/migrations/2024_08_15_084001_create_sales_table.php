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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId("customers_id")->constrained()->onUpdate("cascade")->onDelete("cascade");
            $table->foreignId("categories_id")->constrained()->onUpdate("cascade")->onDelete("cascade");
            $table->foreignId("purchases_id")->constrained()->onUpdate("cascade")->onDelete("cascade");
            $table->integer("quantity");
            $table->decimal("price", 8, 2);
            $table->decimal("total", 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
