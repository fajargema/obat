<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Transaction::with(['medicine', 'user'])->latest()->get();

        return view('pages.user.transaksi.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.user.transaksi.jual');
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
            'jk' => 'required',
            'jumlah' => 'required',
            'medicines_id' => 'required',
        ]);
        try {
            $obat = Medicine::where('id', $request->medicines_id)->first();
            $harga = $obat->harga;

            $awal = 'TRX';
            $akhir = Transaction::max('id');

            $total = $harga * $request->jumlah;

            $data = $request->all();
            $data['kode'] = $awal . '-' . sprintf("%04s", abs($akhir + 1)) . '-' . date('dmY');
            $data['total'] = $total;
            $data['users_id'] = Auth::user()->id;

            Transaction::create($data);

            return redirect()->route('pegawai.transaction.index')->with('success', 'Transaksi berhasil ditambah!!');
        } catch (Exception $e) {
            return redirect()->route('pegawai.transaction.index')->with('error', 'Transaksi Gagal ditambah!!');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
