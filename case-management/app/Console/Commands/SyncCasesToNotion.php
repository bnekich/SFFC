<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class SyncCasesToNotion extends Command
{
    protected $signature = 'sync:cases-to-notion';
    protected $description = 'Sync active cases from GoDaddy MariaDB to Notion';

    public function handle()
    {
        // Fetch data from stored procedure
        try {
            $cases = DB::connection('godaddy_mysql')
                ->select('CALL GetActiveCases()');
        } catch (\Exception $e) {
            $this->error('Failed to fetch cases: ' . $e->getMessage());
            return 1;
        }

        // Prepare Notion API request
        $notionToken = config('services.notion.api_token');
        $databaseId = config('services.notion.database_id');
        $url = 'https://api.notion.com/v1/pages';

        foreach ($cases as $case) {
            $payload = [
                'parent' => ['database_id' => $databaseId],
                'properties' => [
                    'Case' => [
                        'title' => [
                            [
                                'text' => ['content' => $case->Case]
                            ],
                        ]
                    ],
                    'Description' => [
                        'rich_text' => [
                            ['text' => ['content' => $case->Description]],
                        ],
                    ],
                    'Opened' => [
                        'date' => ['start' => $case->Opened],
                    ],
                ],
            ];

            try {
                $response = Http::withHeaders([
                    'Authorization' => "Bearer $notionToken",
                    'Notion-Version' => '2022-06-28',
                    'Content-Type' => 'application/json',
                ])->post($url, $payload);

                if ($response->successful()) {
                    $this->info("Synced case ID {$case->Case} to Notion");
                } else {
                    $this->error("Failed to sync case ID {$case->Case}: " . $response->body());
                }
            } catch (\Exception $e) {
                $this->error("Error syncing case ID {$case->Case}: " . $e->getMessage());
            }
        }

        $this->info('Sync completed.');
        return 0;
    }
}
