<?php

namespace App\Http\Controllers;

use App\Mail\UserEmail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(User::latest()->get());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => $request->password
        // ]);

        $emailVar = [
            'name' => $request->name,
            'email' => $request->email,
            'pass' => $request->password,
        ];


        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $res = $user->save();
        if ($res) {
            // Mail::to($request->email)->send(new UserEmail($emailVar));
            return response()->json('SuccessFully');
        } else {
            return response()->json('Not Added');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return response()->json(User::where('id', $id)->first());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::where('id', $id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return response()->json('SuccessFully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::where('id', $id)->first();
        $user->delete();
        return response()->json('Delete Successfully');
    }
}
