<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use League\Csv\Writer;

class ExportCommentsCsvCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'chismes:comments-csv {--start_date=} {--end_date=}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export the chismes comments to a CSV';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $startDate = $this->option('start_date');
        $endDate = $this->option('end_date');

        $query = DB::table('chisme_comments');

        if ($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        }

        $data = $query->get()->toArray();

        if (empty($data)) {
            $this->info("No comments found.");
            return;
        }

        $csvFileName = "chisme_comments_".now()->format('Ymd_His').'.csv';
        $csvFilePath = storage_path("app/{$csvFileName}");

        $csv = Writer::createFromPath($csvFilePath, 'w+');
        $csv->insertOne(array_keys((array) $data[0])); // Write header

        foreach ($data as $row) {
            $csv->insertOne((array) $row);
        }

        $this->info("CSV Comments file created: {$csvFilePath}");
    }
}
