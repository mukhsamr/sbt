<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlpKarakterRequest;
use App\Models\PlpKarakter;
use App\Traits\HasTryCatch;
use Inertia\Inertia;

class PlpKarakterController extends Controller
{
    use HasTryCatch;

    public function index()
    {
        return Inertia::render('PLP/PlpKarakter', [
            'daftar' => PlpKarakter::withCount('santris')->orderBy('plp')->get()
        ]);
    }

    public function store(PlpKarakterRequest $request)
    {
        $alert = $this::execute(
            try: fn () => PlpKarakter::create($request->input()),
            message: 'tambah plp'
        );

        return back()->with('alert', $alert);
    }

    public function update(PlpKarakterRequest $request)
    {
        $alert = $this::execute(
            try: fn () => PlpKarakter::where('id', $request->id)->update(['plp' => $request->plp]),
            message: 'update plp'
        );

        return back()->with('alert', $alert);
    }

    public function destroy(PlpKarakter $plpKarakter)
    {
        $alert = $this::execute(
            try: fn () => $plpKarakter->delete(),
            message: 'hapus plp'
        );

        return back()->with('alert', $alert);
    }
}
