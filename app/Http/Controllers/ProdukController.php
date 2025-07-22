<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filterableColumns = ['kategori'];
        $searchableColumns = ['nama_produk'];

        $pageData['dataProduk'] = Produk::filter($request, $filterableColumns, $searchableColumns)->paginate(10)->withQueryString();
        return view('admin.produk.indexProduk',$pageData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.produk.createProduk');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk'=> ['required'],
            'kategori'=> ['required', 'in:barang,makanan,minuman'],
            'tgl_masuk'=> ['required', 'date'],
            'tgl_expired'=> ['required', 'date'],
            'Mitra'=> ['required'],
            'gambar' => ['required', 'image', 'max:2048'],
        ]);

        $produk = [
            'nama_produk' => $request->nama_produk,
            'kategori' => $request->kategori,
            'tgl_masuk' => $request->tgl_masuk,
            'tgl_expired' => $request->tgl_expired,
            'Mitra' => $request->Mitra,
        ];

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            // Pastikan file valid
            if ($file->isValid()) {
                $filename = time() . '_' . $file->getClientOriginalName();
                // Gunakan path absolut
                $path = public_path('storage/produk-images');
                // Buat direktori jika belum ada
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                // Pindahkan file
                $file->move($path, $filename);
                $produk['gambar'] = 'produk-images/' . $filename;
            }
        }

        Produk::create($produk);
        return redirect()->route('produk.list')->with('success','Penambahan Data Berhasil!');
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
        $pageData['dataProduk'] = Produk::findOrFail($param1);
        return view('admin.produk.editProduk',$pageData);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'kategori' => 'required',
            'tgl_masuk' => 'required|date',
            'tgl_expired' => 'required|date',
            'Mitra' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $produk = Produk::findOrFail($request->produk_id);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');

            if ($file->isValid()) {
                // Hapus gambar lama jika ada
                if ($produk->gambar && file_exists(public_path($produk->gambar))) {
                    unlink(public_path($produk->gambar));
                }

                // Simpan gambar baru
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = public_path('storage/produk-images');

                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }

                $file->move($path, $filename);
                $produk->gambar = 'produk-images/' . $filename;
            }
        }

        // Perbarui atribut lainnya
        $produk->nama_produk = $request->nama_produk;
        $produk->kategori = $request->kategori;
        $produk->tgl_masuk = $request->tgl_masuk;
        $produk->tgl_expired = $request->tgl_expired;
        $produk->Mitra = $request->Mitra;

        $produk->save();

        return redirect()->route('produk.list')->with('success', 'Produk berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $param1)
    {
        $produk = Produk::findOrFail($param1);

        $produk->delete();

        return redirect()->route('produk.list')->with('success','Penghapusan Data Berhasil!');
    }
}
