<?php

namespace App\Services;

use App\Models\Integration;

class IntegrationService {
    public function createIntegration(array $data): Integration {
        return Integration::create($data);
    }

    public function updateIntegration($id, array $newData) {
        $integration = Integration::findOrFail($id);
        $integration->update($newData);
        return $integration;
    }

    public function deleteIntegration($id) {
        $integration = Integration::findOrFail($id);
        $integration->delete();
    }

}
