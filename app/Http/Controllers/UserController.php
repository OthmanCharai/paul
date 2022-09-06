<?php

namespace App\Http\Controllers;

use App\Models\User;
use http\Env\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index():JsonResponse
    {
        //
        return response()->json(['data'=>User::all()]);
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
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        //
        try {
            User::create(array_merge($request->only('name','email'), ['password'=>Hash::make($request->password)]));
            $request->session()->flash('success','user was added with success');
            return redirect()->route('admin.user');
        }catch(\Exception $e){
            $request->session()->flash('error','please try again');
            return redirect()->route('admin.user');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function show(User $user):JsonResponse
    {
        //
        return response()->json(['user'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(Request $request, User $user):RedirectResponse
    {
        $password=($request->password)?Hash::make($request->password):$user->password;
        $user->update(array_merge($request->only('name','email','password'),['password'=>$password]));
        $request->session()->flash('success','user was added with success');
        return redirect()->route('admin.user');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function destroy( User $user):JsonResponse
    {
        //
        $user->delete();
        return response()->json(['success'=>'user was deleted with success']);

    }

    /**
     * @return View
     */
    public function get_all():View{
        $pageConfigs = ['pageHeader' => false];
        return view('/content/apps/user/user-list', ['pageConfigs' => $pageConfigs]);
    }

}
