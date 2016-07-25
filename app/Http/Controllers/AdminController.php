<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Auth;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function getViewRole()
    {
        try {
            $role = Role::where('active', 1)->get();
            return view('admin.role')->with('roles', $role);
        } catch (Exception $ex) {

        }
    }

    public function postViewRole(Request $request)
    {
        try {
            $role = Role::where('active', 1)->where('id', $request->get('idRole'))->first();
            return $role;
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function getRole()
    {
        $arrayListRole = [];
        $listRole = Role::where('active', 1)->get();
        foreach ($listRole as $role) {
            $array = [
                'id' => $role->id,
                'name' => $role->name,
                'description'=>$role->name
            ];
            array_push($arrayListRole, $array);
        }
        return $arrayListRole;
    }

    public function addNewAndUpdateRole(Request $request)
    {
        $result = null;
        try {
            if ($this->validator($request->all(), "validatorRole")->fails()) {
                return $this->validator($request->all(), "validatorRole")->errors();
            } else {
                if ($request->get('addNewOrUpdateId') == null) {
                    try {
                        $role = new Role();
                        $role->name = $request->get('dataRole')['Name'];
                        $role->description = $request->get('dataRole')['Description'];
                        $role->createdBy = Auth::user()->id;
                        $role->upDatedBy = Auth::user()->id;
                        $role->save();
                        $result = array(1, 'listUser' => $this->getRole());
                    } catch (Exception $ex) {
                        return $ex;
                    }
                } else {
                    try {
                        $role = Role::where('active', 1)->where('id', $request->get('dataRole')['Id'])->first();
                        if ($role) {
                            $role->name = $request->get('dataRole')['Name'];
                            $role->description = $request->get('dataRole')['Description'];
                            $role->upDatedBy = Auth::user()->id;
                            $role->save();
                            $result = array(2, 'listUser' => $this->getRole());
                        } else {
                            $result = array(0, 'listUser' => null);
                        }
                    } catch (Exception $ex) {
                        return $ex;
                    }
                }
                return $result;
            }
        } catch (Exception $ex) {

        }
    }

    public function getViewPatient()
    {
        try {
            return view('admin.patient');
        } catch (Exception $ex) {

        }
    }

    public function getViewTherapist()
    {
        try {
            return view('admin.therapist');
        } catch (Exception $ex) {

        }
    }

    public function getViewUser()
    {
        try {
            $role = Role::where('active', 1)->where('name', '!=', 'admin')->get();
            $user = User::where('active', 1)->where('roleId', '!=', 1)->get();
            return view('admin.user')->with('users', $user)->with('roles', $role);
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function postViewUser(Request $request)
    {
        try {
            $user = User::where('active', 1)->where('id', $request->get('idUser'))->first();
            return $user;
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function getUser()
    {
        $arrayListUser = [];
        $listUser = User::where('active', 1)->where('name', '!=', 'admin')->get();
        foreach ($listUser as $user) {
            $array = [
                'id' => $user->id,
                'name' => $user->name,
                'fullName' => $user->fullName,
                'email' => $user->email,
                'role' => $user->Role()->name
            ];
            array_push($arrayListUser, $array);
        }
        return $arrayListUser;
    }

    public function deleteUser(Request $request)
    {
        try {
            $user = User::where('active', 1)->where('id', $request->get('idUser'))->first();
            if ($user) {
                $user->active = 0;
                $user->updatedBy = Auth::user()->id;
                $user->save();
            }
            return array(1, 'listUser' => $this->getUser());
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function addNewAndUpdateUser(Request $request)
    {
        $result = null;
        try {
            if ($this->validator($request->all(), "validatorUser")->fails()) {
                return $this->validator($request->all(), "validatorUser")->errors();
            } else {
                if ($request->get('addNewOrUpdateId') == null) {
                    $checkEmail = User::where('active', 1)->where('email', $request->get('dataUser')['Email'])->first();
                    if ($checkEmail == null) {
                        try {
                            $user = new User();
                            $user->name = $request->get('dataUser')['Name'];
                            $user->password = crypt($request->get('dataUser')['Password'], 'tintansoft');
                            $user->fullName = $request->get('dataUser')['FullName'];
                            $user->roleId = $request->get('dataUser')['RoleId'];
                            $user->email = $request->get('dataUser')['Email'];
                            $user->createdBy = Auth::user()->id;
                            $user->upDatedBy = Auth::user()->id;
                            $user->save();

                            $result = array(1, 'listUser' => $this->getUser());
                        } catch (Exception $ex) {
                            return $ex;
                        }
                    } else {
                        $result = array(3, 'listUser' => null);
                    }
                } else {
                    $checkEmail = User::where('active', 1)->where('email', $request->get('dataUser')['Email'])
                        ->where('id', '!=', $request->get('dataUser')['Id'])->first();
                    if ($checkEmail == null) {
                        try {
                            $user = User::where('active', 1)->where('id', $request->get('addNewOrUpdateId'))->first();
                            if ($user) {
                                $user->name = $request->get('dataUser')['Name'];
                                $user->password = crypt($request->get('dataUser')['Password'], 'tintansoft');
                                $user->fullName = $request->get('dataUser')['FullName'];
                                $user->roleId = $request->get('dataUser')['RoleId'];
                                $user->email = $request->get('dataUser')['Email'];
                                $user->upDatedBy = Auth::user()->id;
                                $user->save();
                                $user->save();
                                $result = array(2, 'listUser' => $this->getUser());
                            } else {
                                $result = array(0, 'listUser' => null);
                            }
                        } catch (Exception $ex) {
                            return $ex;
                        }
                    } else {
                        $result = array(4, 'listUser' => null);
                    }
                }
            }
            return $result;
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function getViewTreatmentPackage()
    {
        return view('admin.treatmentPackage');
    }

    private function validator(array $data, $variable)
    {
        $datas = [
            'Id' => $data['dataUser']['Id'],
            'NameUser' => $data['dataUser']['Name'],
            'Password' => $data['dataUser']['Password'],
            'RoleId' => $data['dataUser']['RoleId'],
            'Email' => $data['dataUser']['Email'],
            'NameRole' => $data['dataRole']['Name']
        ];
        $rules = null;
        switch ($variable) {
            case "validatorUser": {
                $rules = [
                    'NameUser' => 'required|min:6',
                    'RoleId' => 'required',
                    'Email' => 'required|email'
                ];
                break;
            }
            case "validatorRole": {
                $rules = [
                    'NameRole' => 'required'
                ];
                break;
            }
        }
        return Validator::make($datas, $rules);
    }
}
