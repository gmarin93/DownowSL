<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class EditController extends Controller
{
    //
       public function __construct()
    {
        $this->middleware('guest');
    }

     protected $redirectTo = '/home';

     public function update(UpdateAccount $request)
    {
        $user = Auth::user();
        
        $user->update($request->all());

        Flash::message('Your account has been updated!');

        return Redirect::to('/home');
    }
}
