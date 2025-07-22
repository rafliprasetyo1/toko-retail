<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;



class AuthController extends Controller
{



    public function home()
    {
        if(Auth::check()){
            return view('admin.dashboard');
        }
        return view('login');
    }

    // Method untuk menampilkan halaman Login
    public function showLoginForm()
    {
        if(Auth::check()){
            return redirect(route('dashboard'));
        }
        return view('login');

    }

    // Method untuk menampilkan halaman Registrasi
    public function showRegisterForm()
    {
        return view('register');
    }

    public function login(Request $request){
       // dd($request->all());
        // $request->validate([
		//     'username'  => 'required|max:10',
		//     'password' => [
		//         'required',           // Wajib diisi
		//         'string',             // Harus berupa string
		//         'min:8',              // Minimal 8 karakter
		//         'regex:/[a-z]/',      // Harus mengandung setidaknya 1 huruf kecil
		//         'regex:/[A-Z]/',      // Harus mengandung setidaknya 1 huruf besar
		//         'regex:/[0-9]/',      // Harus mengandung setidaknya 1 angka
		//     ],
		// ]);
        $pageData['email'] = $request->email;
        $pageData['password'] = $request->password;

        // $user = User::where('username', $request->username)->first();
        // if ($user && Hash::check($request->password, $user->password)) {

        //     Auth::login($user);
        // }

        // return view('admin.dashboard',$pageData);

        $user = User::where('email', $request->email)->first();
        if($user&& Hash::check($request->password, $user->password)){
            Auth::login($user);

            return redirect()->route('dashboard')->with('success', true);
        }

        return redirect()->route('login')->with('error', 'Akun email tidak terdaftar');

        //  return redirect('home');
        //  return redirect('/login')->with('info', 'Berhasil Login !'); //redirect dengan flash data
    }
    public function register(Request $request){
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:300',
            'tgl_lahir' => 'required|date',
            'username' => 'required|string|max:10',
            'password' => 'required|string|min:8|confirmed',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = [
    'name' => $request->nama,
    'alamat' => $request->alamat,
    'tgl_lahir' => $request->tgl_lahir,
    'username' => $request->username,
    'role' => $request->role,
    'email' => $request->email,
    'password' => Hash::make($request->password),
];


        // Handle foto profil
        if ($request->hasFile('foto_profil')) {
            $file = $request->file('foto_profil');
            if ($file->isValid()) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = public_path('storage/profile-images');

                // Buat direktori jika belum ada
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }

                // Pindahkan file
                $file->move($path, $filename);
                $data['foto_profil'] = 'profile-images/' . $filename;
            }
        }

        User::create($data);

        return redirect()->route('login')->with('info', 'Registrasi berhasil! Silakan login.');
    }

    function logout(Request $request){
		Auth::logout();
		$request->session()->invalidate();
		$request->session()->regenerateToken();

		return view('login');
}
public function redirectToGoogle()
{
    return Socialite::driver('google')->redirect();
}


public function handleGoogleCallback()
{
    try {
        $googleUser = Socialite::driver('google')
            ->setHttpClient(new \GuzzleHttp\Client(['verify' => false]))
            ->stateless()
            ->user();

        $userFromDb = User::where('google_id', $googleUser->getId())->first();

        if (!$userFromDb) { // Perbaiki typo di sini
            $userFromDb = new User();
            $userFromDb->email = $googleUser->getEmail();
            $userFromDb->google_id = $googleUser->getId();
            $userFromDb->name = $googleUser->getName();

            $userFromDb->save(); // Simpan user dari DB

            auth('web')->login($userFromDb); // Login user
            session()->regenerate(); // Regenerasi session untuk keamanan

        return redirect()->route('dashboard');
        }

        auth('web')->login($userFromDb); // Login jika user sudah ada
        session()->regenerate();
        return redirect('/dashboardadmin');
    } catch (\Exception $e) {
        \Log::error('Google Auth Error: ' . $e->getMessage());
        \Log::error($e->getTraceAsString());
        return redirect()->route('login')
            ->with('error', 'Google authentication failed: ' . $e->getMessage());
    }
}
}
