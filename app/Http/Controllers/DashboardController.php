<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use App\Models\Produk;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        // if(!Auth::check()){
        //     return view('login');
        // }


        $pageData['dataProduk'] = Produk::paginate(5);

        $jumlahPelanggan = Pelanggan::count();
        $jumlahMitra = Mitra::count();
        $jumlahProduk = Produk::count();

        $pelangganTerbaru = Pelanggan::latest()->take(3)->get();
        $produkTerbaru = Produk::latest()->take(3)->get();

        return view('admin.dashboard',$pageData ,compact('jumlahPelanggan','jumlahMitra','jumlahProduk', 'pelangganTerbaru', 'produkTerbaru'));
    }
}
