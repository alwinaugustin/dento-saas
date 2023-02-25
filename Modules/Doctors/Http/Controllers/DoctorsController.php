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
        return Inertia::render('doctors::Index', [
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
            return Inertia::render('doctors::Create');
        }
        
        return Inertia::render('doctors::Create', [
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
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('doctors::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('doctors::edit');
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
