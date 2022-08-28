<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMeetRequest;
use App\Http\Requests\UpdateMeetRequest;
use App\Models\Doctor;
use App\Models\Meet;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

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

        $doctors=Auth::user()->doctors;


        return view('/content/apps/calendar/app-calendar', [
            'pageConfigs' => $pageConfigs,
            'doctors'=>$doctors
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
        $meets=[];
        foreach ($request->doctor_id as $doctor_id){
            $meets[] = new Meet(array_merge(['doctor_id'=>$doctor_id],$request->only('title','start','status','description')));
        }

        try {
            $meet=Auth::user()->meets()->saveMany(
               $meets
            );
            return response()->json(['meet'=>$meet,'success'=>'meet was added with success']);
        }catch (Exception $r){
            return response()->json(['error'=>'Some thing was wrong']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Meet  $meet
     * @return Response
     */
    public function show(Meet $meet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Meet  $meet
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
        return response()->json($request);
        $meet->update($request->only('status','description','date','doctor_id','title'));
        $request->session()->flash('status','Meeting was info was updated with success');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Meet  $meet
     * @return Response
     */
    public function destroy(Meet $meet)
    {
        //
    }

    /**
     *
     * @return JsonResponse
     */
    public function get_all_meets():JsonResponse {
        $meets=Meet::with('doctors')->where('user_id',Auth::user()->id)->get();
        return response()->json(['events'=>$meets]);
    }



}
