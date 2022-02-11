<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\MedicineImport;
use App\Models\Category;
use App\Models\Medicine;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Medicine::with(['category', 'user'])->get();

        return view('pages.admin.obat.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::select(['id', 'name'])->get();
        return view('pages.admin.obat.add', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'satuan' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'tgl_masuk' => 'required',
            'produsen' => 'required',
            'distributor' => 'required',
            'categories_id' => 'required',
        ]);
        try {
            $kat = Category::where('id', $request->categories_id)->first();
            $nk = $kat->name;
            $potong = substr($nk, 0, 3);
            $awal = $potong;
            $akhir = Medicine::max('id');

            $data = $request->all();
            $data['kode'] = $awal . '-' . sprintf("%03s", abs($akhir + 1)) . '-' . date('dmY');
            $data['users_id'] = Auth::user()->id;

            Medicine::create($data);

            return redirect()->route('admin-page.medicine.index')->with('success', 'Obat berhasil ditambah!!');
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->route('admin-page.medicine.index')->with('error', 'Obat Gagal ditambah!!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Medicine::with(['category', 'user'])->findOrFail($id);

        return view('pages.admin.obat.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::select(['id', 'name'])->get();

        $data = Medicine::findOrFail($id);

        return view('pages.admin.obat.edit', compact('data', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'satuan' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'tgl_masuk' => 'required',
            'produsen' => 'required',
            'distributor' => 'required',
            'categories_id' => 'required',
        ]);
        try {
            $medicine = Medicine::findOrFail($id);

            $old = $medicine->kode;
            $kat = Category::where('id', $request->categories_id)->first();
            $number = substr($kat->name, 0, 3);
            $potong = substr($old, 4, -9);
            $awal = $number;
            $akhir = $potong;

            $data = $request->all();
            $data['kode'] = $awal . '-' . $akhir . '-' . date('dmY');
            $data['users_id'] = Auth::user()->id;

            $medicine->update($data);

            return redirect()->route('admin-page.medicine.index')->with('success', 'Obat berhasil diubah!!');
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->route('admin-page.medicine.index')->with('error', 'Obat Gagal diubah!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $medicine = Medicine::findOrFail($id);
            $medicine->delete();

            return redirect()->route('admin-page.medicine.index')->with('success', 'Obat berhasil dihapus!!');
        } catch (Exception $e) {
            return redirect()->route('admin-page.medicine.index')->with('error', 'Obat Gagal dihapus!!');
        }
    }

    public function tambahStok()
    {

        return view('pages.admin.obat.stok');
    }

    function cariObat(Request $request)
    {
        $optional = explode("/", $request->nama);

        if (count($optional) == 2) {

            $data = Medicine::where('nama', 'like', '%' . $request->nama . '%')->orWhere('kode', 'like', '%' . $optional[1] . '%')->with(['category', 'user'])->limit(50)->orderBy('nama', 'asc')->get();


            return response()->json($data, 200);
        } else {
            $data = Medicine::where('nama', 'like', '%' . $request->nama . '%')->with(['category', 'user'])->limit(50)->get();

            return response()->json($data, 200);
        }
    }

    public function simpan(Request $request)
    {
        try {
            $id = $request->id;
            $medicine = Medicine::findOrFail($id);
            $old = $medicine->stok;
            $new = $request->stok;
            $total = $old + $new;

            $data = $request->all();
            $data['stok'] = $total;

            $medicine->update($data);

            return redirect()->route('admin-page.medicine.index')->with('success', 'Stok berhasil ditambah!!');
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->route('admin-page.medicine.index')->with('error', 'Stok Gagal ditambah!!');
        }
    }

    public function importExcel(Request $request)
    {
        try {
            $file = $request->file('file');
            Excel::import(new MedicineImport, $file);

            return redirect()->route('admin-page.medicine.index')->with('success', 'Obat berhasil Diupload!!');
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->route('admin-page.medicine.index')->with('error', 'Obat Gagal diupload!!');
        }
    }
}
