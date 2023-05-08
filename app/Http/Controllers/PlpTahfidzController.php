<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlpTahfidzRequest;
use App\Models\PlpTahfidz;
use App\Traits\HasTryCatch;
use Inertia\Inertia;

class PlpTahfidzController extends Controller
{
    use HasTryCatch;

    public function index()
    {
        return Inertia::render('PLP/PlpTahfidz', [
            'daftar' => PlpTahfidz::withCount('santris')->orderBy('plp')->get()
        ]);
    }

    public function store(PlpTahfidzRequest $request)
    {
        $alert = $this::execute(
            try: fn () => PlpTahfidz::create($request->input()),
            message: 'tambah plp'
        );

        return back()->with('alert', $alert);
    }

    public function update(PlpTahfidzRequest $request)
    {
        $alert = $this::execute(
            try: fn () => PlpTahfidz::where('id', $request->id)->update(['plp' => $request->plp]),
            message: 'update plp'
        );

        return back()->with('alert', $alert);
    }

    public function destroy(PlpTahfidz $plpTahfidz)
    {
        $alert = $this::execute(
            try: fn () => $plpTahfidz->delete(),
            message: 'hapus plp'
        );

        return back()->with('alert', $alert);
    }
}
