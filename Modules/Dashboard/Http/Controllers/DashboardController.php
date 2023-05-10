<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Inertia\Inertia;
use  Modules\Appointments\Entities\Appointment;
use Modules\Doctors\Entities\Doctor;

class DashboardController extends Controller
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

        $tableColumns = [
            ['field' => 'patient_name', 'header' => 'Patient Name', 'sortable' => true],
            ['field' => 'contact_number', 'header' => 'Contact Number', 'sortable' => true],
            ['field' => 'doctor_name', 'header' => 'Doctor Name', 'sortable' => true],
            ['field' => 'purpose', 'header' => 'Purpose', 'sortable' => true],
            ['field' => 'appointment_time','header' => 'Time', 'sortable' => true],
        ];
        $globalFilterFields = ['patient_name', 'doctor_name', 'contact_number', 'purpose'];

        return Inertia::render('Dashboard::Index', [
            'appointments' => $appointmentDetails,
            'columns' => $tableColumns,
            'globalFilterFields' => $globalFilterFields,
            'doctors'=>$doctors
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return Inertia::render('Dashboard::Create');
        //return view('dashboard::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('dashboard::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('dashboard::edit');
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
