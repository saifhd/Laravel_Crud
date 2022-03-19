<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\UpdateDetailsRequest;
use App\Http\Requests\Profile\UpdatePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit',[
            'user' => auth()->user()
        ]);
    }

    public function passwordUpdate(UpdatePasswordRequest $request)
    {
        $user = auth()->user();

        if(!Hash::check($request->old_password , $user->password)){
            return redirect()->back()->withErrors(['old_password' => __('The provided password does not match your current password.')]);
        }
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->back()->with('success',' Successfully password updated');
    }

    public function update(UpdateDetailsRequest $request)
    {
        auth()->user()->update($request->validated());

        return redirect()->back()->with('success' , 'Successfully Profile Details Updated');
    }
}
