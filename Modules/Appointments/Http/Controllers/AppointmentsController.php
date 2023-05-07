<?php

namespace Modules\Appointments\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use  Modules\Appointments\Entities\Appointment;
use Inertia\Inertia;
use Modules\Doctors\Entities\Doctor;

class AppointmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $appointments           = Appointment::with(['patient', 'doctor'])->get();
        $appointmentDetails     = [];
        
        $appointmentDetails = $appointments->map(function ($appointment) {
            return [
                'id' => $appointment->id,
                'patient_id' => $appointment->patient?->id,
                'patient_name' => $appointment->patient?->name,
                'doctor_name' => $appointment->doctor?->name,
                'doctor_id' => $appointment->doctor?->id,
                'contact_number' => $appointment->patient?->contact_number,
                'purpose' => $appointment->purpose,
                'appointment_time' => date('d-m-Y H:i:s', strtotime($appointment->appointment_time)),
                'status' => $appointment->status,
            ];
        })->all();
        $doctors = Doctor::get();

        return Inertia::render('Appointments::Index', [
            'appointments' => $appointmentDetails,
            'doctors'=>$doctors
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create($id = null)
    {
         if (!$id) {
            return Inertia::render('Appointments::Create');
        } else {
            $appointment = Appointment::where(['id'=>$id])->with(['patient', 'doctor'])->get();
            return Inertia::render('Appointments::Create', [
                'appointment'=>$appointment,
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
        $doctor = Appointment::updateOrCreate([
            'id'=>$request->get('id')
        ], $request->validate([
            'patient_id'            =>'required',
            'doctor_id'             =>'required',
            'purpose'               =>'required',
            'appointment_time'      =>'required',
            'additional_information'=>'required',
            'status'                =>'required'
        ]));

        return redirect('/appointments')->with('notification','Appointment Added Successfully');
    }
    /**
     * 
     */
    public function update(Request $request) {
        $input = $request->except('id');
        $appointment_id = $request->input('id');
        Appointment::find($appointment_id)->update($input);

        return redirect('/appointments')->with('message', 'Appointment updated Successfully');
    }
}
