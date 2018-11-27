<?php

namespace OrionMedical\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use OrionMedical\Models\User;
use OrionMedical\Models\Doctor;
use OrionMedical\Models\Company;
use OrionMedical\Http\Requests;
use OrionMedical\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Contracts\Auth\CanResetPassword;
use DB;
use OrionMedical\Models\Role; 
use Input;
use Response;
use OneSignal;




//use McPersona\Models\AuditTrails; 


class AuthController extends Controller
{
   // use AuthenticatesAndRegistersUsers, ThrottlesLogins;


    

 
     public function getSignup()
    {
        $company = Company::get()->first();
         $roles=Role::get();
         return view('auth.signup',compact('roles','company'));
    }
   
    public function getUserEdit($id)
    {

            $company = Company::get()->first();
            $user = User::where('id',$id)->first();
            $roles = Role::get();
            return view('auth.edituser',compact('user','roles','company'));

    }

    public function resetPassword(Request $request)
    {
        $this->validate($request, [
                'email'=> 'required|email|max:255',
                'username'=> 'required|max:100',
                'password' => 'required|same:password_confirmation',
                'password_confirmation' => 'required',
                'fullname'=> 'required|min:3',
                'location'=> 'required|min:2',
                'usertype'=> 'required|min:2',
            ]);

         
            
            $affectedRows = User::where('id', $request->input('userid'))->update(array('password' =>  bcrypt($request->input('password')),'username'=> $request->input('username'),'email'=> $request->input('email'),'location'=> $request->input('location') , 'usertype' => $request->input('usertype'), 'fullname' => $request->input('fullname')));

            if($affectedRows > 0)
            {
               
                return redirect()
            ->route('manage-users')
            ->with('info','Password has successfully been updated!, User can now sign in');
            }
            else
            {
                return redirect()
            ->route('manage-users')
            ->with('Warning','User details failed to update');
            }

    }

    public function postSignup(Request $request)
    {
        $this->validate($request, [
                'email'=> 'required|unique:users|email|max:255',
                'username'=> 'required|unique:users|alpha_dash|max:20',
                'password' => 'required|same:password_confirmation',
                'password_confirmation' => 'required',
                'fullname'=> 'required|min:3',
                'location'=> 'required|min:2',
                'usertype'=> 'required|min:2',
            ]);

        $assigned_role = $request->input('usertype');

        $user = new User;
        $user->email = strtolower($request->input('email'));
        $user->username = strtolower($request->input('username'));
        $user->password = bcrypt($request->input('password'));
        $user->fullname = $request->input('fullname');
        $user->location = $request->input('location');
        $user->usertype = $request->input('usertype');
        if($user->save())
        {


            if($request->input('usertype') == 'Doctor')
            {
                $doctor = new Doctor;
                $doctor->name = $request->input('fullname');
                $doctor->save();

            }
        

        $role = Role::where('name','=', $assigned_role)->first();
        $user->attachRole($role);

        return redirect()
            ->route('auth.signup')
            ->with('info','Account has successfully been created!, User can now sign in');
        }
        else
        {
        return redirect()
            ->route('auth.signup')
            ->with('Warning','Account failed to create');
        }
    }



    public function getSignin()
    {
         $company = Company::get()->first();
        return view('auth.signin',compact('company'));
    }

    public function postSignin(Request $request)
    {
        $this->validate($request, [
               
                'username'=> 'required',
                'password'=> 'required',
                
            ]);

        $remember_me = $request->has('remember') ? true : false; 

        if(!Auth::attempt($request->only(['username','password']),$remember_me))
        {
            return redirect()
                    ->back()
                    ->with('error','Invalid Username/Password combination. Please try again');
        }

            if(Auth::user()->created_at != Auth::user()->updated_at)
            {
            
                if(Auth::user()->usertype == 'Tab')
                {
                    return redirect()
                    ->route('register-start')
                    ->with('info','You are now signed in');

                }
                else
                {
                    return redirect()
                    ->route('dashboard')
                    ->with('info','You are now signed in');
                }

          

            }

            else
            {
            return redirect()
            ->route('reset-password-notice')
            ->with('info','First time login, Please reset your passowrd!!!');
         }

    }



    public function resetnotice()
    {
         $company = Company::get()->first();
        return view('auth.notice',compact('company'));
    }

    

    public function deleteUser()
    {

        if(Input::get("ID"))
        {
            $ID = Input::get("ID");
            $affectedRows = User::where('id', '=', $ID)->delete();

            if($affectedRows > 0)
            {
                $ini   = array('OK'=>'OK');
                return  Response::json($ini);
            }
            else
            {
                $ini   = array('No Data'=>$ID);
                return  Response::json($ini);
            }
        }
        else
        {
           $ini   = array('No Data'=>'No Data');
           return  Response::json($ini);
        }

    }
    




     public function getUsers()
    {

        $users =  User::paginate(30);
       return view('auth.user', compact('users'));
    }

    public function getSignOut()
    {
        Auth::logout();
        Session::flush();
        Redirect::back();
        return redirect(\URL::previous());

    }
}
