<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{
    private $defaultMoves = ['Rock', 'Paper', 'Scissors'];

    public function play(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'choice' => 'required|string',
            'customMoves' => 'nullable|array', // Allows custom moves
        ]);

        // Get user choice and custom moves (if provided)
        $playerMove = ucfirst(strtolower($validated['choice'])); // Capitalize first letter
        $moves = $validated['customMoves'] ?? $this->defaultMoves; // Use custom or default moves

        // Validate player choice exists in moves
        if (!in_array($playerMove, $moves)) {
            return response()->json([
                'error' => 'Invalid move',
                'validMoves' => $moves
            ], 400);
        }

        // AI selects a random move
        $aiMove = $moves[array_rand($moves)];

        // ✅ FIXED: Correct logic for determining the winner
        $winner = $this->determineWinner($aiMove, $playerMove);

        return response()->json([
            'player1' => $aiMove, // AI's move
            'player2' => $playerMove, // User's move
            'winner'  => $winner,
        ]);
    }

    /**
     * Determine the winner based on the correct rock-paper-scissors logic.
     */
    private function determineWinner($p1, $p2)
    {
        if ($p1 === $p2) {
            return 'Tie';
        }

        // ✅ FIXED: Correct logic where Rock > Scissors, Scissors > Paper, Paper > Rock
        if (
            ($p1 === 'Rock' && $p2 === 'Scissors') || // AI wins
            ($p1 === 'Scissors' && $p2 === 'Paper') || // AI wins
            ($p1 === 'Paper' && $p2 === 'Rock') // AI wins
        ) {
            return 'Player 1'; // AI wins
        }

        return 'Player 2'; // User wins
    }
}
