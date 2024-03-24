<?php

namespace App\Http\Controllers;

use App\Http\Requests\IntegrationStoreRequest;
use App\Http\Requests\IntegrationUpdateRequest;
use App\Models\Integration;
use Illuminate\Http\Request;

class IntegrationController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(IntegrationStoreRequest $request) {

        // Entegrasyonu oluşturma
        $integration = Integration::create([
            'marketplace' => $request->input('marketplace'),
            'username'    => $request->input('username'),
            'password'    => $request->input('password')
        ]);

        // Oluşturulan entegrasyonu döndürme
        return response()->json($integration, 201);


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(IntegrationUpdateRequest $request, string $id) {
        $integration = Integration::findOr($id,
         fn () => abort(404,'Integration not found')
        );

        $integration->marketplace = $request->input('marketplace');
        $integration->username    = $request->input('username',null);
        $integration->password    = $request->input('password',null);
        $integration->save();

        return response()->json($integration, 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {

        $integration = Integration::findOr($id,
         fn () => abort(404,'Integration not found')
        );

        $integration->delete();

        return response()->json(null, 204);
    }
}
