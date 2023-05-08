<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SemesterController extends Controller
{
    public function index()
    {
        return Inertia::render('Semester', [
            'daftar' => Semester::orderBy('tahun')->get()
        ]);
    }
}
