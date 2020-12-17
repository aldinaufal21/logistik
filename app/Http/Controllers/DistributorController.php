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

        $validator = Validator::make($requestData, [
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'telefon' => 'required|string|max:255',
            'email' => 'required|string|max:255|email',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('distributor.create')
                ->with('errors', $validator->errors());
        }

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
        $requestData = $request->all();

        $validator = Validator::make($requestData, [
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'telefon' => 'required|string|max:255',
            'email' => 'required|string|max:255|email',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('distributor.edit')
                ->with('errors', $validator->errors());
        }

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
