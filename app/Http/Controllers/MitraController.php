<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use Illuminate\Http\Request;

class MitraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filterableColumns = ['jenisMitra'];
        $searchableColumns = ['nama_mitra'];

        $pageData['dataMitra']= Mitra::filter($request, $filterableColumns, $searchableColumns)->paginate(10)->withQueryString();
        return view('admin.mitra.indexMitra',$pageData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.mitra.createMitra');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_mitra'=> ['required'],
            'email'=> ['required', 'email'],
            'phone'=> ['required', 'numeric'],
            'jenisMitra'=> ['required', 'in:Platinum,Gold,Silver'],
            'tanggal_bergabung'=> ['required', 'date'],
        ]);

        $data['nama_mitra'] = $request->nama_mitra;
        $data['alamat'] = $request->alamat;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['jenisMitra'] = $request->jenisMitra;
        $data['tanggal_bergabung'] = $request->tanggal_bergabung;

Mitra::create($data);

return redirect()->route('mitra.list')->with('success','Penambahan Data Berhasil!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $param1)
    {
        $pageData['dataMitra'] = Mitra::findOrFail($param1);
        return view('admin.mitra.editMitra',$pageData);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'nama_mitra' => ['required'],
            'email'      => ['required', 'email'],
            'phone'      => ['required', 'numeric'],
            'jenisMitra'  => ['required'],
            'tanggal_bergabung'   => ['required', 'date'],
            'jenisMitra'     => ['required', 'in:Platinum,Gold,Silver'],
        ]);

        $mitra_id = $request->mitra_id;
        $mitra = Mitra::findOrFail($mitra_id);

        $mitra->nama_mitra = $request->nama_mitra;
        $mitra->alamat = $request->alamat;
        $mitra->email = $request->email;
        $mitra->phone = $request->phone;
        $mitra->jenisMitra = $request->jenisMitra;
        $mitra->tanggal_bergabung = $request->tanggal_bergabung;
    $mitra->save();
    return redirect()->route('mitra.list')->with('success','Perubahan Data berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $param1)
    {
        $mitra = Mitra::findOrFail($param1);

        $mitra->delete();

        return redirect()->route('mitra.list')->with('success','Penghapusan Data Berhasil!');
    }
}
