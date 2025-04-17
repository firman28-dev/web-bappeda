<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\Status;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class Bidang_Controller extends Controller
{
    public function index(){
        $bidang = Bidang::where('status_id',1)->get();
        $sent = [
            'bidang' => $bidang
        ];
        return view('admin.bidang.index', $sent);

    }

    public function create(){
        $status = Status::whereIn('id', [1, 2, 3])->get();
        $sent = [
            'status' => $status
        ];
        return view('admin.bidang.create', $sent);    
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'label' => 'required',
            'status_id' => 'required',

        ],);

        // $test = $request->content;
        // return $test;

        try {
            $bidang = new Bidang();
            $bidang->name = $request->name;
            $bidang->label = $request->label;
            $bidang->status_id = $request->status_id;
            $bidang->save();
            Alert::success('Success!', 'Berhasil Mengubah Data');
            return redirect()->route('bidang.index');

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function edit($id){
        $bidang = Bidang::find($id);
        $status = Status::whereIn('id', [1, 2, 3])->get();

        $sent = [
            'bidang' => $bidang,
            'status' => $status
        ];
        return view('admin.bidang.edit', $sent);

    }



    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'label' => 'required',
            'status_id' => 'required',

        ],);

        try {
            $bidang = Bidang::find($id);
            $bidang->name = $request->name;
            $bidang->label = $request->label;
            $bidang->status_id = $request->status_id;
            $bidang->save();
            Alert::success('Success!', 'Berhasil Mengubah Data');
            return redirect()->route('bidang.index');

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
