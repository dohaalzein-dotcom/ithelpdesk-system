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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ReferenceNumber')->unique();
        $table->string('Title');
         $table->text('Description');

         $table->foreignId('CreatedByUserId')->constrained('users')->cascadeOnDelete();
         $table->foreignId('AssignedToUserId')->constrained('users')->cascadeOnDelete();

         $table->foreignId('CategoryId')->constrained('categories');
         $table->foreignId('PriorityId')->constrained('priorities');
         $table->foreignId('StatusId')->constrained('statuses');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
