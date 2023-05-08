<?php

namespace App\Http\Controllers;

use App\Models\BidangBahasa;
use App\Models\BidangIt;
use App\Models\BidangKarakter;
use App\Models\BidangTahfidz;
use App\Models\Catatan;
use App\Models\KelasPayung;
use App\Models\PlpBahasa;
use App\Models\PlpIt;
use App\Models\PlpKarakter;
use App\Models\PlpTahfidz;
use App\Models\Santri;
use App\Models\Student;
use App\Models\Teacher;
use App\Traits\HasTryCatch;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SantriController extends Controller
{
    use HasTryCatch;

    public function index(Request $request)
    {
        $kelas_payung = $request->kelas_payung ?? KelasPayung::first()->value('id');

        return Inertia::render('Santri/DaftarSantri', [
            'daftar' => Santri::isActive()
                ->with('student:id,nama,tanggal_lahir,foto')
                ->select('id', 'student_id')
                ->when(
                    $kelas_payung,
                    fn ($query) => $query->where('kelas_payung_id', $kelas_payung)
                )
                ->whereRelation('student', 'nama', 'like', "%$request->nama%")
                ->withKelasPayung()
                ->withKelasPondok()
                ->get()
                ->each(fn ($item) => $item->student->append('usia')),

            'kelas_payung' => KelasPayung::orderBy('kelas')->get(),
            'cari' => [
                'nama' => $request->nama,
                'kelas_payung' => $kelas_payung
            ]
        ]);
    }

    public function profil(Santri $santri)
    {
        $santri->load(['student' => fn ($query) => $query->withAyah(), 'kelasPayung', 'kelasPondok']);
        $santri->student->append('lahir');

        return Inertia::render('Santri/ProfilSantri', [

            // Profil
            'santri' => $santri,

            // Bidang
            'tahfidz' => BidangTahfidz::withPlp()
                ->firstWhere('santri_id', $santri->id),
            'it' => BidangIt::withPlp()
                ->firstWhere('santri_id', $santri->id),
            'bahasa' => BidangBahasa::withPlp()
                ->firstWhere('santri_id', $santri->id),
            'karakter' => BidangKarakter::withPlp()
                ->firstWhere('santri_id', $santri->id),

            // Catatan
            'catatan' => [
                'p' => $santri->catatans()->where('tipe', 'p')->take(5)->get(),
                'n' => $santri->catatans()->where('tipe', 'n')->take(5)->get()
            ],
        ]);
    }

    public function bidang(Request $request)
    {
        $student = Student::find($request->student_id);

        if ($request->bidang == 'tahfidz') {

            $plp = PlpTahfidz::all();
            $bidang = BidangTahfidz::withPlp()->find($request->santri_id);
            $daftar = $student
                ->bidangTahfidzs()
                ->withPlp()
                ->with([
                    'santri' => fn ($query) => $query
                        ->select('id', 'semester_id', 'kelas_payung_id')
                        ->with([
                            'semester:id,semester',
                            'kelasPayung:id,kelas',
                        ])
                ])->get();
        }

        if ($request->bidang == 'it') {

            $plp = PlpIt::all();
            $bidang = BidangIt::withPlp()->find($request->santri_id);
            $daftar = $student
                ->bidangIts()
                ->withPlp()
                ->with([
                    'santri' => fn ($query) => $query
                        ->select('id', 'semester_id', 'kelas_payung_id')
                        ->with([
                            'semester:id,semester',
                            'kelasPayung:id,kelas',
                        ])
                ])->get();
        }

        if ($request->bidang == 'bahasa') {

            $plp = PlpBahasa::all();
            $bidang = BidangBahasa::withPlp()->find($request->santri_id);
            $daftar = $student
                ->bidangBahasas()
                ->withPlp()
                ->with([
                    'santri' => fn ($query) => $query
                        ->select('id', 'semester_id', 'kelas_payung_id')
                        ->with([
                            'semester:id,semester',
                            'kelasPayung:id,kelas',
                        ])
                ])->get();
        }

        if ($request->bidang == 'karakter') {

            $plp = PlpKarakter::all();
            $bidang = BidangKarakter::withPlp()->find($request->santri_id);
            $daftar = $student
                ->bidangKarakters()
                ->withPlp()
                ->with([
                    'santri' => fn ($query) => $query
                        ->select('id', 'semester_id', 'kelas_payung_id')
                        ->with([
                            'semester:id,semester',
                            'kelasPayung:id,kelas',
                        ])
                ])->get();
        }

        return Inertia::render('Santri/BidangSantri', [
            'daftar' => $daftar,
            'bidang' => $bidang,
            'tipe' => $request->bidang,
            'list_plp' => $plp
        ]);
    }

    public function catatan(Request $request, Santri $santri)
    {
        return Inertia::render('Santri/CatatanSantri', [
            'tipe' => $request->tipe,
            'santri' => $santri,
            'catatan' => $santri->catatans()
                ->with('teacher:id,nama,jabatan')
                ->where('tipe', $request->tipe)
                ->get(),
            'teacher' => Teacher::select('id', 'nama')->orderBy('nama')->get()
        ]);
    }

    // 

    public function bidangUpdate(Request $request)
    {
        $santri = Santri::find($request->santri_id);

        if ($request->bidang == 'tahfidz') {
            $santri = $santri->bidangTahfidz();
        }

        if ($request->bidang == 'it') {
            $santri = $santri->bidangIt();
        }

        if ($request->bidang == 'bahasa') {
            $santri = $santri->bidangBahasa();
        }

        if ($request->bidang == 'karakter') {
            $santri = $santri->bidangKarakter();
        }

        $alert = $this::execute(
            try: fn () => $santri->update($request->except(['bidang', 'santri_id'])),
            message: 'update plp'
        );

        return back()->with('alert', $alert);
    }

    public function catatanStore(Request $request)
    {
        $alert = $this::execute(
            try: fn () => Catatan::create($request->input()),
            message: 'tambah catatan'
        );

        return back()->with('alert', $alert);
    }

    public function catatanUpdate(Request $request)
    {
        $alert = $this::execute(
            try: fn () => Catatan::where('id', $request->id)->update($request->input()),
            message: 'edit catatan'
        );

        return back()->with('alert', $alert);
    }
}
