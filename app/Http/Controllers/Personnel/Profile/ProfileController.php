<?php

namespace App\Http\Controllers\Personnel\Profile;

use App\Master\MasterBloodType;
use App\Master\MasterEducationType;
use App\Personnel\Info\EmpAddress;
use App\Personnel\Info\EmpBasic;
use App\Personnel\Info\EmpContract;
use function Complex\add;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{

    public function show(EmpBasic $profile)
    {

        $isOwner = $this->authorize('view', $profile->user) ? 'true' : 'false';
        $blood = MasterBloodType::all();
        $education_type= MasterEducationType::all();

        return view('personnel.profile.show', compact('profile','isOwner','blood','education_type'));
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
}
