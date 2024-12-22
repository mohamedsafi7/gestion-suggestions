<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
   /**
    * Log the user out of the application.
    */
   public function destroy(Request $request)
   {
       Auth::logout();

       $request->session()->invalidate();

       $request->session()->regenerateToken();

       return redirect('/login');
    }
}