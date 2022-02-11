<?php

namespace App\Http\Controllers\Admin;

use App\Exports\TransactionExport;
use App\Http\Controllers\Controller;
use App\Models\Medicine;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;

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

        return view('pages.admin.transaksi.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.transaksi.jual');
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

            return redirect()->route('admin-page.transaction.index')->with('success', 'Transaksi berhasil ditambah!!');
        } catch (Exception $e) {
            return redirect()->route('admin-page.transaction.index')->with('error', 'Transaksi Gagal ditambah!!');
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
        try {
            $transaction = Transaction::findOrFail($id);
            $transaction->delete();

            return redirect()->route('admin-page.transaction.index')->with('success', 'Transaksi berhasil dihapus!!');
        } catch (Exception $e) {
            return redirect()->route('admin-page.transaction.index')->with('error', 'Transaksi Gagal dihapus!!');
        }
    }

    public function cariTransaksi()
    {
        return view('pages.admin.laporan.cari');
    }

    public function reportFind(Request $request)
    {
        $from = $request->from;
        $to = $request->to;

        $transaction = Transaction::whereBetween('created_at', [$from . " 00:00:00", $to . " 23:59:59"])->get();
        $total = $transaction->sum('total');
        return view('pages.admin.laporan.transaksi', compact('transaction', 'from', 'to', 'total'));
    }

    public function reportExcel(Request $request)
    {
        $excel = new TransactionExport;
        $excel->setPeriode($request->from, $request->to);

        return Excel::download($excel, 'Laporan Transaksi Periode ' . Carbon::parse($request->from)->format('d M Y') . '-' . Carbon::parse($request->to)->format('d M Y') . '.xlsx');
    }

    public function reportPDF(Request $request)
    {
        $from = $request->from;
        $to = $request->to;

        $data = Transaction::whereBetween('created_at', [$from . " 00:00:00", $to . " 23:59:59"])->get();
        $total = $data->sum('total');

        $pdf = PDF::loadView('pages.admin.laporan.transaksi-pdf', compact('data', 'total', 'from', 'to'));

        return $pdf->download('Laporan Transaksi Periode ' . Carbon::parse($from)->format('d M Y') . '-' . Carbon::parse($to)->format('d M Y') . '.pdf');
    }

    public function reportPrintPDF(Request $request)
    {
        $from = $request->from;
        $to = $request->to;

        $data = Transaction::whereBetween('created_at', [$from . " 00:00:00", $to . " 23:59:59"])->get();
        $total = $data->sum('total');

        return view('pages.admin.laporan.transaksi-pdf', compact('data', 'from', 'to', 'total'));
    }
}
