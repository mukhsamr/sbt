<?php

namespace App\Http\Controllers;

use App\Models\BidangBahasa;
use App\Models\BidangIt;
use App\Models\BidangKarakter;
use App\Models\BidangTahfidz;
use App\Models\Catatan;
use App\Models\KelasPayung;
use App\Models\KelasPondok;
use App\Models\PlpBahasa;
use App\Models\PlpIt;
use App\Models\PlpKarakter;
use App\Models\PlpTahfidz;
use App\Models\Santri;
use App\Models\Semester;
use App\Models\Student;
use App\Models\Teacher;
use App\Traits\HasTryCatch;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SantriController extends Controller
{
    use HasTryCatch;

    public function index(Request $request)
    {
        $request->limit ??= 10;

        return Inertia::render('Santri/DaftarSantri', [
            'daftar' => Santri::isActive()
                ->select('*')
                ->with(['student:id,nama,tanggal_lahir,foto', 'kelasPayung', 'kelasPondok'])

                ->when($request->limit, fn ($query) => $query->limit($request->limit))
                ->when($request->nama, fn ($query) => $query->whereRelation('student', 'nama', 'like', "%$request->nama%"))
                ->when($request->gender, fn ($query) => $query->whereRelation('student', 'gender',  $request->gender))
                ->when($request->kelas_payung, fn ($query) => $query->where('kelas_payung_id', $request->kelas_payung))

                ->get()
                ->sortBy('student.nama')
                ->each(fn ($item) => $item->student->append('usia'))
                ->values(),

            'kelas_payung' => KelasPayung::orderBy('kelas')->get(),
            'kelas_pondok' => KelasPondok::orderBy('kelas')->get(),
            'cari' => [
                'nama' => $request->nama,
                'kelas_payung' => $request->kelas_payung
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

            // List PLP
            'plpTahfidz' => PlpTahfidz::all(),
            'plpIt' => PlpIt::all(),
            'plpBahasa' => PlpBahasa::all(),
            'plpKarakter' => PlpKarakter::all(),

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

    public function assigne(Request $request)
    {
        return Inertia::render('Santri/AssigneSantri', [
            'siswa' => fn () => Student::select('id', 'foto', 'nama', 'gender')
                ->whereDoesntHave('santris', function (Builder $query) {
                    $query->isActive();
                })
                ->orderBy('nama')

                ->when($request->nama, fn ($query) => $query->where('nama', 'like', "%$request->nama%"))
                ->when($request->gender, fn ($query) => $query->where('gender', $request->gender))

                ->get(),

            'kelas_pondok' => KelasPondok::all(),
            'kelas_payung' => KelasPayung::all(),
        ]);
    }

    public function bidang(Request $request)
    {
        $student = Student::find($request->student_id);

        if ($request->bidang == 'tahfidz') {

            $bidang = BidangTahfidz::withPlp()->firstWhere('santri_id', $request->santri_id);
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

            $bidang = BidangIt::withPlp()->firstWhere('santri_id', $request->santri_id);
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

            $bidang = BidangBahasa::withPlp()->firstWhere('santri_id', $request->santri_id);
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

            $bidang = BidangKarakter::withPlp()->firstWhere('santri_id', $request->santri_id);
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

    public function assigneStore(Request $request)
    {
        $data = $request->input();
        $data['semester_id'] = Semester::active();

        $alert = $this::execute(
            try: fn () => Santri::create($data),
            message: "assigne siswa"
        );

        return back()->with('alert', $alert);
    }

    public function assigneUpdate(Request $request)
    {
        $alert = $this::execute(
            try: fn () => Santri::where('id', $request->id)->update([
                'kelas_payung_id' => $request->kelas_payung_id,
                'kelas_pondok_id' => $request->kelas_pondok_id,
            ]),
            message: 'update santri'
        );

        return back()->with('alert', $alert);
    }

    public function assigneRemove(Santri $santri)
    {
        $alert = $this::execute(
            try: fn () => $santri->delete(),
            message: 'hapus santri'
        );
        return back()->with('alert', $alert);
    }

    public function bidangStore(Request $request)
    {
        $alert = $this::execute(
            try: function () use ($request) {

                $this::createBidangTahfidz($request);
                $this::createBidangIt($request);
                $this::createBidangBahasa($request);
                $this::createBidangKarakter($request);
            },
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

    // ====

    private static function createBidangTahfidz($request)
    {
        BidangTahfidz::updateOrCreate([
            'santri_id' => $request->santri_id,
        ], [
            'santri_id' => $request->santri_id,
            'plp_tahfidz_id' => $request->tahfidz['plp_id'] ?: null,
            'kategori' => $request->tahfidz['kategori'] ?: null
        ]);
    }

    private static function createBidangIt($request)
    {
        BidangIt::updateOrCreate([
            'santri_id' => $request->santri_id,
        ], [
            'santri_id' => $request->santri_id,
            'plp_it_id' => $request->it['plp_id'] ?: null,
            'kategori' => $request->it['kategori'] ?: null
        ]);
    }

    private static function createBidangBahasa($request)
    {
        BidangBahasa::updateOrCreate([
            'santri_id' => $request->santri_id,
        ], [
            'santri_id' => $request->santri_id,
            'plp_bahasa_id' => $request->bahasa['plp_id'] ?: null,
            'kategori' => $request->bahasa['kategori'] ?: null
        ]);
    }

    private static function createBidangKarakter($request)
    {
        BidangKarakter::updateOrCreate([
            'santri_id' => $request->santri_id,
        ], [
            'santri_id' => $request->santri_id,
            'plp_karakter_id' => $request->karakter['plp_id'] ?: null,
            'kategori' => $request->karakter['kategori'] ?: null
        ]);
    }
}
