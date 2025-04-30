<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\Group;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class User_Controller extends Controller
{
   
    public function index()
    {
        $users = User::all();
        // return $users;
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        $bidang = Bidang::all();
        $group = Group::all();

        $sent = [
            'bidang' => $bidang,
            'group' => $group
        ];
        return view('admin.user.create', $sent);
        
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'password' => 'required|min:8',
            'group_id' => 'required',
            'bidang_id' => 'nullable'
        ],
        [
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah terdaftar, silakan pilih username lain.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password harus minimal 8 karakter.',
            'group_id.required' => 'Role Akses harus dipilih.',
        ]);

        // return
        

        try{
            $user = new User();
            $user->username = $request->username;
            $user->password = $request->password;
            $user->group_id = $request->group_id;
            if($request->bidang_id){
                $user->bidang_id = $request->bidang_id;
            }
            
            // return $user;
            $user->save();
            return redirect()->route('user.index')->with('success', 'Berhasil menambahkan data user');
        }
        catch(\Exception $e){
            // return $e;
            return redirect()->route('user.create')->with('error', 'Gagal menambahkan data user. Silahkan coba lagi');

        }   
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus data');

    }

    public function resetPassword($id)
    {
        $user = User::findOrFail($id);
        $hashedPassword = 'sumbarprov';
        // return $hashedPassword;
        $user->update([
            'password' => $hashedPassword
        ]);
        \Log::info('Password for user ' . $user->id . ' has been reset to: ' . $hashedPassword);
        return redirect()->route('user.index')->with('success', 'Berhasil mereset password ke default');
    }

    public function profile()
    {
        $user = Auth::user();
        $idUser = $user->id;
        $userFind = User::where('id',$idUser)->first();
        return view('profile.index', compact('userFind'));
    }

    public function editProfile()
    {
        $user = Auth::user();
        $idUser = $user->id;
        $userFind = User::find($idUser);
        // return $userFind;
        return view('profile.edit', compact('userFind'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $idUser = $user->id;

        $request->validate([
            'username' => 'required|unique:users,username,' .$user->id,
            'name' => 'required',
            'email' => 'required|email',
        ],
        [
            'username.required' => 'Username wajib diisi.',
            'name.required'=>'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
        ]);

        try{
            $user = User::find($idUser);
            $user->username = $request->username;
            $user->name = $request->name;
            $user->email = $request->email;
            
            $user->save();
            // return $user;
            return redirect()->route('user.profile')->with('success', 'Berhasil mengubah data profile');
        }
        catch(\Exception $e){
            dd($e);
            return redirect()->route('user.edit')->with('error', 'Gagal mengubah data profile. Silahkan coba lagi');

        }   

    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        $idUser = $user->id;

        $request->validate([
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password'
        ],
        [
            'password.required' => 'Password wajib diisi.',
            'confirm_password.required' => 'Confirm Password wajib diisi.',
            'new_password.min' => 'Password minimal 8 karakter',
            'confirm_password.same' => 'Password harus sama '
        ]);

        try{
            $user = User::find($idUser);
            $user->password = $request->new_password;
            
            $user->save();
            // return $user;
            return redirect()->route('user.profile')->with('success', 'Berhasil mengubah password baru');
        }
        catch(\Exception $e){
            return redirect()->route('user.profile')->with('error', 'Gagal mengubah password baru. Silahkan coba lagi');

        }   
    }

}
