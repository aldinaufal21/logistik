<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('ubah_password.index');
    }

    public function password(Request $request)
    {
        $user = User::find(Auth::user()->id);

        if (!(Hash::check($user->password, $request->password_old))) {
            if ($request->password_new !== $request->repeat_password_new) {

                return redirect('/profile')->with('danger', 'password baru harus sesuai dengan konfirmasi password');

            } else {
                $user->password = Hash::make($request->password_new);
                $user->save();

                return redirect('/profile')->with('success', 'berhasil update password');
            }
        } else {
            return redirect('/profile')->with('danger', 'password lama tidak sesuai');
        }

    }
}
