<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Models\Regency;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function provinces()
    {
        return Province::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $provinces_id)
    {
        return Regency::where('province_id', $provinces_id)->get();
    }
}
