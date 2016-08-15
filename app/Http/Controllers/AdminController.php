<?php

namespace App\Http\Controllers;

use App\Age;
use App\DetailedTreatment;
use App\InformationSurveys;
use App\LocationTreatment;
use App\ManagementTherapist;
use App\Package;
use App\PatientManagement;
use App\Position;
use App\ProfessionalTreatment;
use App\Provinces;
use App\Role;
use App\TreatmentPackage;
use App\TreatmentRegimen;
use App\User;
use Auth;
use DateTime;
use DB;
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
            if ($position) {
                return view('admin.position')->with('Positions', $position);
            } else {
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
            if ($position) {
                return $position;
            } else {
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
                'id' => $patient->id,
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
        try {
            $patient = PatientManagement::where('active', 1)->where('id', $request->get('idPatient'))->first();
            if ($patient) {
                return $patient;
            } else {
                return null;
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function deletePatient(Request $request)
    {
        try {
            $patient = PatientManagement::where('active', 1)->where('id', $request->get('idPatient'))->first();
            if ($patient) {
                $patient->active = 0;
                $patient->upDatedBy = Auth::user()->id;
                $patient->save();
                return array(1, 'listPatient' => $this->getPatient());
            } else {
                return array(0, 'listPatient' => null);
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function addNewAndUpdatePatient(Request $request)
    {
        try {
            $result = null;
            if ($this->validator($request->all(), "validatorPatient")->fails()) {
                return $this->validator($request->all(), "validatorPatient")->errors();
            } else {
                if ($request->get('addNewOrUpdateId') == "") {
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
                        $result = array(1, 'listPatient' => $this->getPatient());
                    } catch (Exception $ex) {
                        return $ex;
                    }
                } else {
                    $patient = PatientManagement::where('active', 1)->where('id', $request->get('addNewOrUpdateId'))->first();
                    if ($patient) {
                        try {
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
                            $result = array(2, 'listPatient' => $this->getPatient());
                        } catch (Exception $ex) {
                            return $ex;
                        }
                    } else {
                        $result = array(0, 'listPatient' => null);
                    }
                }
            }
            return $result;
        } catch (Exception $ex) {
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
            if ($therapist) {
                return $therapist;
            } else {
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
                        $therapist->address = $request->get('dataTherapist')['Address'];
                        $therapist->phone = $request->get('dataTherapist')['Phone'];
                        $therapist->sex = $request->get('dataTherapist')['Sex'];
                        $therapist->ageId = $request->get('dataTherapist')['AgeId'];
                        $therapist->provincialId = $request->get('dataTherapist')['ProvincialId'];
                        $therapist->createdBy = Auth::user()->id;
                        $therapist->updatedBy = Auth::user()->id;
                        $therapist->save();
                        $result = array(1, 'listTherapist' => $this->getTherapist());
                    } catch (Exception $ex) {
                        return $ex;
                    }
                } else {
                    try {
                        $therapist = ManagementTherapist::where('active', 1)->where('id', $request->get('addNewOrUpdateId'))->first();
                        if ($therapist) {
                            $therapist->code = $request->get('dataTherapist')['Code'];
                            $therapist->name = $request->get('dataTherapist')['Name'];
                            $therapist->address = $request->get('dataTherapist')['Address'];
                            $therapist->phone = $request->get('dataTherapist')['Phone'];
                            $therapist->sex = $request->get('dataTherapist')['Sex'];
                            $therapist->ageId = $request->get('dataTherapist')['AgeId'];
                            $therapist->provincialId = $request->get('dataTherapist')['ProvincialId'];
                            $therapist->updatedBy = Auth::user()->id;
                            $therapist->save();
                            $result = array(2, 'listTherapist' => $this->getTherapist());
                        } else {
                            $result = array(0, 'listTherapist' => null);
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
            if ($user) {
                return $user;
            } else {
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
        try {
            $SQL = "SELECT id,code, fullName, sex, birthday FROM patient_managements WHERE active = 1";
            if ($request->get('Patient')['Code'] != "") {

                $SQL .= " AND code LIKE '" . '%' . $request->get('Patient')['Code'] . '%' . "'";
            }
            if ($request->get('Patient')['FullName'] != "") {
                $SQL .= " AND fullName LIKE '" . '%' . $request->get('Patient')['FullName'] . '%' . "'";
            }
            if ($request->get('Patient')['Birthday'] != "") {
                $SQL .= " AND birthday LIKE '" . '%' . $request->get('Patient')['Birthday'] . '%' . "'";
            }
            if ($request->get('Patient')['Sex'] != "") {
                $SQL .= " AND sex LIKE '" . '%' . $request->get('Patient')['Sex'] . '%' . "'";
            }
            $patient = DB::select($SQL);
            return $patient;
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function SearchTreatmentPackages(Request $request)
    {
        try {
            $arraylistTreatment = [];
            $TreatmentPackage = TreatmentPackage::where('patientId', $request->get('IdPatient'))->get();
            foreach ($TreatmentPackage as $item) {
                $array = [
                    'id' => $item->id,
                    'active' => $item->active,
                    'code' => $item->code,
                    'namePackage' => $item->Package()->name,
                    'note' => $item->note,
                    'createdDate' => $item->createdDate,
                    'packageId'=>$item->packageId
                ];
                array_push($arraylistTreatment, $array);
            }
            return $arraylistTreatment;
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function Treatment(Request $request)
    {
        $date = date('Y-m-d');
        try {
            if ($this->validator($request->all(), "validatorTreatmentPackages")->fails()) {
                return $this->validator($request->all(), "validatorTreatmentPackages")->errors();
            } else {
                if ($request->get('data')['AddNewId'] == "") {
                    try {
                        $treatment = new TreatmentPackage();
                        $treatment->code = $request->get('data')['TreatmentPackageCode'];
                        $treatment->name = "";
                        $treatment->note = $request->get('data')['Note'];
                        $treatment->packageId = $request->get('data')['PackagesId'];
                        $treatment->patientId = $request->get('data')['PatientId'];
                        $treatment->createdDate = $date;
                        $treatment->updateDate = $date;
                        $treatment->createdBy = Auth::user()->id;
                        $treatment->upDatedBy = Auth::user()->id;
                        $treatment->save();
                    }
                    catch (Exception $ex){
                        return $ex;
                    }
                    return 1;
                } else {
                    try{
                        $treatment = TreatmentPackage::where('active',1)->where('id',$request->get('data')['AddNewId'])->first();
                        if($treatment){
                            $treatment->code = $request->get('data')['TreatmentPackageCode'];
                            $treatment->name = "";
                            $treatment->note = $request->get('data')['Note'];
                            $treatment->packageId = (integer)$request->get('data')['PackagesId'];
                            $treatment->patientId = (integer)$request->get('data')['PatientId'];
                            $treatment->updateDate = $date;
                            $treatment->upDatedBy = (string)Auth::user()->id;
                            $treatment->save();
                        }
                    }
                    catch (Exception $ex){
                        return $ex;
                    }
                    return 2;
                }
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function addNewTreatment(Request $request)
    {
        try {
            DB::beginTransaction();
            $date = date('Y-m-d');
            $result = $this->Treatment($request);
            if ($result==1) {
                    $packageId = TreatmentPackage::where('id', DB::table('treatment_packages')->max('id'))->first();
                    try {
                        $regimen = new TreatmentRegimen();
                        $regimen->code = $packageId->code;
                        $regimen->patientId = $request->get('data')['PatientId'];
                        $regimen->treatmentPackageId = $packageId->id;
                        $regimen->status = "";
                        $regimen->note = "";
                        $regimen->createdDate = $date;
                        $regimen->updatedDate = $date;
                        $regimen->createdBy = (string)Auth::user()->id;
                        $regimen->updatedBy = (string)Auth::user()->id;
                        $regimen->save();

                    } catch (Exception $ex) {
                        DB::rollBack();
                        return $ex;
                    }
                    DB::commit();
                    return 1;
            }else{
                try {
                    $packageId = TreatmentPackage::where('active', 1)->where('id', $request->get('data')['AddNewId'])->first();
                    $regimen = TreatmentRegimen::where('active', 1)->where('code', $packageId->code)->first();
                    if ($regimen) {
                        $regimen->code = $packageId->code;
                        $regimen->patientId = $request->get('data')['PatientId'];
                        $regimen->treatmentPackageId = $packageId->id;
                        $regimen->status = "";
                        $regimen->note = "";
                        $regimen->updatedDate = $date;
                        $regimen->updatedBy = (string)Auth::user()->id;
                        $regimen->save();
                    } else {
                        DB::rollBack();
                        return 0;
                    }
                    DB::commit();
                    return 2;
                }
                catch (Exception $ex){
                    DB::rollBack();
                    return $ex;
                }
            }
        }
        catch (Exception $ex){
            DB::rollBack();
            return $ex;
        }
    }

    public function deleteTreatmentPackage(Request $request)
    {
        try {
            $delete = TreatmentPackage::where('active', 1)->where('id', $request->get('id'))->first();
            if ($delete) {
                $delete->active = 0;
                $delete->save();
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function getViewTreatmentPackage()
    {
        return view('admin.treatmentPackage');
    }

    public function getDiagnostic()
    {
        $professional = ProfessionalTreatment::where('active', 1)->get()->groupBy('locationTreatmentId');
        return $professional;
    }

    public function getViewDiagnostic()
    {
        $package = Package::where('active', 1)->get();
        $patient = PatientManagement::where('active', 1)->get();
        return view('admin.diagnostic')->with('professionals', $this->getDiagnostic())
            ->with('packages', $package)->with('patients', $patient);
    }

    public function deleteRowDetail(Request $request)
    {
        try {
            DB::table('detailed_treatments')
                ->where('patientId', '=', $request->get('idPatient'))
                ->where('treatmentPackageId', '=', $request->get('idTreatmentPackage'))
                ->delete();
            return true;
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function updateDetailTreatment(Request $request)
    {
        try {
            DB::beginTransaction();
            $date = date('Y/m/d H:i:s');
            if ($this->deleteRowDetail($request)) {
                try {
                    for ($i = 0; $i < count($request->get('data')); $i++) {
                        $updateDetail = new DetailedTreatment();
                        $updateDetail->name = "";
                        $updateDetail->treatmentPackageId = $request->get('idTreatmentPackage');
                        $updateDetail->patientId = $request->get('idPatient');
                        $updateDetail->professionalTreatmentId = $request->get('data')[$i];
                        $updateDetail->therapistId = 0;// chuyen vien chua thuc hien
                        $updateDetail->ail = 2;//chua biet dau hay khong dau
                        $updateDetail->note = "";
                        $updateDetail->createdDate = $date;
                        $updateDetail->updateDate = $date;
                        $updateDetail->createdBy = Auth::user()->id;
                        $updateDetail->upDatedBy = Auth::user()->id;
                        $updateDetail->save();
                    }
                } catch (Exception $ex) {
                    DB::rollback();
                    return $ex;
                }
                DB::commit();
                return 1;
            }
        } catch (Exception $ex) {
            DB::rollback();
            return $ex;
        }
    }

    public function searchProfessional(Request $request)
    {
        try {
            $Professional = DB::table('detailed_treatments as detail')
                ->join('professional_treatments as pro', 'detail.professionalTreatmentId', '=', 'pro.id')
                ->join('location_treatments as location', 'pro.locationTreatmentId', '=', 'location.id')
                ->join('treatment_packages as treatment', 'treatment.id', '=', 'detail.treatmentPackageId')
                ->where('treatment.id', '=', $request->get('idPackageTreatment'))
                ->select(
                    'detail.id as detailId',
                    'detail.name as detailName',
                    'location.id as locationId',
                    'location.name as locationName',
                    'pro.id as professionalId',
                    'pro.name as professionalName'
                )
                ->get();
            return $Professional;
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function getSurveyProgression()
    {
        return view('admin.surveyprogression')->with('professionals', $this->getDiagnostic());
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
        } else if ($variable == "validatorPatient") {
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
        } else if ($variable == "validatorPackage") {
            $datas = [
                'Name' => $data['dataPackage']['Name'],
            ];
            $rules = [
                'Name' => 'required',
            ];
            [
                'Name.required' => 'Tên gói không được rỗng',
            ];
        } else if ($variable == "validatorTmPackage") {
            $datas = [
                'Name' => $data['dataTmPackage']['Name'],
            ];
            $rules = [
                'Name' => 'required',
            ];
            [
                'Name.required' => 'Tên gói không được rỗng',
            ];
        } else if ($variable == "validatorProTm") {
            $datas = [
                'Name' => $data['dataProTreatment']['Name'],
            ];
            $rules = [
                'Name' => 'required',
            ];
            [
                'Name.required' => 'Phương pháp điều trị không được rỗng',
            ];
        }else if ($variable == "validatorLocation") {
            $datas = [
                'Name' => $data['dataLocation']['Name'],
            ];
            $rules = [
                'Name' => 'required',
            ];
            [
                'Name.required' => 'Vị trí điều trị không được rỗng',
            ];
        }
        else if ($variable == "validatorProvince") {
            $datas = [
                'Name' => $data['dataProvince']['Name'],
            ];
            $rules = [
                'Name' => 'required',
            ];
            [
                'Name.required' => 'Tên tỉnh thành không được rỗng',
            ];
        }else if ($variable == "validatorAge") {
            $datas = [
                'Age' => $data['dataAge']['Age'],
            ];
            $rules = [
                'Age' => 'required',
            ];
            [
                'Age.required' => 'Tuổi không được rỗng',
            ];
        }else if($variable =="validatorRegimen"){

        }else if($variable =="validatorTreatmentPackages"){
            $datas = [
                'TreatmentPackageCode' => $data['data']['TreatmentPackageCode'],
            ];
            $rules = [
                'TreatmentPackageCode' => 'required',
            ];
            [
                'TreatmentPackageCode.required' => 'Mã phiếu không được rỗng',
            ];
        } else if ($variable == "validatorProTm") {
            $datas = [
                'Name' => $data['dataProTreatment']['Name'],
            ];
            $rules = [
                'Name' => 'required',
            ];
            [
                'Name.required' => 'Phương pháp điều trị không được rỗng',
            ];
        }else if ($variable == "validatorLocation") {
            $datas = [
                'Name' => $data['dataLocation']['Name'],
            ];
            $rules = [
                'Name' => 'required',
            ];
            [
                'Name.required' => 'Vị trí điều trị không được rỗng',
            ];
        }
        else if ($variable == "validatorProvince") {
            $datas = [
                'Name' => $data['dataProvince']['Name'],
            ];
            $rules = [
                'Name' => 'required',
            ];
            [
                'Name.required' => 'Tên tỉnh thành không được rỗng',
            ];
        }else if ($variable == "validatorAge") {
            $datas = [
                'Age' => $data['dataAge']['Age'],
            ];
            $rules = [
                'Age' => 'required',
            ];
            [
                'Age.required' => 'Tuổi không được rỗng',
            ];
        }else if ($variable == 'validatorInformation') {
            $datas = [
                'Question' => $data['dataInformation']['Question'],
            ];
            $rules = [
                'Question' => 'required',
            ];
            [
                'Question.required' => 'Câu hỏi không được rỗng',
            ];
        }
        return Validator::make($datas, $rules);
    }

    public function checkAilOrNotAil(Request $request)
    {
        try {
            $detail = DetailedTreatment::where('active', 1)
                ->where('professionalTreatmentId', $request->get('professionalId'))->first();
            return $detail;
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function updateAil(Request $request)
    {
        try {
            $detail = DetailedTreatment::where('active', 1)->where('treatmentPackageId', $request->get('treatmentPackageId'))
                ->where('patientId', $request->get('patientId'))->where('professionalTreatmentId', $request->get('professionalId'))->first();
            if ($detail) {
                $detail->ail = $request->get('ail');
                $detail->therapistId = $request->get('therapistId');
                $detail->save();
                return 1;
            } else {
                return 2;
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function updateNotAil(Request $request)
    {
        try {
            $detail = DetailedTreatment::where('active', 1)->where('id', $request->get('id'))->first();
            if ($detail) {
                $detail->ail = 0;
                $detail->therapistId = Auth::user()->id;
                $detail->save();
                return 1;
            } else {
                return 2;
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function getRegimens()
    {
        return view('admin.regimens')->with('professionals', $this->getDiagnostic());
    }

    public function searchRegimens(Request $request)
    {
        try {
            $SQL = "SELECT pm.`code` as 'maBN',pm.fullName, tr.`code` as 'maPD',tr.createdDate FROM treatment_regimens tr INNER JOIN  patient_managements pm  ON pm.id = tr.patientId WHERE pm.active = 1";
            if ($request->get('Patient')['CodePatient'] != "") {
                $SQL .= " AND pm.`code` LIKE '" . '%' . $request->get('Patient')['CodePatient'] . '%' . "'";
            }
            if ($request->get('Patient')['FullName'] != "") {
                $SQL .= " AND pm.fullName LIKE '" . '%' . $request->get('Patient')['FullName'] . '%' . "'";
            }
            if ($request->get('Patient')['CodeRegimen'] != "") {
                $SQL .= " AND tr.`code` LIKE '" . '%' . $request->get('Patient')['CodeRegimen'] . '%' . "'";
            }
            if ($request->get('Patient')['CreatedDate'] != "") {
                $SQL .= " AND tr.createdDate LIKE '" . '%' . $request->get('Patient')['CreatedDate'] . '%' . "'";
            }
            $patient = DB::select($SQL);
            return $patient;
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function getViewProfessional()
    {
        $therapist = ManagementTherapist::where('active', 1)->get();
        return view('admin.professional')->with('professionals', $this->getDiagnostic())
            ->with('therapists', $therapist);
    }

    public function fillToTbody(Request $request)
    {
        $detailedTreatment = DB::table('detailed_treatments as detail')
            ->join('professional_treatments as pro', 'detail.professionalTreatmentId', '=', 'pro.id')
            ->join('location_treatments as location', 'pro.locationTreatmentId', '=', 'location.id')
            ->join('treatment_packages as treatment', 'treatment.id', '=', 'detail.treatmentPackageId')
            ->where('treatment.id', '=', $request->get('idPackageTreatment'))
            ->select(
                'detail.id as detailId',
                'detail.name as detailName',
                'detail.therapistId as detailTherapist',
                'detail.ail as detailAil',
                'location.id as locationId',
                'location.name as locationName',
                'pro.id as professionalId',
                'pro.name as professionalName'
            )
            ->get();
        $Therapist=ManagementTherapist::where('active',1)->get();
        return view('admin.tbody')->with('detailedTreatments',$detailedTreatment)->with('therapists',$Therapist);
    }

    public function SearchTreatmentRegimens(Request $request)
    {
        try{
            $arraylistTreatment = [];
            $TreatmentPackage = TreatmentRegimen::where('active',1)->where('code',$request->get('IdTreatmentRegimen'))->get();
            foreach ($TreatmentPackage as $item) {
                $array = [
                    'id' => $item->id,
                    'active' => $item->active,
                    'code' => $item->code,
                    'status' => $item->status,
                    'note' => $item->note,
                    'treatmentPackageId' => $item->treatmentPackageId,
                    'createdDate' => $item->createdDate,
                    'updatedDate' => $item->updatedDate,
                ];
                array_push($arraylistTreatment, $array);
            }
            return $arraylistTreatment;
        }
        catch (Exception $ex){
            return $ex;
        }
    }

    public function tbodyRegimen(Request $request)
    {
        try{
            $detailedTreatment = DB::table('detailed_treatments as detail')
                ->join('professional_treatments as pro', 'detail.professionalTreatmentId', '=', 'pro.id')
                ->join('location_treatments as location', 'pro.locationTreatmentId', '=', 'location.id')
                ->join('treatment_packages as treatment', 'treatment.id', '=', 'detail.treatmentPackageId')
                ->where('treatment.id', '=', $request->get('idPackageTreatment'))
                ->select(
                    'detail.id as detailId',
                    'detail.name as detailName',
                    'detail.therapistId as detailTherapist',
                    'detail.ail as detailAil',
                    'location.id as locationId',
                    'location.name as locationName',
                    'pro.id as professionalId',
                    'pro.name as professionalName'
                )
                ->get();
            $Therapist=ManagementTherapist::where('active',1)->get();
            return view('admin.tbodyregimen')->with('detailedTreatments',$detailedTreatment)->with('therapists',$Therapist);
        }
        catch (Exception $ex){

        }
    }

    public function updateRegimen(Request $request)
    {
        try{
            if($request->get('data')['AddNewId']!=null){
                $regimen=TreatmentRegimen::where('active',1)->where('code',$request->get('data')['AddNewId'])->first();
                if($regimen){
                    $regimen->status = $request->get('data')['Status'];
                    $regimen->note = $request->get('data')['Note'];
                    $regimen->save();
                    return 1;
                }
                else{
                    return 0;
                }
            }else{
                return 0;
            }
        }
        catch (Exception $ex){
            return $ex;
        }
    }

    public function getStatisticsPatients()
    {
        return view('admin.statisticsPatients');
    }

    public function searchStatusPatient(Request $request)
    {
        try{
            $status = DB::table('treatment_regimens')
                ->join('patient_managements','treatment_regimens.patientId','=','patient_managements.id')
                ->whereBetween('createdDate',[$request->get('data')['FromDate'],$request->get('data')['ToDate']])
                ->select(
                    'treatment_regimens.id',
                    'treatment_regimens.status',
                    'patient_managements.fullName',
                    'treatment_regimens.note'
                );
            if($request->get('data')['Status']==0){

            }else if($request->get('data')['Status']==1){
                $status->where('treatment_regimens.status',1);
            }else if($request->get('data')['Status']==2){
                $status->where('treatment_regimens.status',2);
            }else if($request->get('data')['Status']==3){
                $status->where('treatment_regimens.status',3);
            }
            $regiment = $status->get();
            return $regiment;
        }
        catch (Exception $ex){
            return $ex;
        }
    }

    public function getStatisticsTherapist()
    {
        $therapist = ManagementTherapist::where('active', 1)->get();
        return view('admin.statisticsTherapist')->with('therapists',$therapist);
    }

    public function searchProfessionalTherapist(Request $request)
    {
        try{
            $searchProfessionalTherapist = DB::table('detailed_treatments')
                ->join('management_therapists','detailed_treatments.therapistId','=','management_therapists.id')
                ->join('patient_managements','detailed_treatments.patientId','=','patient_managements.id')
                ->join('professional_treatments','detailed_treatments.professionalTreatmentId','=','professional_treatments.id')
                ->whereBetween('createdDate',[$request->get('data')['FromDate'],$request->get('data')['ToDate']])
                ->where('detailed_treatments.therapistId',$request->get('data')['TherapistId'])
                ->select(
                    'detailed_treatments.id',
                    'professional_treatments.name',
                    'detailed_treatments.createdDate',
                    'patient_managements.code',
                    'detailed_treatments.ail'
                )
                ->get();
            return $searchProfessionalTherapist;
        }
        catch (Exception $ex){
            return $ex;
        }
    }


    // Anh Tam



    public function getViewPackage()
    {
        try {
            $Package = Package::where('active', 1)->get();
            return view('admin.package')->with('Packages', $Package);
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function postViewPackage(Request $request)
    {
        try {
            $package = Package::where('active', 1)->where('id', $request->get('idPackage'))->first();
            if ($package) {
                return $package;
            } else {
                return null;
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function deletePackage(Request $request)
    {
        try {
            $package = Package::where('active', 1)->where('id', $request->get('idPackage'))->first();
            if ($package) {
                $package->active = 0;
                $package->updatedBy = Auth::user()->id;
                $package->save();
            }
            return array(1, 'listPackage' => $this->getPackage());
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function getPackage()
    {
        $arrayListPackage = [];
        $listPackages = Package::where('active', 1)->get();
        foreach ($listPackages as $listPackage) {
            $array = [
                'id' => $listPackage->id,
                'name' => $listPackage->name,
                'price' => $listPackage->price,
                'note' => $listPackage->note,
            ];
            array_push($arrayListPackage, $array);
        }
        return $arrayListPackage;
    }

    public function addNewAndUpdatePackage(Request $request)
    {
        try {
            $result = null;
            if ($this->validator($request->all(), "validatorPackage")->fails()) {
                return $this->validator($request->all(), "validatorPackage")->errors();
            } else {
                if ($request->get('addNewOrUpdateId') == "") {
                    try {
                        $package = new Package();
                        $package->name = $request->get('dataPackage')['Name'];
                        $package->price = $request->get('dataPackage')['Price'];
                        $package->note = $request->get('dataPackage')['Note'];
                        $package->createdBy = Auth::user()->id;
                        $package->upDatedBy = Auth::user()->id;
                        $package->save();
                        $result = array(1, 'listPackage' => $this->getPackage());
                    } catch (Exception $ex) {
                        return $ex;
                    }
                } else {
                    $package = Package::where('active', 1)->where('id', $request->get('addNewOrUpdateId'))->first();
                    if ($package) {
                        try {
                            $package->name = $request->get('dataPackage')['Name'];
                            $package->price = $request->get('dataPackage')['Price'];
                            $package->note = $request->get('dataPackage')['Note'];
                            $package->createdBy = Auth::user()->id;
                            $package->upDatedBy = Auth::user()->id;
                            $package->save();
                            $result = array(2, 'listPackage' => $this->getPackage());
                        } catch (Exception $ex) {
                            return $ex;
                        }
                    } else {
                        $result = array(0, 'listPackage' => null);
                    }
                }
            }
            return $result;
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function getViewProTreatment()
    {
        try {
            $location = LocationTreatment::where('active', 1)->get();
            $proTm = ProfessionalTreatment::where('active', 1)->get();
            return view('admin.protreatment')->with('proTms', $proTm)->with('Locations', $location);
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function postViewProTm(Request $request)
    {
        try {
            $proTm = ProfessionalTreatment::where('active', 1)->where('id', $request->get('idProTreatment'))->first();
            if ($proTm) {
                return $proTm;
            } else {
                return null;
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function deleteProTreatment(Request $request)
    {
        try {
            $proTm = ProfessionalTreatment::where('active', 1)->where('id', $request->get('idProTreatment'))->first();
            if ($proTm) {
                $proTm->active = 0;
                $proTm->updatedBy = Auth::user()->id;
                $proTm->save();
            }
            return array(1, 'listProTreatment' => $this->getProTreatment());
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function getProTreatment()
    {
        $arrayListProTreatment = [];
        $listProTreatment = ProfessionalTreatment::where('active', 1)->get();
        foreach ($listProTreatment as $item) {
            $array = [
                'Id' => $item->id,
                'Name' => $item->name,
                'LocationTreatmentId' => $item->localTreatment()->name,
                'Note' => $item->note,
            ];
            array_push($arrayListProTreatment, $array);
        }
        return $arrayListProTreatment;
    }

    public function addNewAndUpdateProTreatment(Request $request)
    {
        try {
            $result = null;
            if ($this->validator($request->all(), "validatorProTm")->fails()) {
                return $this->validator($request->all(), "validatorProTm")->errors();
            } else {
                if ($request->get('addNewOrUpdateId') == "") {
                    try {
                        $ProTm = new ProfessionalTreatment();
                        $ProTm->name = $request->get('dataProTreatment')['Name'];
                        $ProTm->locationTreatmentId = $request->get('dataProTreatment')['LocationTreatmentId'];
                        $ProTm->note = $request->get('dataProTreatment')['Note'];
                        $ProTm->upDatedBy = Auth::user()->id;
                        $ProTm->save();
                        $result = array(1, 'listProTreatment' => $this->getProTreatment());
                    } catch (Exception $ex) {
                        return $ex;
                    }
                } else {
                    //$Location = locationTreatment::where('active', 1)->where('id', $request->get('addNewOrUpdateId'))->first();
                    $ProTm = ProfessionalTreatment::where('active', 1)->where('id', $request->get('addNewOrUpdateId'))->first();
                    if ($ProTm) {
                        try {
                            $ProTm->name = $request->get('dataProTreatment')['Name'];
                            $ProTm->locationTreatmentId = $request->get('dataProTreatment')['LocationTreatmentId'];
                            //$ProTm->locationTreatmentId = LocationTreatment::where('name',$request->get('dataProTreatment')['NameTreatment'])->first()->id;
                            $ProTm->note = $request->get('dataProTreatment')['Note'];
                            $ProTm->upDatedBy = Auth::user()->id;
                            $ProTm->save();
                            $result = array(2, 'listProTreatment' => $this->getProTreatment());
                        } catch (Exception $ex) {
                            return $ex;
                        }
                    } else {
                        $result = array(0, 'listProTreatment' => null);
                    }
                }
            }
            return $result;
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function getViewLocation(){

        try {
            $locaTion = LocationTreatment::where('active', 1)->get();
            return view("admin.location")->with('locaTions',$locaTion);
        }catch(Exception $ex){
            return $ex;

        }
    }

    public function postViewLocation(Request $request)
    {
        try {
            $location = LocationTreatment::where('active', 1)->where('id', $request->get('idLocation'))->first();
            if ($location) {
                return $location;
            } else {
                return null;
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function deleteLocation(Request $request)
    {
        try {
            $location = LocationTreatment::where('active', 1)->where('id', $request->get('idLocation'))->first();
            if ($location) {
                $location->active = 0;
                $location->updatedBy = Auth::user()->id;
                $location->save();
            }
            return array(1, 'listLocation' => $this->getLocation());
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function getLocation()
    {
        $arrayListLocation = [];
        $listLocation = LocationTreatment::where('active', 1)->get();
        foreach ($listLocation as $listLocation) {
            $array = [
                'id' => $listLocation->id,
                'Name' => $listLocation->name,
                'Note' => $listLocation->note,
            ];
            array_push($arrayListLocation, $array);
        }
        return $arrayListLocation;
    }

    public function addNewAndUpdateLocation(Request $request)
    {
        try {
            $result = null;
            if ($this->validator($request->all(), "validatorLocation")->fails()) {
                return $this->validator($request->all(), "validatorLocation")->errors();
            } else {
                if ($request->get('addNewOrUpdateId') == "") {
                    try {
                        $location = new LocationTreatment();
                        $location->name = $request->get('dataLocation')['Name'];
                        $location->note = $request->get('dataLocation')['Note'];
                        $location->upDatedBy = Auth::user()->id;
                        $location->save();
                        $result = array(1, 'listLocation' => $this->getLocation());
                    } catch (Exception $ex) {
                        return $ex;
                    }
                } else {
                    $location = LocationTreatment::where('active', 1)->where('id', $request->get('addNewOrUpdateId'))->first();
                    if ($location) {
                        try {
                            $location->name = $request->get('dataLocation')['Name'];
                            $location->note = $request->get('dataLocation')['Note'];
                            $location->upDatedBy = Auth::user()->id;
                            $location->save();
                            $result = array(2, 'listLocation' => $this->getLocation());
                        } catch (Exception $ex) {
                            return $ex;
                        }
                    } else {
                        $result = array(0, 'listLocation' => null);
                    }
                }
            }
            return $result;
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function getViewProvinces()
    {
        try {
            $province = Provinces::where('active', 1)->get();
            return view("admin.provinces")->with('Provinces', $province);
        } Catch (Exception $ex) {
            return $ex;

        }
    }

    public function postViewProvince(Request $request)
    {
        try {
            $province = Provinces::where('active', 1)->where('id', $request->get('idProvince'))->first();
            if ($province) {
                return $province;
            } else {
                return null;
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function deleteProvince(Request $request)
    {
        try {
            $province = Provinces::where('active', 1)->where('id', $request->get('idProvince'))->first();
            if ($province) {
                $province->active = 0;
                $province->updatedBy = Auth::user()->id;
                $province->save();
            }
            return array(1, 'listProvince' => $this->getProvince());
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function getProvince()
    {
        $arrayListProvince = [];
        $listProvince = Provinces::where('active', 1)->get();
        foreach ($listProvince as $listProvince) {
            $array = [
                'id' => $listProvince->id,
                'Name' => $listProvince->name,
            ];
            array_push($arrayListProvince, $array);
        }
        return $arrayListProvince;
    }

    public function addNewAndUpdateProvince(Request $request)
    {
        try {
            $result = null;
            if ($this->validator($request->all(), "validatorProvince")->fails()) {
                return $this->validator($request->all(), "validatorProvince")->errors();
            } else {
                if ($request->get('addNewOrUpdateId') == "") {
                    try {
                        $province = new Provinces();
                        $province->name = $request->get('dataProvince')['Name'];
                        $province->upDatedBy = Auth::user()->id;
                        $province->save();
                        $result = array(1, 'listProvince' => $this->getProvince());
                    } catch (Exception $ex) {
                        return $ex;
                    }
                } else {
                    $province = Provinces::where('active', 1)->where('id', $request->get('addNewOrUpdateId'))->first();
                    if ($province) {
                        try {
                            $province->name = $request->get('dataProvince')['Name'];
                            $province->upDatedBy = Auth::user()->id;
                            $province->save();
                            $result = array(2, 'listProvince' => $this->getProvince());
                        } catch (Exception $ex) {
                            return $ex;
                        }
                    } else {
                        $result = array(0, 'listProvince' => null);
                    }
                }
            }
            return $result;
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function getViewAge()
    {
        try {
            $age = Age::where('active', 1)->get();
            return view("admin.age")->with('Ages', $age);
        } Catch (Exception $ex) {
            return $ex;

        }
    }

    public function postViewAge(Request $request)
    {
        try {
            $age = Age::where('active', 1)->where('id', $request->get('idAge'))->first();
            if ($age) {
                return $age;
            } else {
                return null;
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function deleteAge(Request $request)
    {
        try {
            $age = Age::where('active', 1)->where('id', $request->get('idAge'))->first();
            if ($age) {
                $age->active = 0;
                $age->updatedBy = Auth::user()->id;
                $age->save();
            }
            return array(1, 'listAge' => $this->getAge());
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function getAge()
    {
        $arrayListAge = [];
        $listAge = Age::where('active', 1)->get();
        foreach ($listAge as $listAge) {
            $array = [
                'id' => $listAge->id,
                'Age' => $listAge->age,
            ];
            array_push($arrayListAge, $array);
        }
        return $arrayListAge;
    }

    public function addNewAndUpdateAge(Request $request)
    {
        try {
            $result = null;
            if ($this->validator($request->all(), "validatorAge")->fails()) {
                return $this->validator($request->all(), "validatorAge")->errors();
            } else {
                if ($request->get('addNewOrUpdateId') == "") {
                    try {
                        $age = new Age();
                        $age->age = $request->get('dataAge')['Age'];
                        $age->upDatedBy = Auth::user()->id;
                        $age->save();
                        $result = array(1, 'listAge' => $this->getAge());
                    } catch (Exception $ex) {
                        return $ex;
                    }
                } else {
                    $age = Age::where('active', 1)->where('id', $request->get('addNewOrUpdateId'))->first();
                    if ($age) {
                        try {
                            $age->age = $request->get('dataAge')['Age'];
                            $age->upDatedBy = Auth::user()->id;
                            $age->save();
                            $result = array(2, 'listAge' => $this->getAge());
                        } catch (Exception $ex) {
                            return $ex;
                        }
                    } else {
                        $result = array(0, 'listAge' => null);
                    }
                }
            }
            return $result;
        } catch (Exception $ex) {
            return $ex;
        }
    }
    public function getViewSearch()
    {
        try {
            return view("admin.searchregimen");
        } Catch (Exception $ex) {
            return $ex;
        }
    }

    public function searchPatientTest(Request $request)
    {
        try {
            $SQL = "SELECT pm.`code` as 'maBN', pm.`fullName`, tr.`code` as 'maPD',tr.createdDate,tr.status, tr.note FROM treatment_regimens tr INNER JOIN  patient_managements pm  ON pm.id = tr.patientId WHERE pm.active = 1";
            if ($request->get('Regimens')['CodePatient'] != "") {
                $SQL .= " AND pm.`code` LIKE '" . '%' . $request->get('Regimens')['CodePatient'] . '%' . "'";
            }
            if ($request->get('Regimens')['FullName'] != "") {
                $SQL .= " AND pm.`fullName` LIKE '" . '%' . $request->get('Regimens')['FullName'] . '%' . "'";
            }
            if ($request->get('Regimens')['CodeRegimen'] != "") {
                $SQL .= " AND tr.`code` LIKE '" . '%' . $request->get('Regimens')['CodeRegimen'] . '%' . "'";
            }
            if ($request->get('Regimens')['CreatedDate'] != "") {
                $SQL .= " AND tr.createdDate LIKE '" . '%' . $request->get('Regimens')['CreatedDate'] . '%' . "'";
            }
            $patient = DB::select($SQL);
            return $patient;
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function getViewInformationSurveys()
    {
        try {
            $patient = PatientManagement::where('active', 1)->get();
            $therapist = ManagementTherapist::where('active', 1)->get();
            $information = InformationSurveys::where('active', 1)->ORDERBY ('createdDate', 'ASC') ->get();
            return view("admin.informationsurveys")->with('Informations', $information)->with('patients', $patient)->with('therapists', $therapist);
        } Catch (Exception $ex) {
            return $ex;
        }
    }
    public function postViewInformation(Request $request)
    {
        try {
            $information = InformationSurveys::where('active', 1)->where('id', $request->get('idInformation'))->first();
            if ($information) {
                return $information;
            } else {
                return null;
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }
    public function deleteInformation(Request $request)
    {
        try {
            $information = InformationSurveys::where('active', 1)->where('id', $request->get('idInformation'))->first();
            if ($information) {
                $information->active = 0;
                $information->updatedBy = Auth::user()->id;
                $information->save();
            }
            return array(1, 'listInformation' => $this->getInformation());
        } catch (Exception $ex) {
            return $ex;
        }
    }
    public function getInformation()
    {
        $arrayListInformation = [];
        $listInformation = InformationSurveys::where('active', 1)->get();
        foreach ($listInformation as $listInformation) {
            $array = [
                'Id' =>$listInformation->id,
                'Question'=>$listInformation->question,
                'PatientReviews' =>$listInformation->patientReviews,
                'Handling' =>$listInformation->handling,
                'CreatedDate'=>$listInformation->createdDate,
            ];
            array_push($arrayListInformation, $array);
        }
        return $arrayListInformation;
    }
    public function addNewAndUpdateInformation(Request $request)
    {
        try {
            $result = null;
            if ($this->validator($request->all(), "validatorInformation")->fails()) {
                return $this->validator($request->all(), "validatorInformation")->errors();
            } else {
                if ($request->get('addNewOrUpdateId') == "") {
                    try {
                        $information = new InformationSurveys();
                        $information->createdDate = $request->get('dataInformation')['CreatedDate'];
                        $information->patientReviews = $request->get('dataInformation')['PatientReviews'];
                        $information->question = $request->get('dataInformation')['Question'];
                        if($request->get('dataInformation')['Handling'] === "")
                        {
                            $information->handling = '2';
                        }else {
                            $information->handling = $request->get('dataInformation')['Handling'];
                        }
                        $information->patient_id = $request->get('dataInformation')['Patient_id'];
                        $information->therapist_id = $request->get('dataInformation')['Therapist_id'];
                        $information->upDatedBy = Auth::user()->id;
                        $information->save();
                        $result = array(1, 'listInformation' => $this->getInformation());
                    } catch (Exception $ex) {
                        return $ex;
                    }
                } else {
                    $information = InformationSurveys::where('active', 1)->where('id', $request->get('addNewOrUpdateId'))->first();
                    if ($information) {
                        try {
                            $information->createdDate = $request->get('dataInformation')['CreatedDate'];
                            $information->patientReviews = $request->get('dataInformation')['PatientReviews'];
                            $information->question = $request->get('dataInformation')['Question'];
                            if($request->get('dataInformation')['Handling'] === "")
                            {
                                $information->handling = '2';
                            }else {
                                $information->handling = $request->get('dataInformation')['Handling'];
                            }
                            $information->patient_id = $request->get('dataInformation')['Patient_id'];
                            $information->therapist_id = $request->get('dataInformation')['Therapist_id'];
                            $information->upDatedBy = Auth::user()->id;
                            $information->save();
                            $result = array(2, 'listInformation' => $this->getInformation());
                        } catch (Exception $ex) {
                            return $ex;
                        }
                    } else {
                        $result = array(0, 'listInformation' => null);
                    }
                }
            }
            return $result;
        } catch (Exception $ex) {
            return $ex;
        }
    }
    public function getViewStatistics()
    {
        try {
            //  $information = InformationSurvey::where('active', 1)->get();
            return view("admin.statistical");
        } Catch (Exception $ex) {
            return $ex;
        }
    }
    public function searchStatistical(Request $request)
    {
          try{
              $SQL = "SELECT info.createdDate, info.question, info.handling, pm.fullName
                      FROM information_surveys info 
                      INNER JOIN  management_therapists mt  ON mt.id = info.therapist_id 
                      INNER JOIN  patient_managements pm  ON pm.id = info.patient_id";
              if ($request->get('data')['Handling'] == "0") {
                  $SQL .= " Where info.`createdDate` BETWEEN '" .$request->get('data')['ToDate']."'" . 'AND' ."'". $request->get('data')['FromDate']."'";
              }
              if ($request->get('data')['Handling'] != "0") {
                  $SQL .= " Where info.`createdDate` BETWEEN '" .$request->get('data')['ToDate']."'" .
                            'AND' ."'". $request->get('data')['FromDate']."'".
                            'AND info.`handling` ='."'". $request->get('data')['Handling']."'";
              }
                $SQL.="AND info.active = 1 ORDER BY createdDate ASC";
                $data = DB::select($SQL);
              return $data;
        }
        catch (Exception $ex){
            return $ex;
        }
    }

}
