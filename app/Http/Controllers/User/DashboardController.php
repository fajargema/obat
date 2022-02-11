<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        $obat = Medicine::with(['category', 'user'])->count();
        $trans = Transaction::with(['medicine', 'user'])->count();

        $transaksi = Transaction::with(['medicine', 'user'])->limit(5)->get();
        return view('pages.user.index', compact('obat', 'trans', 'transaksi'));
    }
}
