<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
use App\Models\Doctor;
use Exception;
use http\Client\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index():JsonResponse
    {

      return response()->json(['data'=>Auth::user()->doctors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDoctorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDoctorRequest $request)
    {
        $doctor=Doctor::where([['address',$request->address],['speciality',$request->speciality],['first_name',$request->first_name],['last_name',$request->last_name]])->get();

        if(count($doctor)==0){
            try{
                Auth::user()->doctors()->save(new Doctor($request->only('speciality','first_name','last_name','first_name','address','phone')));

            }catch(Exception $r){
                dd($r);
            }
            $request->session()->flash('success','doctors info was added with success');

            return redirect()->route('app-user-list');
        }
        $request->session()->flash('error','doctor already exist');
        return redirect()->route('app-user-list');
        //

       /*  $header=[];
        if($request->hasFile('xl')){

           $data=file(request()->xl);
           // chunking file
            $chunks=array_chunk($data,6);
            $header=[
                "first_name",
                "last_name",
                'speciality',
                'address',
                'phone',
                'user_id'
            ];

            foreach($chunks as $key=>$chunk){
                $data=array_map('str_getcsv',$chunk);
                foreach($data as $value){

                    $doctor=array_combine($header, $value);
                    Doctor::create($doctor);
            }
        }


        } */


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDoctorRequest  $request
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(StoreDoctorRequest $request, Doctor $doctor)
    {
        $chec_kdoctor=Doctor::where([['address',$request->address],['speciality',$request->speciality],['first_name',$request->first_name],['last_name',$request->last_name],['user_id','!=',Auth::user()->id]])->get();
        if(!empty($chec_kdoctor)){
            $doctor->update($request->only('speciality','first_name','last_name','first_name','address','phone'));
            $request->session()->flash('success','doctors info was updated with success');
        }
        else{
            $request->session()->flash('error','doctors info already in data base');
        }
        return redirect()->route('app-user-list');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Doctor $doctor)
    {
        //
        $doctor->delete();
        $request->session()->flash('status','Doctor was deleted with success');

        return response()->json('success');
    }
}
