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
        $patients = Patient::all();
        return Inertia::render('pateints::Index', [
            'patients'=>$patients,
            'total_records' => count($patients)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('pateints::Create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $patient = Patient::create([
                'name'              =>$request->input('name'),
                'gender'            =>$request->input('gender'),
                'age'               =>$request->input('age'),
                'blood_group'       =>$request->input('blood_group'),
                'marital_status'    =>$request->input('marital_status'),
                'contact_number'    =>$request->input('contact_number'),
                'email_id'          =>$request->input('email'),
                'immediate_contact' =>$request->input('imm_contact_number'),
                'contact_relation'  =>$request->input('imm_contact_relation'),
                'address'           =>$request->input('address'),
                'address_2'         =>$request->input('address_2'),
                'city'              =>$request->input('city'),
                'state'             =>$request->input('state'),
                'postal_code'       =>$request->input('postal_code'),
                'referred_by'=>'Alwin'
        ]);

        return to_route('patients');
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
