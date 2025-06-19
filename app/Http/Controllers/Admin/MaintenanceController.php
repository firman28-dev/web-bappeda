<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MaintenanceController extends Controller
{
    public function index(){
        // $setting = Setting::
        $isMaintenanceOn = Setting::where('key', 'maintenance_mode')->value('value') === 'on';
        return view('admin.maintenance.index', compact('isMaintenanceOn'));

        // return view('admin.maintenance.index');
    }

    
    public function toggleMaintenance(Request $request)
    {
        $mode = $request->mode === 'on' ? 'on' : 'off';

        \App\Models\Setting::updateOrInsert(
            ['key' => 'maintenance_mode'],
            ['value' => $mode]
        );

        Cache::forget('maintenance_mode');

        return back()->with('success', 'Maintenance mode updated.');
    }

}
