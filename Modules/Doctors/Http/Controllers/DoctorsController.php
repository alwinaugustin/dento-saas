<?php

namespace Modules\Doctors\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Doctors\Entities\Doctor;
use Inertia\Inertia;

class DoctorsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return Inertia::render('Doctors::Index', [
            'doctors'=> Doctor::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create($id =null)
    {
        if (!$id) {
            return Inertia::render('Doctors::Create');
        }
        
        return Inertia::render('Doctors::Create', [
            'doctor'=>Doctor::where(['id'=>$id])->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $doctor = Doctor::updateOrCreate([
            'id'=>$request->get('id')
        ], $request->validate([
            'name' =>'required|max:50|regex:/^[\pL\s\-]+$/u',
            'email'=>'required|email',
            'contact_number'=>'required',
            'speciality'=>'required',
            'address'=>'required',
            'more_info'=>'required'
        ]));

        return redirect('/doctors')->with('notification','Doctor Added Successfully');
    }

     /**
     * Get doctors
     */
    public function get()
    {
        return Doctor::all()->toJson();
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
