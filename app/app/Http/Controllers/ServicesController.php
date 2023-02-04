<?php

namespace App\Http\Controllers;

use App\Http\Resources\Service\ServiceResource;
use App\Models\Service;

/**
 * Class ServicesController
 */
class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $services = Service::query()->active()->get();

        return ServiceResource::collection($services);
    }
}
