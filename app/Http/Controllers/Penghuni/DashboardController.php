<?php

namespace App\Http\Controllers\Penghuni;

use App\Models\Kamar;
use App\Models\Tipe_kamar;
use Illuminate\Http\Request;

class DashboardController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kategori = Tipe_kamar::all();

        $kamar = Kamar::with('tipe_kamar')
            ->when($request->kategori, function ($query) use ($request) {
                $query->whereHas('tipe_kamar', function ($q) use ($request) {
                    $q->where('tipe', $request->kategori);
                });
            })
            ->latest()
            ->get();

        return view('penghuni.dashboard', compact('kamar', 'kategori'));
    }

    public function show($id)
    {
        $kamar = Kamar::with('tipe_kamar')->findOrFail($id);

        return view('penghuni.kamar_detail', compact('kamar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
