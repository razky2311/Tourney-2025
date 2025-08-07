<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Team;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('games', function (Blueprint $table) {
    $table->id();
    $table->foreignIdFor(Team::class, 'team1_id')->constrained('teams')->cascadeOnDelete();
    $table->foreignIdFor(Team::class, 'team2_id')->constrained('teams')->cascadeOnDelete();
    $table->foreignIdFor(Team::class, 'winner_id')->nullable()->constrained('teams')->nullOnDelete();
    $table->dateTime('game_date');
    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
