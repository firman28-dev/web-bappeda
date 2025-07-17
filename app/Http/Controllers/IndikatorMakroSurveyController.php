<?php

namespace App\Http\Controllers;

use App\Models\IndikatorMakro;
use App\Models\IndikatorMakroSurvey;
use Illuminate\Http\Request;

class IndikatorMakroSurveyController extends Controller
{
    
    public function index()
    {
        $tahun = range(2021, 2026);

        $indikator = IndikatorMakro::all();

        $nilai = IndikatorMakroSurvey::get()->groupBy(function ($item) {
            return $item->indikator_id . '_' . $item->survey_id;
        });
        // return $indikator;
        $sent =[ 
            'nilai' => $nilai,
            'tahun' => $tahun,
            'indikator' => $indikator
        ];
        return view('admin.indikator.index', $sent);
    }

   
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        //
    }

    
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:indikator_makro_survey,id',
            'field' => 'in:target,realisasi,nasional',
            'value' => 'numeric|nullable'
        ]);

        IndikatorMakroSurvey::where('id', $request->id)->update([
            $request->field => $request->value
        ]);

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

   
    public function destroy($id)
    {
        //
    }
}
