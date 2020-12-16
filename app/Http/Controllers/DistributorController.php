<?php

namespace App\Http\Controllers;

use App\Distributor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DistributorController extends Controller
{
    public function index()
    {
        $distributors = Distributor::all();

        return view('distributor.index', compact('distributors'));
    }

    public function create()
    {
        return view('distributor.create');
    }

    public function store(Request $request)
    {
        $requestData = $request->all();

        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'telefon' => 'required|string|max:255',
            'email' => 'required|string|max:255|email',
        ]);

        $requestData['umkm_id'] = Auth::user()->umkm()->first()->id;

        Distributor::create($requestData);

        return redirect()
            ->route('distributor.index')
            ->with('success', 'Distributor Berhasil Ditambahkan.');
    }

    public function edit(Request $request, $distributor)
    {
        $distributor = Distributor::find($distributor);

        return view('distributor.edit', compact('distributor'));
    }

    public function update(Request $request, $distributor)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'telefon' => 'required|string|max:255',
            'email' => 'required|string|max:255|email',
        ]);

        $distributor = Distributor::find($distributor);
        $distributor->update($request->all());

        return redirect()
            ->route('distributor.index')
            ->with('success', 'Distributor Berhasil Diubah.');
    }

    public function destroy(Request $request, $distributor)
    {
        $distributor = Distributor::find($distributor);
        $distributor->delete();

        return redirect()
            ->route('distributor.index')
            ->with('success', 'Distributor Berhasil Dihapus.');
    }
}
