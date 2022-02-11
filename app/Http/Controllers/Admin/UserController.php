<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::latest()->get();
        return view('pages.admin.user.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => 'required|min:3|max:255',
            'nip' => 'required',
            'email' => 'required|string|email|unique:users',
            'roles' => 'required',
        ]);
        try {

            $data = $request->all();
            $data['password'] = Hash::make('1234');

            User::create($data);

            return redirect()->route('admin-page.user.index')->with('success', 'Pegawai berhasil ditambah!!');
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->route('admin-page.user.index')->with('error', 'Pegawai Gagal ditambah!!');
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
        $request->validate([
            'name' => 'required',
            'nip' => 'required',
            'email' => 'required|string|email|',
            'roles' => 'required'
        ]);
        try {
            $data = $request->all();

            $profil = User::findOrFail($id);
            $profil->update($data);

            return redirect()->route('admin-page.user.index')->with('success', 'Profile berhasil diubah!!');
        } catch (Exception $e) {
            return redirect()->route('admin-page.user.index')->with('error', 'Profile Gagal diubah!!');
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
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('admin-page.user.index')->with('success', 'Pegawai berhasil dihapus!!');
        } catch (Exception $e) {
            return redirect()->route('admin-page.user.index')->with('error', 'Pegawai Gagal dihapus!!');
        }
    }
}
