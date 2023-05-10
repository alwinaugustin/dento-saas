<?php

namespace Modules\Pateints\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Inertia\Inertia;
use Modules\Pateints\Entities\Patient;
use Modules\Doctors\Entities\Doctor;
use  Modules\Appointments\Entities\Appointment;


class PateintsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Pateints::Index', [
            'patients' => Patient::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Inertia\Response
     */
    public function create($id = null)
    {
        if (!$id) {
            return Inertia::render('Pateints::Create', [
                'patient_id'=>Patient::withTrashed()->max('id')+1,
                'token'=>csrf_token()
            ]);
        } else {
            $patient = Patient::where(['id'=>$id])->get();
            return Inertia::render('Pateints::Create', [
                'patient'=>$patient,
                'token'=>csrf_token()
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
        if($request->get('id')) {
            $path = 'uploads/'.$request->get('id');
        } else {
            $path = 'uploads/'.Patient::max('id')+1;
        }

       $pateintFile = $request->file('patient_file');
       $fileName    = time().'_'.$pateintFile->getClientOriginalName();
       $filePath    = $pateintFile->storeAs($path, $fileName, 'public');

       $request['patient_file_path']       = $filePath;
       $request['medical_conditions'] = implode(',', $request['medical_conditions']);
    //dd($request->all());
    try {
        $patient = Patient::updateOrCreate([
            'id'=>$request->get('id')
        ], $request->validate(
            [
                'prefix'            =>'required',
                'name'              =>'required|max:50|regex:/^[\pL\s\-]+$/u',
                'gender'            =>'required|max:50|alpha:ascii|in:Male,Female,Other',
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
                'referred_by'       =>'alpha',
                'medical_conditions' => 'string',
                'patient_file_path'      =>'string'
        ]));
    } catch (\Exception $e) {
        dd($e);
    }

        return redirect('/pateints')->with('message','Patient Added Successfully');
    }

    public function show($id)
    {
        $patient = Patient::where(['id'=>$id])->with(['appointments', 'appointments.doctor'])->first()->toArray();
        $doctors = Doctor::get();
        return Inertia::render('Pateints::Show', [
            'patient' => $patient,
            'doctors' => $doctors
        ]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function upload(Request $request)
    {
        $file = $request->file('patient_file');
        $file->move('uploads',$file->getClientOriginalName());

        return true;
    }

    /**
     * Get patients
     */
    public function get()
    {
        return Patient::all()->toJson();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function delete($id)
    {
        // $appointment = Appointment::where('patient_id')->get();
        // $appointment->delete();
        $patient = Patient::findOrFail($id);
        $patient->delete();

        return redirect('/pateints')->with('message','Patient deleted successfully');
    }
}
