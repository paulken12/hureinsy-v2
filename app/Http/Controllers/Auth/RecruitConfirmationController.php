<?php

namespace App\Http\Controllers\Auth;

use App\Helper\Slug;
use App\Master\MasterBloodType;
use App\Master\MasterCitizenship;
use App\Master\MasterCivilStatus;
use App\Master\MasterEducationType;
use App\Master\MasterExtension;
use App\Master\MasterFamilyType;
use App\Master\MasterGender;
use App\Personnel\Info\EmpAddress;
use App\Personnel\Info\EmpContact;
use App\Personnel\Info\EmpEducation;
use App\Personnel\Info\EmpEmergencyContact;
use App\Personnel\Info\EmpExperience;
use App\Personnel\Info\EmpFamily;
use App\Personnel\Info\EmpReference;
use App\Personnel\Info\EmpTraining;
use App\User;
use function Complex\add;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RecruitConfirmationController extends Controller
{
    /**
     * Confirm a user's email address.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        //get the user has the token
        $user = User::where('verification_token', request('token'))->first();

        if (!$user) {
            //if the token is invalid then redirect to login
            return redirect(route('login'));
        }

        //if the token is exist login the user
        Auth::login($user);

        $profile = $user->basicInfo->first();

        //get all data in the master table
        $civilStatus = MasterCivilStatus::all();

        //get all data in the master citizenship table
        $citizenship = MasterCitizenship::all();

        //get all data in the master gender table
        $gender = MasterGender::all();

        //get all data in the master blood type table
        $blood = MasterBloodType::all();

        //get all data in the master blood type table
        $educations = MasterEducationType::all();

        $extension = MasterExtension::all();

        $family = MasterFamilyType::all();

        return view('personnel.form.create', compact(
            'user', 'civilStatus',
            'citizenship', 'gender',
            'blood', 'profile','extension',
            'educations','family'));
    }

    public function store(Request $request)
    {
        //get the user id
        $slug = new Slug();
        $user = User::find(auth()->user()->id);
        $user_id = $user->basicInfo->pluck('id')->first();

        $info = $request->validate([

            'basic_first_name'       => 'required',
            'basic_middle_name'      => 'required',
            'basic_last_name'        => 'required',
            'basic_extension_key'    => 'nullable',
            'basic_civil_status_key' => 'required',
            'basic_gender_key'       => 'required',
            'basic_date_of_birth'    => 'nullable',
            'basic_birth_place'      => 'nullable',
            'basic_citizenship_key'  => 'required',

            'med_blood_key'          => 'nullable',
            'med_height'             => 'nullable',
            'med_weight'             => 'nullable',

            'special_skill'          => 'nullable',
            'hobbies'                => 'nullable',
            'membership'             => 'nullable',

            'gov_sss_num'            => 'nullable',
            'gov_pagibig_num'        => 'nullable',
            'gov_philhealth_num'     => 'nullable',
            'gov_tin_num'            => 'nullable',
            'gov_payroll_account'    => 'nullable',

            'has_crime'              => 'nullable',
            'comment'                => 'nullable',
        ]);

        $eme = $request->validate([
            'eme_first_name'         => 'nullable',
            'eme_last_name'          => 'nullable',
            'eme_middle_name'        => 'nullable',
            'eme_contact_num'        => 'nullable',
            'eme_relationship'       => 'nullable',
        ]);

        $contact = $request->validate([
            'telephone_num'          => 'nullable',
            'mobile_num'             => 'nullable',
            'other_mobile'           => 'nullable',

        ]);

        $address = $request->validate([
            'master_address_key'     => 'required',
            'add_unit_num'           => 'nullable',
            'add_block'              => 'nullable',
            'add_street_name'        => 'nullable',
            'add_subdivision'        => 'nullable',
            'add_barangay'           => 'nullable',
            'add_city'               => 'nullable',
            'add_province'           => 'nullable',
            'add_zip_code'           => 'nullable',
        ]);



        $family = $request->validate([
            'master_family_key'      => 'required',
            'fam_last_name'          => 'nullable',
            'fam_first_name'         => 'nullable',
            'fam_date_of_birth'      => 'nullable',
            'fam_gender_key'         => 'nullable',
            'fam_employer'           => 'nullable',
            'fam_occupation'         => 'nullable',
        ]);

        $education = $request->validate([
            'master_education_key'      => 'required',
            'edu_course'             => 'nullable',
            'edu_name_of_school'     => 'nullable',
            'edu_year_graduated'     => 'nullable',
            'edu_award'              => 'nullable',
        ]);

        $experience = $request->validate([
            'exp_position'           => 'nullable',
            'exp_company_name'       => 'nullable',
            'exp_company_address'    => 'nullable',
            'exp_date_from'          => 'nullable',
            'exp_date_to'            => 'nullable',
            'exp_industry'           => 'nullable',
            'exp_salary'             => 'nullable',
            'responsibilities'       => 'nullable',
        ]);

        $reference = $request->validate([
            'ref_job_title'          => 'nullable',
            'ref_first_name'         => 'nullable',
            'ref_last_name'          => 'nullable',
            'ref_middle_name'        => 'nullable',
            'ref_company_name'       => 'nullable',
            'ref_company_address'    => 'nullable',
            'ref_contact_num'        => 'nullable',
        ]);

        $training = $request->validate([
            'train_title'            => 'nullable',
            'train_date_from'        => 'nullable',
            'train_date_to'          => 'nullable',
            'train_place_seminar'    => 'nullable',
        ]);

        $user_slug = $slug->createSlug($info['basic_first_name'].' '.$info['basic_middle_name'].' '.$info['basic_last_name']);

        foreach ($user->basicInfo as $basicInfo) {

            //update basic info
            $basicInfo->first_name = $info['basic_first_name'];

            $basicInfo->middle_name = $info['basic_middle_name'];

            $basicInfo->last_name = $info['basic_last_name'];

            $basicInfo->master_extension_key = $info['basic_extension_key'];

            $basicInfo->master_civil_status_key = $info['basic_civil_status_key'];

            $basicInfo->master_gender_key = $info['basic_gender_key'];

            $basicInfo->date_of_birth = $info['basic_date_of_birth'];

            $basicInfo->birth_place = $info['basic_birth_place'];

            $basicInfo->master_citizenship_key = $info['basic_citizenship_key'];

            $basicInfo->slug = $user_slug;

            $basicInfo->update();
        }

        if(!empty($contact['telephone_num']) || !empty($contact['mobile_num']) || !empty($contact['other_mobile']))
        {
            EmpContact::create([
                'emp_basic_id'=>$user_id,
                'telephone_num'=> $contact['telephone_num'],
                'mobile_num'=> $contact['mobile_num'],
                'other_mobile'=> $contact['other_mobile'],
            ]);
        }

        if(count($eme) !== 0){
            EmpEmergencyContact::create([
                'emp_basic_id'=>$user_id,
                'first_name'=> $eme['eme_first_name'],
                'last_name'=> $eme['eme_last_name'],
                'middle_name'=> $eme['eme_middle_name'],
                'contact_num'=> $eme['eme_contact_num'],
                'relationship'=> $eme['eme_relationship'],
            ]);
        }

        for($i=0; $i < count($address['master_address_key']); ++$i ) {
            EmpAddress::create([
                'emp_basic_id'=>$user_id,
                'master_address_key'=> $address['master_address_key'][$i],
                'unit_num'=> $address['add_unit_num'][$i],
                'block'=> $address['add_block'][$i],
                'street_name'=> $address['add_street_name'][$i],
                'subdivision'=> $address['add_subdivision'][$i],
                'barangay'=> $address['add_barangay'][$i],
                'city'=> $address['add_city'][$i],
                'province'=> $address['add_province'][$i],
                'zip_code'=> $address['add_zip_code'][$i],
            ]);
        }


        for($i=0; $i < count($family['master_family_key']); ++$i ) {
            EmpFamily::create([
                'emp_basic_id'=>$user_id,
                'master_family_key'=> $family['master_family_key'][$i],
                'last_name'=> $family['fam_last_name'][$i],
                'first_name'=> $family['fam_first_name'][$i],
                'date_of_birth'=> $family['fam_date_of_birth'][$i],
                'occupation'=> $family['fam_gender_key'][$i],
                'employer'=> $family['fam_employer'][$i],
                'master_gender_key'=> $family['fam_occupation'][$i],
            ]);
        }

        for($i=0; $i < count($education['master_education_key']); ++$i ) {
            EmpEducation::create([
                'emp_basic_id'=>$user_id,
                'master_education_key'=> $education['master_education_key'][$i],
                'course'=> $education['edu_course'][$i],
                'name_of_school'=> $education['edu_name_of_school'][$i],
                'year_graduated'=> $education['edu_year_graduated'][$i],
                'award'=> $education['edu_award'][$i],
            ]);
        }

        for($i=0; $i < count($experience['exp_position']); ++$i ) {
            EmpExperience::create([
            'emp_basic_id'=>$user_id,
            'master_job_title_key'=> $experience['exp_position'][$i],
            'company_name'=> $experience['exp_company_name'][$i],
            'company_address'=> $experience['exp_company_address'][$i],
            'date_from'=> $experience['exp_date_from'][$i],
            'date_to'=> $experience['exp_date_to'][$i],
            'industry'=> $experience['exp_industry'][$i],
            'salary'=> $experience['exp_salary'][$i],
            'responsibilities'=> $experience['responsibilities'][$i],
        ]);
    }

        for($i=0; $i < count($reference['ref_job_title']); ++$i ) {
            EmpReference::create([
                'emp_basic_id'=>$user_id,
                'job_title'=> $reference['ref_job_title'][$i],
                'first_name'=> $reference['ref_first_name'][$i],
                'last_name'=> $reference['ref_last_name'][$i],
                'middle_name'=> $reference['ref_middle_name'][$i],
                'company_name'=> $reference['ref_company_name'][$i],
                'company_address'=> $reference['ref_company_address'][$i],
                'contact_num'=> $reference['ref_contact_num'][$i],
            ]);
        }

        for($i=0; $i < count($training['train_title']); ++$i ) {
            EmpTraining::create([
                'emp_basic_id'=>$user_id,
                'title'=> $training['train_title'][$i],
                'date_from'=> $training['train_date_from'][$i],
                'date_to'=> $training['train_date_to'][$i],
                'place_seminar'=> $training['train_place_seminar'][$i],
            ]);
        }
        //check if the user email is equal to the input field
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

        //government benefit to be encrypt and decrypt

        auth()->user()->verified();

        return response()->json(['success' =>'Your data is successfully saved', 'redirect' => route('dashboard')],200);


    }
}
