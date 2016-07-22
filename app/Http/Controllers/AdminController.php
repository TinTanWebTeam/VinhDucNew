<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Auth;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests;
class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function getViewUser()
    {
       try {
           $role = Role::where('active', 1)->where('name', '!=', 'admin')->get();
           $user = User::where('active', 1)->where('roleId','!=', 1)->get();
           return view('admin.user')->with('users', $user)->with('roles', $role);
       }
       catch (Exception $ex){
           return $ex;
       }
    }

    public function postViewUser(Request $request)
    {
        try {
            $user = User::where('active', 1)->where('id', $request->get('idUser'))->first();
            return $user;
        }
        catch (Exception $ex){
            return $ex;
        }
    }

    public function deleteUser(Request $request)
    {
        try{
            $user = User::where('active',1)->where('id',$request->get('idUser'))->first();
            if($user){
                $user->active = 0;
                $user->updatedBy = Auth::user()->id;
                $user->save();
            }
            $arrayListUser = [];
            $listUser=User::where('active',1)->where('name', '!=', 'admin')->get();
            foreach ($listUser as $user){
                $array = [
                    'id'=> $user->id,
                    'name' => $user->name,
                    'fullName' =>$user->fullName,
                    'email' =>$user->email,
                    'role' => $user->Role()->name
                ];
                array_push($arrayListUser,$array);
            }
            return array(1,'listUser'=>$arrayListUser);
        }
        catch (Exception $ex){
            return $ex;
        }
    }
    public function getViewTreatmentPackage()
    {
        return view('admin.treatmentPackage');
    }
}
