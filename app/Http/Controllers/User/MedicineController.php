<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Medicine;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicineController extends Controller
{
    public function index()
    {
        $data = Medicine::with(['category', 'user'])->get();

        return view('pages.user.obat.index', compact('data'));
    }

    public function tambah()
    {
        return view('pages.user.obat.tambah');
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

            return redirect()->route('pegawai.obat.stok')->with('success', 'Stok berhasil ditambah!!');
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->route('pegawai.obat.stok')->with('error', 'Stok Gagal ditambah!!');
        }
    }
}
