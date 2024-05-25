<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profil(){
        return view('costumers.layouts.profile.userprofil');
    }
    public function profilpassword(){
        return view('costumers.layouts.profile.gantipassword');
    }
    public function updateprofile(Request $request){
        $user = Auth::user();
        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'phone' => 'nullable|numeric', // Mengharuskan inputan berupa angka
            'birthdate' => 'nullable|date',
            'user_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gender' => 'nullable|in:male,female',
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->birthdate = $request->input('birthdate');

        if ($request->hasFile('user_img')) {
            $image = $request->file('user_img');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/profil'), $imageName);

            // Menghapus gambar lama jika ada
            if ($user->user_img) {
                $oldImagePath = public_path($user->user_img);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $user->user_img = 'uploads/profil/' . $imageName;
        }

        // Update gender
        $user->gender = $request->input('gender');

        $user->save();

        return redirect()->back()->with('message', 'Profil berhasil diperbarui');
    }

    }

