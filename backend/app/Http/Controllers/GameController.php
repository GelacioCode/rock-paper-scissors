<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GameController extends Controller
{
    private $defaultMoves = ['Rock', 'Paper', 'Scissors'];

    public function play(Request $request)
    {
        $validated = $request->validate([
            'choice' => 'required|string',
        ]);

        $playerMove = ucfirst(strtolower($validated['choice']));
        $aiMove = $this->defaultMoves[array_rand($this->defaultMoves)];
        $winner = $this->determineWinner($playerMove, $aiMove);

        // Store the result in session
        $this->storeRoundResult($playerMove, $aiMove, $winner);

        return response()->json([
            'player1' => $aiMove,  // AI's move
            'player2' => $playerMove, // User's move
            'winner'  => $winner,
        ]);
    }

    private function determineWinner($p1, $p2)
    {
        if ($p1 === $p2) return 'Tie';

        if (
            ($p1 === 'Rock' && $p2 === 'Scissors') ||
            ($p1 === 'Scissors' && $p2 === 'Paper') ||
            ($p1 === 'Paper' && $p2 === 'Rock')
        ) {
            return 'Player 2';  // User wins
        }

        return 'Player 1';  // AI wins
    }

    private function storeRoundResult($playerMove, $aiMove, $winner)
    {
        $rounds = Session::get('match_results', []);

        $rounds[] = [
            'player1' => $aiMove,
            'player2' => $playerMove,
            'winner'  => $winner,
        ];

        Session::put('match_results', $rounds);
    }

    public function getSummary()
    {
        $rounds = Session::get('match_results', []);
        $totalRounds = count($rounds);
        $player1Wins = 0;
        $player2Wins = 0;
        $ties = 0;

        foreach ($rounds as $round) {
            if ($round['winner'] === 'Player 1') {
                $player1Wins++;
            } elseif ($round['winner'] === 'Player 2') {
                $player2Wins++;
            } else {
                $ties++;
            }
        }

        // Compute win percentages
        $player1WinPercentage = $totalRounds > 0 ? round(($player1Wins / $totalRounds) * 100) . '%' : '0%';
        $player2WinPercentage = $totalRounds > 0 ? round(($player2Wins / $totalRounds) * 100) . '%' : '0%';

        return response()->json([
            'total_rounds' => $totalRounds,
            'player1_wins' => $player1Wins,
            'player2_wins' => $player2Wins,
            'ties' => $ties,
            'player1_win_percentage' => $player1WinPercentage,
            'player2_win_percentage' => $player2WinPercentage
        ]);
    }
}
