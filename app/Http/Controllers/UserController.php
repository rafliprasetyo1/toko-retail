<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filterableColumns = ['role'];
        $searchableColumns = ['name'];
        $pageData['dataUser'] = User::filter($request, $filterableColumns, $searchableColumns)->paginate(5)->withQueryString();
        return view('admin.user.indexUser',$pageData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.createUser');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'alamat'  => ['required'],
            'tgl_lahir'   => ['required', 'date'],
            'email' => ['required'],
            'password' => ['required'],
            'role'     => ['required', 'in:admin,pelanggan,mitra'],
        ]);

        $data['name'] = $request->name;
        $data['alamat'] = $request->alamat;
        $data['tgl_lahir'] = $request->tgl_lahir;
        $data['email'] = $request->email;
        $data['password'] = $request->password;
        $data['role'] = $request->role;
        $data['foto_profile'] = $request->foto_profile;

        if ($request->hasFile('foto_profile')) {
            $imageName = time() . '.' . $request->foto_profile->extension();
            $request->foto_profile->move(public_path('foto_profile'), $imageName);
            // Menyimpan nama file gambar ke dalam database
            $data['foto_profile'] = $imageName;
        }

        User::create($data);

        return redirect()->route('user.list')->with('success','Penambahan Data Berhasil!');
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
        $pageData['dataUser'] = User::findOrFail($param1);
        return view('admin.user.editUser',$pageData);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'alamat'  => ['required'],
            'email' => ['required'],
            'role'     => ['required', 'in:admin,pelanggan,mitra'],
            'tgl_lahir'   => ['required', 'date'],
            'foto_profile' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048']
        ]);

        $id = $request->id;
        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->alamat = $request->alamat;
        $user->tgl_lahir = $request->tgl_lahir;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->hasFile('foto_profile')) {
            // Hapus foto lama jika ada
            if ($user->foto_profile && file_exists(public_path('foto_profile/' . $user->foto_profile))) {
                unlink(public_path('foto_profile/' . $user->foto_profile));
            }

            // Upload foto baru
            $imageName = time() . '.' . $request->foto_profile->extension();
            $request->foto_profile->move(public_path('foto_profile'), $imageName);

            // Update field foto_profile langsung ke model user
            $user->foto_profile = $imageName;
        }

        $user->save();

        return redirect()->route('user.list')->with('success','Perubahan Data berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $param1)
    {
        $user = User::findOrFail($param1);

        $user->delete();

        return redirect()->route('user.list')->with('success','Penghapusan Data Berhasil!');
    }
}
