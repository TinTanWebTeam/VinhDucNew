<?php

namespace App\Http\Controllers;

use App\Age;
use App\ManagementTherapist;
use App\PatientManagement;
use App\Position;
use App\Provinces;
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

    public function getViewPosition()
    {
        try {
            $position = Position::where('active', 1)->get();
            if($position) {
                return view('admin.position')->with('Positions', $position);
            }else{
                return null;
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function postViewPosition(Request $request)
    {
        try {
            $position = Position::where('active', 1)->where('id', $request->get('idPosition'))->first();
            if($position){
                return $position;
            }else{
                return null;
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function getPosition()
    {
        $arrayListPosition = [];
        $listPosition = Position::where('active', 1)->get();
        foreach ($listPosition as $position) {
            $array = [
                'id' => $position->id,
                'name' => $position->name,
                'description' => $position->description
            ];
            array_push($arrayListPosition, $array);
        }
        return $arrayListPosition;
    }

    public function addNewAndUpdatePosition(Request $request)
    {
        $result = null;
        try {
            if ($this->validator($request->all(), "validatorPosition")->fails()) {
                return $this->validator($request->all(), "validatorPosition")->errors();
            } else {
                if ($request->get('addNewOrUpdateId') == null) {
                    try {
                        $position = new Position();
                        $position->name = $request->get('dataPosition')['Name'];
                        $position->description = $request->get('dataPosition')['Description'];
                        $position->createdBy = Auth::user()->id;
                        $position->upDatedBy = Auth::user()->id;
                        $position->save();
                        $result = array(1, 'listPosition' => $this->getPosition());
                    } catch (Exception $ex) {
                        return $ex;
                    }
                } else {
                    try {
                        $position = Position::where('active', 1)->where('id', $request->get('dataPosition')['Id'])->first();
                        if ($position) {
                            $position->name = $request->get('dataPosition')['Name'];
                            $position->description = $request->get('dataPosition')['Description'];
                            $position->upDatedBy = Auth::user()->id;
                            $position->save();
                            $result = array(2, 'listPosition' => $this->getPosition());
                        } else {
                            $result = array(0, 'listPosition' => null);
                        }
                    } catch (Exception $ex) {
                        return $ex;
                    }
                }
                return $result;
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function getPatient()
    {
        $arrayListPatient = [];
        $listPatient = PatientManagement::where('active', 1)->get();
        foreach ($listPatient as $patient) {
            $array = [
                'id'=>$patient->id,
                'code' => $patient->code,
                'fullName' => $patient->fullName,
                'sex' => $patient->sex,
                'phone' => $patient->phone,
            ];
            array_push($arrayListPatient, $array);
        }
        return $arrayListPatient;
    }

    public function getViewPatient()
    {
        try {
            $age = Age::where('active', 1)->get();
            $province = Provinces::where('active', 1)->get();
            $patient = PatientManagement::where('active', 1)->get();
            return view('admin.patient')->with('patients', $patient)->with('ages', $age)->with('provinces', $province);
        } catch (Exception $ex) {

        }
    }

    public function postViewPatient(Request $request)
    {
        try{
            $patient=PatientManagement::where('active',1)->where('id',$request->get('idPatient'))->first();
            if($patient){
                return $patient;
            }else{
                return null;
            }
        }
        catch (Exception $ex){
            return $ex;
        }
    }

    public function deletePatient(Request $request)
    {
        try{
            $patient= PatientManagement::where('active',1)->where('id',$request->get('idPatient'))->first();
            if($patient){
                $patient->active=0;
                $patient->upDatedBy = Auth::user()->id;
                $patient->save();
                return array(1,'listPatient'=>$this->getPatient());
            }else{
                return array(0,'listPatient'=>null);
            }
        }
        catch (Exception $ex){
            return $ex;
        }
    }

    public function addNewAndUpdatePatient(Request $request)
    {
        try{
            $result = null;
            if ($this->validator($request->all(), "validatorPatient")->fails()) {
                return $this->validator($request->all(), "validatorPatient")->errors();
            } else {
                if($request->get('addNewOrUpdateId')==""){
                    try {
                        $patient = new PatientManagement();
                        $patient->code = $request->get('dataPatient')['Code'];
                        $patient->fullName = $request->get('dataPatient')['FullName'];
                        $patient->birthday = $request->get('dataPatient')['Birthday'];
                        $patient->sex = $request->get('dataPatient')['Sex'];
                        $patient->weight = $request->get('dataPatient')['Weight'];
                        $patient->height = $request->get('dataPatient')['Height'];
                        $patient->bloodPressure = $request->get('dataPatient')['BloodPressure'];
                        $patient->pulse = $request->get('dataPatient')['Pulse'];
                        $patient->job = $request->get('dataPatient')['Job'];
                        $patient->phone = $request->get('dataPatient')['Phone'];
                        $patient->address = $request->get('dataPatient')['Address'];
                        $patient->provincialId = $request->get('dataPatient')['ProvincialId'];
                        $patient->ageId = $request->get('dataPatient')['AgeId'];
                        $patient->createdBy = Auth::user()->id;
                        $patient->upDatedBy = Auth::user()->id;
                        $patient->save();
                        $result = array(1, 'listPatient'=>$this->getPatient());
                    }
                    catch (Exception $ex){
                        return $ex;
                    }
                }
                else{
                    $patient=PatientManagement::where('active',1)->where('id',$request->get('addNewOrUpdateId'))->first();
                    if($patient){
                        try{
                            $patient->code = $request->get('dataPatient')['Code'];
                            $patient->fullName = $request->get('dataPatient')['FullName'];
                            $patient->birthday = $request->get('dataPatient')['Birthday'];
                            $patient->sex = $request->get('dataPatient')['Sex'];
                            $patient->weight = $request->get('dataPatient')['Weight'];
                            $patient->height = $request->get('dataPatient')['Height'];
                            $patient->bloodPressure = $request->get('dataPatient')['BloodPressure'];
                            $patient->pulse = $request->get('dataPatient')['Pulse'];
                            $patient->job = $request->get('dataPatient')['Job'];
                            $patient->phone = $request->get('dataPatient')['Phone'];
                            $patient->address = $request->get('dataPatient')['Address'];
                            $patient->provincialId = $request->get('dataPatient')['ProvincialId'];
                            $patient->ageId = $request->get('dataPatient')['AgeId'];
                            $patient->upDatedBy = Auth::user()->id;
                            $patient->save();
                            $result = array(2, 'listPatient'=>$this->getPatient());
                        }
                        catch (Exception $ex){
                            return $ex;
                        }
                    }else{
                        $result = array(0, 'listPatient'=>null);
                    }
                }
            }
            return $result;
        }
        catch (Exception $ex){
            return $ex;
        }
    }

    public function getViewTherapist()
    {
        try {
            $age = Age::where('active', 1)->get();
            $province = Provinces::where('active', 1)->get();
            $therapist = ManagementTherapist::where('active', 1)->get();
            return view('admin.therapist')->with('ages', $age)->with('provinces', $province)->with('therapists', $therapist);
        } catch (Exception $ex) {

        }
    }

    public function getTherapist()
    {
        $arrayListTherapist = [];
        $listTherapist = ManagementTherapist::where('active', 1)->get();
        foreach ($listTherapist as $Therapist) {
            $array = [
                'id' => $Therapist->id,
                'code' => $Therapist->code,
                'name' => $Therapist->name,
                'sex' => $Therapist->sex,
                'phone' => $Therapist->phone,
                'provincial' => $Therapist->Provinces()->name,
                'age' => $Therapist->Age()->age
            ];
            array_push($arrayListTherapist, $array);
        }
        return $arrayListTherapist;
    }

    public function postViewTherapist(Request $request)
    {
        try {
            $therapist = ManagementTherapist::where('active', 1)->where('id', $request->get('idTherapist'))->first();
            if($therapist) {
                return $therapist;
            }else{
                return null;
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function deleteTherapist(Request $request)
    {
        try {
            $therapist = ManagementTherapist::where('active', 1)->where('id', $request->get('idTherapist'))->first();
            if ($therapist) {
                $therapist->active = 0;
                $therapist->upDatedBy = Auth::user()->id;
                $therapist->save();
                return array(1, 'listTherapist' => $this->getTherapist());
            } else {
                return array(0, 'listTherapist' => null);
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function addNewAndUpdateTherapist(Request $request)
    {
        try {
            $result = null;
            if ($this->validator($request->all(), "validatorTherapist")->fails()) {
                return $this->validator($request->all(), "validatorTherapist")->errors();
            } else {
                if ($request->get('addNewOrUpdateId') == null) {
                    try {
                        $therapist = new ManagementTherapist();
                        $therapist->code = $request->get('dataTherapist')['Code'];
                        $therapist->name = $request->get('dataTherapist')['Name'];
                        $therapist->address=$request->get('dataTherapist')['Address'];
                        $therapist->phone=$request->get('dataTherapist')['Phone'];
                        $therapist->sex=$request->get('dataTherapist')['Sex'];
                        $therapist->ageId=$request->get('dataTherapist')['AgeId'];
                        $therapist->provincialId=$request->get('dataTherapist')['ProvincialId'];
                        $therapist->createdBy=Auth::user()->id;
                        $therapist->updatedBy=Auth::user()->id;
                        $therapist->save();
                        $result = array(1,'listTherapist'=>$this->getTherapist());
                    } catch (Exception $ex) {
                        return $ex;
                    }
                }
                else{
                    try{
                        $therapist=ManagementTherapist::where('active',1)->where('id',$request->get('addNewOrUpdateId'))->first();
                        if($therapist){
                            $therapist->code = $request->get('dataTherapist')['Code'];
                            $therapist->name = $request->get('dataTherapist')['Name'];
                            $therapist->address=$request->get('dataTherapist')['Address'];
                            $therapist->phone=$request->get('dataTherapist')['Phone'];
                            $therapist->sex=$request->get('dataTherapist')['Sex'];
                            $therapist->ageId=$request->get('dataTherapist')['AgeId'];
                            $therapist->provincialId=$request->get('dataTherapist')['ProvincialId'];
                            $therapist->updatedBy=Auth::user()->id;
                            $therapist->save();
                            $result = array(2,'listTherapist'=>$this->getTherapist());
                        }else{
                            $result = array(0,'listTherapist'=>null);
                        }
                    }
                    catch (Exception $ex){
                        return $ex;
                    }
                }
                return $result;
            }
        } catch (Exception $ex) {

        }
    }

    public function getViewUser()
    {
        try {
            $role = Role::where('active', 1)->where('name', '!=', 'admin')->get();
            $user = User::where('active', 1)->where('roleId', '!=', 1)->get();
            $position = Position::where('active', 1)->get();
            return view('admin.user')->with('users', $user)->with('roles', $role)->with('positions', $position);
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function postViewUser(Request $request)
    {
        try {
            $user = User::where('active', 1)->where('id', $request->get('idUser'))->first();
            if($user){
                return $user;
            }else{
                return null;
            }
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
                'role' => $user->Role()->name,
                'position' => $user->Position()->name
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
                return array(1, 'listUser' => $this->getUser());
            } else {
                return array(0, 'listUser' => $this->getUser());
            }
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
                            $user->positionId = $request->get('dataUser')['PositionId'];
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
                                $user->positionId = $request->get('dataUser')['PositionId'];
                                $user->upDatedBy = Auth::user()->id;
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

    public function searchPatient(Request $request)
    {
        try{
            if($request->get('Patient') !=null){
                $patient=PatientManagement::where('fullName','LIKE','%'.$request->get('Patient')['FullName'].'%')
                                            ->where('code','LIKE','%'.$request->get('Patient')['Code'].'%')
                                            ->where('sex',$request->get('Patient')['Sex'])

                                            ->where('birthday','LIKE','%'.$request->get('Patient')['Birthday'].'%')

                                            ->where('active',1)->get();
            }

        }
        catch (Exception $ex){

        }
    }

    public function getViewTreatmentPackage()
    {
        return view('admin.treatmentPackage');
    }

    public function getViewDiagnostic()
    {
        return view('admin.diagnostic');
    }

    private function validator(array $data, $variable)
    {
        $rules = null;
        if ($variable == 'validatorUser') {
            $datas = [
                'Id' => $data['dataUser']['Id'],
                'Name' => $data['dataUser']['Name'],
                'Password' => $data['dataUser']['Password'],
                'RoleId' => $data['dataUser']['RoleId'],
                'Email' => $data['dataUser']['Email']
            ];
            $rules = [
                'Name' => 'required|min:6',
                'RoleId' => 'required',
                'Email' => 'required|email'
            ];
            [
                'Name.required' => 'Tên đăng nhập không được rỗng',
                'Name.min' => 'Tên đăng nhập phải có 6 kí tự ',
                'RoleId.required' => 'Quyền sử dụng không được rỗng',
                'Email.required' => 'Email không được rỗng',
                'Email.email' => 'Email không đúng định dạng'
            ];
        } else if ($variable == 'validatorPosition') {
            $datas = [
                'Name' => $data['dataPosition']['Name'],
            ];
            $rules = [
                'Name' => 'required',

            ];
            [
                'Name.required' => 'Tên chức vụ không được rỗng'
            ];
        } else if ($variable == 'validatorTherapist') {
            $datas = [
                'Code' => $data['dataTherapist']['Code'],
                'Name' => $data['dataTherapist']['Name'],
                'Address' => $data['dataTherapist']['Address'],
                'Phone' => $data['dataTherapist']['Phone']
            ];
            $rules = [
                'Code' => 'required',
                'Name' => 'required',
                'Address' => 'required',
                'Phone' => 'required',

            ];
            [
                'Code.required' => 'Mã chuyên viên không được rỗng',
                'Name.required' => 'Tên chuyên viên không được rỗng',
                'Address.required' => 'Địa chỉ chuyên viên không được rỗng',
                'Phone.required' => 'Số điện thoại chuyên viên không được rỗng'
            ];
        }else if($variable=="validatorPatient"){
            $datas = [
                'Code' => $data['dataPatient']['Code'],
                'Name' => $data['dataPatient']['FullName'],
                'Address' => $data['dataPatient']['Address'],
                'Phone' => $data['dataPatient']['Phone']
            ];
            $rules = [
                'Code' => 'required',
                'Name' => 'required',
                'Address' => 'required',
                'Phone' => 'required',
            ];
            [
                'Code.required' => 'Mã bệnh nhân không được rỗng',
                'Name.required' => 'Tên bệnh nhân không được rỗng',
                'Address.required' => 'Địa chỉ bệnh nhân không được rỗng',
                'Phone.required' => 'Số điện thoại bệnh nhân không được rỗng'
            ];
        }
        return Validator::make($datas, $rules);
    }
}
