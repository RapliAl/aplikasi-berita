<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class GoogleLoginController extends Controller
{
    // app/Http/Controllers/GoogleLoginController.php

    public function redirect()
    {
        // Ambil konfigurasi secara manual
        $config = config('services.google');

        // Cek apakah konfigurasi ada untuk memastikan
        if (empty($config['client_id']) || empty($config['client_secret']) || empty($config['redirect'])) {
        // Jika karena alasan aneh konfigurasinya kosong, tampilkan pesan error yang jelas
        die('Error: Konfigurasi Google tidak ditemukan atau tidak lengkap.');
        }

        // Buat driver Google secara manual dengan konfigurasi yang sudah kita ambil
        $provider = Socialite::buildProvider(\Laravel\Socialite\Two\GoogleProvider::class, $config);

        // Lakukan redirect menggunakan provider yang sudah kita buat manual
        return $provider->redirect();
    }

    // app/Http/Controllers/GoogleLoginController.php

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        
            // ---- DEBUG LANGKAH 1 ----
            // Hentikan dan tampilkan data yang kita dapat dari Google.
            // Apakah kita berhasil mendapatkan data user?
            // dd($googleUser);

            // Cari user di database kita berdasarkan google_id
            $user = User::where('google_id', $googleUser->getId())->first();

            if ($user) {
            // Jika user sudah ada, langsung login
                Auth::login($user);
                return redirect()->intended('dashboard');
             } else {
            // Jika user belum ada, cek berdasarkan email
                $existingUser = User::where('email', $googleUser->getEmail())->first();

                if ($existingUser) {
                // Jika email sudah ada, update google_id-nya
                    $existingUser->update(['google_id' => $googleUser->getId()]);
                    Auth::login($existingUser);
                    return redirect()->intended('dashboard');
                } else {
                // ---- DEBUG LANGKAH 2 ----
                // Jika user benar-benar baru, coba buat user baru.
                // Pastikan 'google_id' ada di $fillable model User Anda!
                    $newUser = User::create([
                        'name' => $googleUser->getName(),
                        'email' => $googleUser->getEmail(),
                        'google_id' => $googleUser->getId(),
                        'password' => Hash::make(uniqid()) // Buat password acak
                  ]);
                
                // Hentikan dan tampilkan data user yang baru dibuat.
                // Apakah berhasil masuk database?
                    // dd($newUser);

                    Auth::login($newUser);
                    return redirect()->intended('dashboard');
                }
            }
         } catch (\Throwable $th) {
        // ---- DEBUG LANGKAH 3 ----
        // Jika ada error di mana pun dalam blok try,
        // hentikan dan tampilkan error tersebut.
            // dd($th->getMessage());
        }
    }
}

