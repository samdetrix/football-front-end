<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Http;
use App\Models\FootballTeam;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;


class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            $this->updateFixtures();
        })->everyTwoMinutes(); 
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }


    // app/Console/Kernel.php



    private function updateFixtures()
    {
        try {
            $today = now()->toDateString(); 

            $response = Http::withHeaders([
                'x-rapidapi-host' => 'v3.football.api-sports.io',
                'x-rapidapi-key' => '59b30dd0a12c673808c1005ba17923cc',
            ])->get('https://v3.football.api-sports.io/fixtures', [
                        'date' => $today,
                    ]);

            $data = $response->json();

            if (isset($data['get']) && $data['get'] === 'fixtures') {
                if (isset($data['response']) && is_array($data['response'])) {
                    $fixtures = $data['response'];

                    foreach ($fixtures as $fixture) {
                        FootballTeam::updateOrCreate(
                            [
                                'home_team' => $fixture['teams']['home']['name'],
                                'away_team' => $fixture['teams']['away']['name'],
                                'league_id' => $fixture['league']['id'],
                            ],
                            [
                                'league_name' => $fixture['league']['name'],
                                'league_country' => $fixture['league']['country'],
                                'league_logo' => $fixture['league']['logo'] ?? null,
                                'league_flag' => $fixture['league']['flag'] ?? null,
                                'league_season' => $fixture['league']['season'],
                                'league_round' => $fixture['league']['round'],
                            ]
                        );
                    }

                    Log::info('Data updated successfully!');
                } else {
                    Log::error("Invalid response format: 'response' key not found or not an array.");
                }
            } else {
                Log::error("Invalid response format: 'get' key not found or not equal to 'fixtures'.");
            }
        } catch (\Exception $e) {
            Log::error("Error: " . $e->getMessage());
        }
    }

}
