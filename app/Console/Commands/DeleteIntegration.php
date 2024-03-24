<?php

namespace App\Console\Commands;

use App\Enums\Marketplace;
use App\Models\Integration;
use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandAlias;

class DeleteIntegration extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "integration:delete {id}";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete an integration.';

    /**
     * Execute the console command.
     */
    public function handle() {
        $id = $this->argument('id');


        $integration = Integration::find($id);

        if (!isset($integration->id)) {
            $this->error("The specified integration '{$id}' is not valid.");
            return CommandAlias::FAILURE;
        }

        $integration->delete();

        $this->info('Integration updated successfully.');
    }
}
