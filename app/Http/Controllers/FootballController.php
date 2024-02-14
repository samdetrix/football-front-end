<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\FootballTeam;
use Illuminate\Support\Carbon;


class FootballController extends Controller
{



    public function fetchAndSave()
    {
        try {
            $today = Carbon::today()->toDateString();
            $response = Http::withHeaders([
                'x-rapidapi-host' => 'v3.football.api-sports.io',
                'x-rapidapi-key' => '59b30dd0a12c673808c1005ba17923cc',
            ])->get('https://v3.football.api-sports.io/fixtures', [
                        'date' => $today,
                    ]);

            $data = $response->json();
            // dd($data);

            if (isset($data['get']) && $data['get'] === 'fixtures') {
                if (isset($data['response']) && is_array($data['response'])) {
                    $fixtures = $data['response'];

                    foreach ($fixtures as $fixture) {
                        FootballTeam::create([
                            'home_team' => $fixture['teams']['home']['name'],
                            'away_team' => $fixture['teams']['away']['name'],
                            'league_id' => $fixture['league']['id'],
                            'league_name' => $fixture['league']['name'],
                            'league_country' => $fixture['league']['country'],
                            'league_logo' => $fixture['league']['logo'] ?? null,
                            'league_flag' => $fixture['league']['flag'] ?? null,
                            'league_season' => $fixture['league']['season'],
                            'league_round' => $fixture['league']['round'],
                        ]);
                    }

                    return "Data fetched and saved successfully!";
                } else {
                    return "Invalid response format: 'response' key not found or not an array.";
                }
            } else {
                return "Invalid response format: 'get' key not found or not equal to 'fixtures'.";
            }
        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }
    public function fetchSavedFeatures()
    {
        $matches = FootballTeam::latest()->limit(10)->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Matches fetched successfully',
            'data' => $matches
        ]);
    }

    public function fetchSingleMatch($match_id)
    {
        $match = FootballTeam::find($match_id);

        if (!$match) {
            return response()->json([
                'status' => 'error',
                'message' => 'Match not found',
                'data' => null,
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Match fetched successfully',
            'data' => $match,
        ]);
    }
}
