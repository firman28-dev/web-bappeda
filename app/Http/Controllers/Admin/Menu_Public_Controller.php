<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu_Public;
use App\Models\Status;
use Illuminate\Http\Request;
use Mckenziearts\Notify\Facades\LaravelNotify;
use RealRashid\SweetAlert\Facades\Alert;

class Menu_Public_Controller extends Controller
{
    public function index(){
        $menu = Menu_Public::orderBy('id', 'desc')->get();
        $sent = [
            'menu' => $menu
        ];
        return view('admin.menu_public.index', $sent);
    }

    

    public function create(){
        $status = Status::whereIn('id', [1, 2, 3])->get();
        $menus = Menu_Public::where('status_id', 1)
            ->whereNull('parent_id')
            ->with('_children')
            ->orderBy('order_no')
            ->get();
        $sent = [
            'status' => $status,
            'menus' => $menus
        ];
        return view('admin.menu_public.create', $sent);

    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:menu_public,id',
            'status_id' => 'required',
            'url' => 'nullable|string|max:255',
            'order_no' => 'required|integer',
        ],);

        try {

            $menu = new Menu_Public();
            $menu->name = $request->name;
            $menu->parent_id = $request->parent_id;
            $menu->status_id = $request->status_id;
            $menu->url = $request->url;
            $menu->order_no = $request->order_no;
            $menu->save();
            // Alert::success('Success!', 'Berhasil Menambahkan Data');
            // return redirect()->route('menu-public.index');
            return redirect()->route('menu-public.index')->with('success', 'Berhasil menambahkan data');


        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function edit($id){
        $findMenu = Menu_Public::find($id);
        $status = Status::whereIn('id', [1, 2, 3])->get();
        $menus = Menu_Public::where('status_id', 1)
            ->whereNull('parent_id')
            ->with('_children')
            ->orderBy('order_no')
            ->get();
        $sent = [
            'status' => $status,
            'menus' => $menus,
            'findMenu' => $findMenu
        ];
        if($findMenu){
            return view('admin.menu_public.edit', $sent);
        }
        else{
            return view('error_page.error_404');
        }

    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:menu_public,id',
            'status_id' => 'required',
            'url' => 'nullable|string|max:255',
            'order_no' => 'required|integer',
        ],);

        try {
            $menu = Menu_Public::find($id);
            $menu->name = $request->name;
            $menu->parent_id = $request->parent_id;
            $menu->status_id = $request->status_id;
            $menu->url = $request->url;
            $menu->order_no = $request->order_no;
            $menu->save();
            // Alert::success('Success!', 'Berhasil Mengubah Data');
            return redirect()->route('menu-public.index')->with('success', 'Berhasil Mengubah data');

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy($id){
        $menu = Menu_Public::find($id);
        $isParentUsed = Menu_Public::where('parent_id', $id)->exists();
        if ($isParentUsed) {
            return redirect()->back()->with('error', __('Gagal Menghapus Data Karena Merupakan Parent'));
        }
        else{
            $menu->delete();
            return redirect()->back()->with('success', __('Berhasil Menghapus Data'));
        }

    }
}
