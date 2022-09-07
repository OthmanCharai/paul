<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMeetRequest;

use App\Models\Doctor;
use App\Models\Meet;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class MeetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index():View
    {
        //
        $pageConfigs = [
            'pageHeader' => false
        ];



        return view('/content/apps/calendar/app-calendar', [
            'pageConfigs' => $pageConfigs,
            'doctors'=>(Auth::user()->hasRole('admin'))?Doctor::all():Auth::user()->doctors
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreMeetRequest $request
     * @return JsonResponse
     */
    public function store(StoreMeetRequest $request):JsonResponse
    {
        //

        try {
            $meet=Auth::user()->meets()->save(
                new Meet($request->only('title','start','status','description','doctor_id'))
            );
            return response()->json(['meet'=>$meet,'success'=>'meet was added with success']);
        }catch (Exception $r){
            return response()->json(['error'=>'Some thing was wrong']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Meet $meet
     * @return Response
     */
    public function show(Meet $meet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Meet $meet
     * @return Response
     */
    public function edit(Meet $meet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreMeetRequest $request
     * @param Meet $meet
     * @return JsonResponse
     */
    public function update(StoreMeetRequest $request, Meet $meet):JsonResponse
    {
        //
        try{
            $meet->update($request->only('status','description','start','doctor_id','title'));
            return response()->json('success ');

        }catch (\Exception $e){
            return response()->json($e);

        }



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Meet $meet
     * @return JsonResponse
     */
    public function destroy(Meet $meet):JsonResponse
    {
        //
        try {
            $meet->delete();
            return response()->json('success');
        }catch (\Exception $e){
            return  response()->json('error');
        }

    }

    /**
     *
     * @return JsonResponse
     */
    public function get_all_meets():JsonResponse {
        if(Auth::user()->hasRole('admin')){
            $meets=Meet::all();
        }else{
            $meets=Meet::with('doctors')->where('user_id',Auth::user()->id)->get();

        }


        return response()->json(['events'=>$meets]);
    }

    /**
     * create_admin
     *
     * @return void
     */
    public function create_admin(){
        $role = Role::findOrCreate( 'admin');
        $user=User::create([
            'name'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=>Hash::make('admin')
        ]);
        $user->assignRole('admin');


    }





}
