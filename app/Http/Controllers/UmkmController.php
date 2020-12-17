<?php

namespace App\Http\Controllers;

use App\Umkm;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UmkmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $umkms = Umkm::all();
        
        return view('umkm.index', compact('umkms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('umkm.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestData = $request->all();

        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'username' => 'required|string|unique:users',
            'password' => 'required|string',
        ]);

        $imageName = time().'.'.$request->gambar->extension();  
   
        $request->gambar->move(public_path('images'), $imageName);

        User::create([
            'name' => $request->nama,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 2,
        ]);

        $user = User::where('username', $request->username)->first();

        Umkm::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'alamat' => $request->alamat,
            'gambar' => $imageName,
            'user_id' => $user->id,
        ]);

        return redirect()
            ->route('umkm.index')
            ->with('success', 'Umkm Berhasil Ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $umkm = Umkm::find($id);

        return view('umkm.edit', compact('umkm'));
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
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $umkm = Umkm::find($id);
        $umkm->nama = $request->nama;
        $umkm->deskripsi = $request->deskripsi;
        $umkm->alamat = $request->alamat;

        $imageName = time().'.'.$request->gambar->extension();  
   
        $request->gambar->move(public_path('images'), $imageName);

        $umkm->gambar = $imageName;

        $umkm->update();

        $user = User::find($umkm->user_id);

        $user->name = $request->nama;
        
        $user->update();

        return redirect()
            ->route('umkm.index')
            ->with('success', 'Umkm Berhasil Diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $umkm = Umkm::find($id);
        $umkm->delete();

        $user = User::find($umkm->user_id);
        $user->delete();

        return redirect()
            ->route('umkm.index')
            ->with('success', 'Umkm Berhasil Dihapus.');
    }
}
