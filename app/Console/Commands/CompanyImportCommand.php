<?php

namespace App\Console\Commands;

use App\Services\Import\CompanyImportService;
use Illuminate\Console\Command;

class CompanyImportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'companies:import
    {fileName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import a csv with companies.';

    private CompanyImportService $importer;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        CompanyImportService $importer
    )
    {
        $this->importer = $importer;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $fileName = $this->argument('fileName');

        $this->importer->process($fileName);

        return 0;
    }
}
