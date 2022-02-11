<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Category::select(['id', 'name', 'created_at'])->latest()->get();

        return view('pages.admin.category.index', compact('data'));
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
            'name' => 'required|max:128',
        ]);
        try {
            $data = $request->all();
            Category::create($data);

            return redirect()->route('admin-page.category.index')->with('success', 'Kategori berhasil dibuat!!');
        } catch (Exception $e) {
            return redirect()->route('admin-page.category.index')->with('error', 'Kategori Gagal dibuat!!');
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
            'name' => 'required|max:128',
        ]);
        try {
            $data = $request->all();

            $category = Category::findOrFail($id);
            $category->update($data);

            return redirect()->route('admin-page.category.index')->with('success', 'Kategori berhasil diupdate!!');
        } catch (Exception $e) {
            return redirect()->route('admin-page.category.index')->with('error', 'Kategori Gagal diupdate!!');
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
            $category = Category::findOrFail($id);
            $category->delete();

            return redirect()->route('admin-page.category.index')->with('success', 'Kategori berhasil dihapus!!');
        } catch (Exception $e) {
            return redirect()->route('admin-page.category.index')->with('error', 'Kategori Gagal dihapus!!');
        }
    }
}
