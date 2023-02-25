<?php

namespace Modules\Pateints\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Inertia\Inertia;
use Modules\Pateints\Entities\Patient;


class PateintsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('pateints::Index', [
            'patients'      => Patient::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Inertia\Response
     */
    public function create($id = null)
    {
        if (!$id) {
            return Inertia::render('pateints::Create', [
                'patient_id'=>Patient::max('id')+1
            ]);
        } else {
            
            $patient = Patient::where(['id'=>$id])->get();
            return Inertia::render('pateints::Create', [
                'patient'=>$patient
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $patient = Patient::updateOrCreate([
            'id'=>$request->get('id')
        ], $request->validate(
            [
                'name'              =>'required|max:50|regex:/^[\pL\s\-]+$/u',
                'gender'            =>'required|max:50|alpha:ascii|in:male,female,other',
                'age'               =>'required|numeric',
                'blood_group'       =>'required',
                'marital_status'    =>'required',
                'contact_number'    =>'required',
                'email_id'          =>'required|email',
                'immediate_contact' =>'required',
                'contact_relation'  =>'alpha:ascii',
                'address'           =>'required|max:250',
                'address_2'         =>'required|max:250',
                'city'              =>'required|max:50',
                'state'             =>'required|max:50',
                'postal_code'       =>'required|numeric',
                'referred_by'       =>'alpha'
        ]));

        return redirect('/pateints')->with('notification','Patient Added Successfully');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('pateints::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('pateints::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
