<?php

namespace App\Http\Controllers\Personnel\Profile;

use App\Master\MasterBloodType;
use App\Master\MasterEducationType;
use App\Personnel\Info\Contract;
use App\Personnel\Info\EmpAddress;
use App\Personnel\Info\EmpBasic;
use App\Personnel\Info\EmpContract;
use App\Personnel\Info\EmpExperience;
use App\Personnel\Info\EmpReference;
use App\Personnel\Info\EmpSkill;
use App\Role;
use function Complex\add;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function show(EmpBasic $profile)
    {
        $isOwner = Auth::user()->can('update-basic') ? 'true' : 'false';

        $blood = MasterBloodType::all();
        $education_type= MasterEducationType::all();

        $role = Role::all();

        return view('personnel.profile.show', compact('profile','isOwner','blood','education_type','role'));
    }

    public function updateAddress(Request $request,EmpBasic $profile)
    {
        $add = $request->validate([

            'master_address_key' => 'required',

            'add_unit_num' => 'nullable',

            'add_block' => 'nullable',

            'add_street_name' => 'nullable',

            'add_subdivision' => 'nullable',

            'add_barangay' => 'nullable',

            'add_city' => 'nullable',

            'add_province' => 'nullable',

            'add_zip_code' => 'nullable',

        ]);

        for($i=0; $i < count($add['master_address_key']); ++$i ) {

            foreach ($profile->address as $address) {

                if($address->master_address_key === $add['master_address_key'][$i]) {

                    $address->unit_num = $add['add_unit_num'][$i];

                    $address->block = $add['add_block'][$i];

                    $address->street_name = $add['add_street_name'][$i];

                    $address->subdivision = $add['add_subdivision'][$i];

                    $address->barangay = $add['add_barangay'][$i];

                    $address->city = $add['add_city'][$i];

                    $address->province = $add['add_province'][$i];

                    $address->zip_code = $add['add_zip_code'][$i];

                    $address->update();
                }
            }
        }
    }

    public function updateContact(Request $request, EmpBasic $profile) {

        $contact = $request->validate([
            'telephone_num'          => 'nullable',
            'mobile_num'             => 'nullable',
            'other_mobile'           => 'nullable',

        ]);

        foreach ($profile->info as $con) {
            $con->telephone_num = $contact['telephone_num'];
            $con->mobile_num = $contact['mobile_num'];
            $con->other_mobile = $contact['other_mobile'];
            $con->update();
        }

        $user = $profile->user;

        if($user->email != $request->input('email')) {

            //email validation
            $email = $request->validate([
                    'email' => 'required|string|email|max:255|unique:users'
                ]
            );

            //update email
            $user->email = $email['email'];

            $user->update();
        }
    }

    public function updateEmergency(Request $request, EmpBasic $profile) {

        $emer = $request->validate([
            'first_name'=>'nullable',
            'last_name'=>'nullable',
            'middle_name'=>'nullable',
            'contact_num'=>'nullable',
            'relationship'=>'nullable',
        ]);

        foreach ($profile->emergency as $emergency) {
            $emergency->first_name = $emer['first_name'];
            $emergency->last_name = $emer['last_name'];
            $emergency->middle_name = $emer['middle_name'];
            $emergency->contact_num = $emer['contact_num'];
            $emergency->relationship = $emer['relationship'];
            $emergency->update();
        }


    }

    public function updateMedical(Request $request, EmpBasic $profile) {

        $medical = $request->validate([
            'master_blood_key' => 'nullable',
            'height' => 'nullable',
            'weight' => 'nullable',
        ]);

        foreach ($profile->medical as $med) {

            $med->master_blood_key = $medical ['master_blood_key'];
            $med->height = $medical['height'];
            $med->weight = $medical['weight'];
            $med->update();
        }

    }

    public function updateExperience(Request $request, EmpBasic $profile) {

        $experience = $request->validate([
            'exp_id' => 'required',
            'exp_position' => 'nullable',
            'exp_company_name' => 'nullable',
            'exp_company_address' => 'nullable',
            'exp_date_from' => 'nullable',
            'exp_date_to' => 'nullable',
            'exp_industry' => 'nullable',
            'exp_salary' => 'nullable',
            'responsibilities' => 'nullable',
        ]);


        for($i=0; $i < count($experience['exp_id']); ++$i ) {
            EmpExperience::updateOrCreate([
                'id'=>$experience['exp_id'][$i],
                'emp_basic_id' => $profile->id,
            ],[
                'master_job_title_key' => $experience['exp_position'][$i],
                'company_name' => $experience['exp_company_name'][$i],
                'company_address' =>$experience['exp_company_address'][$i],
                'date_from' => $experience['exp_date_from'][$i],
                'date_to' => $experience['exp_date_to'][$i],
                'industry' => $experience['exp_industry'][$i],
                'salary' => $experience['exp_salary'][$i],
                'responsibilities' => $experience['responsibilities'][$i],
            ]);
        }

        $exp = $profile->experience;

        return response()->json(['data' =>$exp],200);
    }

    public function deleteExperience(EmpExperience $id) {
        $id->delete();
    }

    public function updateReference(Request $request, EmpBasic $profile) {
        $ref = $request->validate([
            'ref_id'                 => 'required',
            'ref_job_title'          => 'nullable',
            'ref_first_name'         => 'nullable',
            'ref_last_name'          => 'nullable',
            'ref_middle_name'        => 'nullable',
            'ref_company_name'       => 'nullable',
            'ref_company_address'    => 'nullable',
            'ref_contact_num'        => 'nullable',
        ]);

        for($i=0; $i < count($ref['ref_job_title']); ++$i ) {
            EmpReference::updateOrCreate([
                'id'=>$ref['ref_id'][$i],
                'emp_basic_id' => $profile->id,
            ],[
                'job_title'=> $ref['ref_job_title'][$i],
                'first_name'=> $ref['ref_first_name'][$i],
                'last_name'=> $ref['ref_last_name'][$i],
                'middle_name'=> $ref['ref_middle_name'][$i],
                'company_name'=> $ref['ref_company_name'][$i],
                'company_address'=> $ref['ref_company_address'][$i],
                'contact_num'=> $ref['ref_contact_num'][$i],
            ]);
        }

        $ref = $profile->reference;

        return response()->json(['data' =>$ref],200);
    }

    public function updateObjective(Request $request, EmpBasic $profile) {
        $skill = $request->validate([
            'user_obj'=>'nullable'
        ]);
        foreach ($profile->skill as $skills) {
            $skills->objective = $skill['user_obj'];
            $skills->update();
        }
    }

    public function deleteReference(EmpReference $id) {
        $id->delete();
    }

    public function avatar()
    {
        request()->validate([
            'avatar' => 'required|image'
        ]);

        auth()->user()->update([
            'avatar_path' => request()->file('avatar')->store('avatars', 'public')
        ]);

        return response([], 204);
    }



}
