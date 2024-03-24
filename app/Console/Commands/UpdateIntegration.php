<?php

namespace App\Console\Commands;

use App\Enums\Marketplace;
use App\Models\Integration;
use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandAlias;

class UpdateIntegration extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "integration:update {id} {marketplace} {username?} {password?}";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update an integration to the system.';

    /**
     * Execute the console command.
     */
    public function handle() {
        $id          = $this->argument('id');
        $marketplace = $this->argument('marketplace');
        $username    = $this->argument('username');
        $password    = $this->argument('password');


        $integration = Integration::find($id);

        if(!isset($integration->id)){
            $this->error("The specified integration '{$id}' is not valid.");
            return CommandAlias::FAILURE;
        }



        if (!Marketplace::tryFrom($marketplace)) {
            $this->error("The specified marketplace '{$marketplace}' is not valid.");
            return CommandAlias::FAILURE;
        }


        $integration->marketplace = $marketplace;

        if($username || strlen($username) >0){
            $integration->username    = $username;
        }
        if($password || strlen($password) >0){
            $integration->password    = $password;
        }
        $integration->save();

        $this->info('Integration updated successfully.');
    }
}
