<?php

namespace App\Console\Commands;

use App\Enums\Marketplace;
use App\Models\Integration;
use App\Services\IntegrationService;
use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandAlias;

class AddIntegration extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "integration:add {marketplace} {username?} {password?}";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a new integration to the system.';

    /**
     * Execute the console command.
     */
    public function handle() {
        $marketplace = $this->argument('marketplace');
        $username    = $this->argument('username');
        $password    = $this->argument('password');


        if (!Marketplace::tryFrom($marketplace)) {
            $this->error("The specified marketplace '{$marketplace}' is not valid.");
            return CommandAlias::FAILURE;
        }
        if (!$username || strlen($username) < 1) {
            $username = null;
        }
        if (!$password || strlen($password) < 1) {
            $password = null;
        }


        $service = new IntegrationService();

        $service->createIntegration([
            'marketplace' => $marketplace,
            'username'    => $username,
            'password'    => $password,
        ]);

        $this->info('Integration added successfully.');
    }
}
