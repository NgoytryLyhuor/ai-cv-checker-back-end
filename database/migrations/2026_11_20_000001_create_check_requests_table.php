<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('check_requests', function (Blueprint $table): void {
            $table->id();
            $table->uuid('token')->unique();
            $table->string('service', 20);
            $table->text('email')->nullable();
            $table->longText('text')->nullable();
            $table->longText('result_json')->nullable();
            $table->unsignedTinyInteger('score')->nullable();
            $table->string('status', 20)->index();
            $table->text('error_message')->nullable();
            $table->timestamp('consent_accepted_at');
            $table->timestamp('expires_at')->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('check_requests');
    }
};
