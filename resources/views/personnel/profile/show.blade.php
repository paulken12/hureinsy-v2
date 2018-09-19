@extends('layouts.dashboard')

@section('content')

    <div class="full-container">
        <div class="profile-app">
            <div class="profile-side-nav remain-height ov-h">
                <div class="h-100 layers">
                    <div class="p-20 bgc-grey-100 layer w-100 text-center">
                        <span>All About Me</span>
                    </div>
                    <div class="pos-r scrollable bdT layer w-100 fxg-1">
                        <ul class="p-20 nav flex-column">
                            <li class="nav-item">
                                <a href="#basic" class="nav-link c-grey-800 cH-blue-500 active" id="basic-tab"
                                   data-toggle="tab" role="tab" aria-controls="basic" aria-selected="true">
                                    <div class="peers ai-c jc-sb">
                                        <div class="peer peer-greed">
                                            <i class="mR-10 ti-user"></i>
                                            <span>Basic Information</span>
                                        </div>
                                    </div>
                                </a>
                            </li>

                            @can('view', $profile->user)

                                @permission('read-contract')
                                    <li class="nav-item">
                                        <a href="#contract" class="nav-link c-grey-800 cH-blue-500" id="contract-tab"
                                           data-toggle="tab" role="tab" aria-controls="contract" aria-selected="true">
                                            <div class="peers ai-c jc-sb">
                                                <div class="peer peer-greed">
                                                    <i class="mR-10 ti-marker-alt"></i>
                                                    <span>Contract</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endpermission

                                <li class="nav-item">
                                    <a href="#address" class="nav-link c-grey-800 cH-blue-500" id="address-tab"
                                       data-toggle="tab" role="tab" aria-controls="address" aria-selected="true">
                                        <div class="peers ai-c jc-sb">
                                            <div class="peer peer-greed">
                                                <i class="mR-10 ti-direction-alt"></i>
                                                <span>Address </span>
                                            </div>
                                        </div>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="#contact" class="nav-link c-grey-800 cH-blue-500" id="contact-tab"
                                       data-toggle="tab" role="tab" aria-controls="contact" aria-selected="true">
                                        <div class="peers ai-c jc-sb">
                                            <div class="peer peer-greed">
                                                <i class="mR-10 ti-bookmark"></i>
                                                <span>Contact</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="#benefit" class="nav-link c-grey-800 cH-blue-500" id="benefit-tab"
                                       data-toggle="tab" role="tab" aria-controls="benefit" aria-selected="true">
                                        <div class="peers ai-c jc-sb">
                                            <div class="peer peer-greed">
                                                <i class="mR-10 ti-heart"></i>
                                                <span>Benefit</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="#family" class="nav-link c-grey-800 cH-blue-500" id="family-tab"
                                       data-toggle="tab" role="tab" aria-controls="family" aria-selected="true">
                                        <div class="peers ai-c jc-sb">
                                            <div class="peer peer-greed">
                                                <i class="mR-10 ti-wand"></i>
                                                <span>Family</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="#education" class="nav-link c-grey-800 cH-blue-500" id="education-tab"
                                       data-toggle="tab" role="tab" aria-controls="education" aria-selected="true">
                                        <div class="peers ai-c jc-sb">
                                            <div class="peer peer-greed">
                                                <i class="mR-10 ti-book"></i>
                                                <span>Education</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="#experience" class="nav-link c-grey-800 cH-blue-500" id="experience-tab"
                                       data-toggle="tab" role="tab" aria-controls="experience" aria-selected="true">
                                        <div class="peers ai-c jc-sb">
                                            <div class="peer peer-greed">
                                                <i class="mR-10 ti-ruler-pencil"></i>
                                                <span>Experience</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="#reference" class="nav-link c-grey-800 cH-blue-500" id="reference-tab"
                                       data-toggle="tab" role="tab" aria-controls="reference" aria-selected="true">
                                        <div class="peers ai-c jc-sb">
                                            <div class="peer peer-greed">
                                                <i class="mR-10 ti-comments-smiley"></i>
                                                <span>Reference</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="#emergency" class="nav-link c-grey-800 cH-blue-500" id="emergency-tab"
                                       data-toggle="tab" role="tab" aria-controls="emergency" aria-selected="true">
                                        <div class="peers ai-c jc-sb">
                                            <div class="peer peer-greed">
                                                <i class="mR-10 ti-alert"></i>
                                                <span>Emergency</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="#medical" class="nav-link c-grey-800 cH-blue-500" id="medical-tab"
                                       data-toggle="tab" role="tab" aria-controls="medical" aria-selected="true">
                                        <div class="peers ai-c jc-sb">
                                            <div class="peer peer-greed">
                                                <i class="mR-10 ti-heart-broken"></i>
                                                <span>Medical</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>

                            @endcan

                            <li class="nav-item">
                                <a href="#training" class="nav-link c-grey-800 cH-blue-500" id="training-tab"
                                   data-toggle="tab" role="tab" aria-controls="training" aria-selected="true">
                                    <div class="peers ai-c jc-sb">
                                        <div class="peer peer-greed">
                                            <i class="mR-10 ti-hummer"></i>
                                            <span>Trainings</span>
                                        </div>
                                    </div>
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="profile-wrapper row remain-height pos-r scrollable bgc-white">
                <div class="tab-content profile-content w-100">

                    <div class="tab-pane fade show active profile-info" id="basic" role="tabpanel"
                         aria-labelledby="basic-tab">
                        <div class="profile-content-wrapper">
                            <!-- Header -->
                            <div class="peers ai-c jc-sb pX-40 pY-30">
                                <div class="peers peer-greed">
                                    <div class="peer mR-20">
                                        <img class="bdrs-50p w-6r h-6r" alt="User Avatar" src="{{$profile->user->avatar_path}}">
                                    </div>
                                    <div class="peer">
                                        <h5 class="c-grey-900 mB-5">
                                            {{$profile->first_name}} {{$profile->middle_name}} {{$profile->last_name}}
                                            {{empty($profile->extension->name_extension) ? '':$profile->extension->name_extension}}
                                        </h5>
                                        <div class="peer peer-greed">
                                            <i class="mR-10 ti-crown" title="Position"></i>
                                            <span title="Position">Associate Software Engineer</span>
                                        </div>
                                        <div class="peer peer-greed">
                                            <i class="mR-10 ti-email" title="Email"></i>
                                            <span>{{$profile->user->email}}</span>
                                        </div>
                                        <div class="peer peer-greed">
                                            <i class="mR-10 ti-write" title="Report to"></i>
                                            <span><a href="{{route('profiles',$profile->reportToSlug())}}" title="Reporting to {{$profile->reportingTo()}}">{{$profile->reportingTo()}}</a></span>
                                        </div>


                                    </div>
                                </div>
                                <div class="peer">
                                    <i class="mR-10 ti-id-badge" title="Company ID"></i>
                                    <span>{{$profile->company_id}}</span>
                                    <br>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="bdT pX-40 pY-30">
                                <h5>Objective</h5>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                </p>

                                <hr>

                                <div class="row m-0 p-0">
                                    <div class="col p-0">
                                        Gender: <span class="c-grey-900">{{$profile->gender}}</span> <br>
                                        Civil Status: <span class="c-grey-900">{{$profile->civilStatus}}</span> <br>
                                        Citizenship: <span class="c-grey-900">{{$profile->citizenship}}</span> <br>
                                    </div>
                                    <div class="col-7 p-0">
                                        Birth date: <span class="c-grey-900">{{$profile->date_of_birth->format('jS \o\f F ,Y')}}</span> <br>
                                        Birth place: <span class="c-grey-900">{{$profile->birth_place? : '-'}}</span> <br>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>

                    @can('view', $profile->user)

                        @permission('read-contract')
                            <div class="tab-pane fade profile-info" id="contract" role="tabpanel"
                                     aria-labelledby="contract-tab">
                                    <div class="profile-info-body">
                                        Contract
                                    </div>
                            </div>
                        @endpermission

                        <div class="tab-pane fade profile-info" id="address" role="tabpanel"
                                    aria-labelledby="address-tab">
                            <div class="profile-info-body">
                                <div class="peers ai-c jc-sb">
                                    <div class="peers peer-greed">
                                        <div class="peer">
                                            <h4>Address</h4>
                                        </div>
                                    </div>
                                    {{--@canAndOwns('update-address')--}}
                                    <div class="peer">
                                        <span><a href="#"><i class="mR-10 ti-pencil-alt" title="Edit"></i></a></span>
                                    </div>
                                    {{--@endOwns--}}
                                </div>

                                <hr>
                                @forelse ($profile->address as $address)
                                    <h5>{{$address->address}} </h5>
                                    <i class="ti-location-pin"></i> {{$address->unit_num}}
                                    {{$address->block}}
                                    {{$address->street_name}}
                                    {{$address->subdivision}}
                                    {{$address->barangay}}
                                    {{$address->city}}
                                    {{$address->province}}
                                    {{$address->zip_code}}
                                    <br>
                                    <br>
                                @empty
                                    <p class="text-center">No address provided</p>
                                @endforelse
                            </div>
                        </div>

                        <div class="tab-pane fade profile-info" id="contact" role="tabpanel"
                                   aria-labelledby="contact-tab">
                            <div class="profile-info-body">
                                <div class="peers ai-c jc-sb">
                                    <div class="peers peer-greed">
                                        <div class="peer">
                                            <h4>Contact</h4>
                                        </div>
                                    </div>
                                    @can('view', $profile->user)
                                    <div class="peer">
                                        <span><a href="#"><i class="mR-10 ti-pencil-alt" title="Edit"></i></a></span>
                                    </div>
                                    @endcan
                                </div>
                                <hr>
                                @forelse ($profile->contact as $contact)
                                    Telephone No. : <span class="c-grey-900">{{$contact->telephone_num ? :'n/a'}}</span> <br>
                                    Mobile No. : <span class="c-grey-900">{{$contact->mobile_num ? :'n/a'}}</span><br>
                                    Other No. : <span class="c-grey-900">{{$contact->other_mobile ? :'n/a'}}</span><br>
                                    Email. : <span class="c-grey-900">{{$profile->user->email}}</span><br>
                                @empty
                                    <p class="text-center">No contact available</p>
                                @endforelse
                            </div>
                        </div>

                        <div class="tab-pane fade profile-info" id="benefit" role="tabpanel"
                             aria-labelledby="benefit-tab">
                            <div class="profile-info-body">
                                <div class="peers ai-c jc-sb">
                                    <div class="peers peer-greed">
                                        <div class="peer">
                                            <h4>Benefits</h4>
                                        </div>
                                    </div>
                                    @can('view', $profile->user)
                                    <div class="peer">
                                        <span><a href="#"><i class="mR-10 ti-pencil-alt" title="Edit"></i></a></span>
                                    </div>
                                    @endcan
                                </div>
                                <hr>
                                @forelse($profile->benefit as $benefit)
                                    SSS No. : <span class="c-grey-900">{{$benefit->sss_num? :'n/a'}}</span> <br>
                                    PAGIBIG No. : <span class="c-grey-900">{{$benefit->pagibig_num? :'n/a'}}</span><br>
                                    PHILHEALTH No. : <span class="c-grey-900">{{$benefit->philhealth_num? :'n/a'}}</span> <br>
                                    TIN No. : <span class="c-grey-900">{{$benefit->tin_num? :'n/a'}}</span><br>
                                    PAYROLL No. : <span class="c-grey-900">{{$benefit->payroll_account? :'n/a'}}</span><br>
                                @empty
                                    <p class="text-center">This human doesn't have it</p>
                                @endforelse
                            </div>
                        </div>

                        <div class="tab-pane fade profile-info" id="family" role="tabpanel"
                             aria-labelledby="family-tab">
                            <div class="profile-info-body">
                                <div class="peers ai-c jc-sb">
                                    <div class="peers peer-greed">
                                        <div class="peer">
                                            <h4>Family Background</h4>
                                        </div>
                                    </div>
                                    @can('view', $profile->user)
                                    <div class="peer">
                                        <span><a href="#"><i class="mR-10 ti-pencil-alt" title="Edit"></i></a></span>
                                    </div>
                                    @endcan
                                </div>
                                <hr>
                                @forelse ($profile->family as $family)
                                    <br>
                                    <h5>{{$family->family}}</h5>
                                    <br>
                                    Name: {{$family->last_name}},&nbsp;{{$family->first_name}} <br>
                                    Birth date: {{$family->date_of_birth === '0000-00-00' ?  '-' : $family->date_of_birth }}<br>
                                    Occupation: {{$family->occupation? : 'Not specified'}}<br>
                                    Employer: {{$family->employer? : 'Not specified' }}<br>
                                    Gender: {{$family->gender}}<br>
                                @empty
                                    <p class="text-center">This alien doesn't have family</p>
                                @endforelse
                            </div>
                        </div>

                        <div class="tab-pane fade profile-info" id="education" role="tabpanel"
                             aria-labelledby="education-tab">
                            <div class="profile-info-body">
                                <div class="peers ai-c jc-sb">
                                    <div class="peers peer-greed">
                                        <div class="peer">
                                            <h4>Educational Background</h4>
                                        </div>
                                    </div>
                                    @can('view', $profile->user)
                                    <div class="peer">
                                        <span><a href="#"><i class="mR-10 ti-pencil-alt" title="Edit"></i></a></span>
                                    </div>
                                    @endcan
                                </div>
                                <hr>
                                @forelse ($profile->education as $education)
                                    <h5>Level: {{$education->background}}</h5>
                                    Course: {{$education->course}}<br>
                                    School name: {{$education->name_of_school? : 'Not specified'}} <br>
                                    Year graduated: {{$education->year_graduated? : 'Not specified'}}<br>
                                    Award: {{$education->award? : 'No Awards'}}<br><br>
                                @empty
                                    <p class="text-center">No educational background provided</p>
                                @endforelse
                            </div>
                        </div>

                        <div class="tab-pane fade profile-info" id="experience" role="tabpanel"
                             aria-labelledby="experience-tab">
                            <div class="profile-info-body">
                                <div class="peers ai-c jc-sb">
                                    <div class="peers peer-greed">
                                        <div class="peer">
                                            <h4>Work Experience</h4>
                                        </div>
                                    </div>
                                    @can('view', $profile->user)
                                    <div class="peer">
                                        <span><a href="#"><i class="mR-10 ti-pencil-alt" title="Edit"></i></a></span>
                                    </div>
                                    @endcan
                                </div>
                                <hr>
                                @forelse ($profile->experience as $experience)
                                    <h5>{{$experience->emp_work_experience}}</h5>
                                    Company name: {{$experience->company_name? : 'Not specified'}}&nbsp;<br>
                                    Company address: {{$experience->company_address? : 'Not specified' }}&nbsp;<br>
                                    Date from: {{$experience->date_from === '0000-00-00' ? '':$experience->date_from}}&nbsp;-
                                    Date to: {{$experience->date_to === '0000-00-00' ? '':$experience->date_to}}&nbsp;<br>
                                    Industry: {{$experience->industry? : 'Not specified'}}&nbsp;<br>
                                    Salary: {{$experience->salary? : 'Not specified'}}&nbsp;<br>
                                    Reason for leaving: <br>{{$experience->reason_for_leaving? : 'Not specified'}}<br><br>
                                @empty
                                    <p class="text-center">No work experience</p>
                                @endforelse
                            </div>
                        </div>

                        <div class="tab-pane fade profile-info" id="reference" role="tabpanel"
                             aria-labelledby="reference-tab">
                            <div class="profile-info-body">
                                <div class="peers ai-c jc-sb">
                                    <div class="peers peer-greed">
                                        <div class="peer">
                                            <h4>Character Reference</h4>
                                        </div>
                                    </div>
                                    @can('view', $profile->user)
                                    <div class="peer">
                                        <span><a href="#"><i class="mR-10 ti-pencil-alt" title="Edit"></i></a></span>
                                    </div>
                                    @endcan
                                </div>

                                <hr>
                                @forelse ($profile->reference as $reference)
                                    Job title: {{$reference->job_title}}<br>
                                    Name: {{$reference->first_name}}&nbsp;{{$reference->middle_name}}&nbsp;{{$reference->last_name}}<br>
                                    Company name: {{$reference->company_name? : 'Not specified'}}<br>
                                    Company address: {{$reference->company_address? : 'Not specified'}}<br>
                                    Contact: {{$reference->contact_num? : 'Not specified'}}&nbsp;<br><br>
                                @empty
                                    <p class="text-center">No character reference</p>
                                @endforelse
                            </div>
                        </div>

                        <div class="tab-pane fade profile-info" id="emergency" role="tabpanel"
                             aria-labelledby="emergency-tab">
                            <div class="profile-info-body">
                                <div class="peers ai-c jc-sb">
                                    <div class="peers peer-greed">
                                        <div class="peer">
                                            <h4>Emergency Contact</h4>
                                        </div>
                                    </div>
                                   @can('view', $profile->user)
                                    <div class="peer">
                                        <span><a href="#"><i class="mR-10 ti-pencil-alt" title="Edit"></i></a></span>
                                    </div>
                                    @endcan
                                </div>

                                <hr>
                                @forelse ($profile->emergency as $emergency)
                                    Name: {{$emergency->first_name}}&nbsp;
                                    {{$emergency->middle_name}}&nbsp;
                                    {{$emergency->last_name}}<br>
                                    Contact no.: {{$emergency->contact_num? : 'Not specified'}}<br>
                                    Relationship: {{$emergency->relationship? : 'Not specified'}}&nbsp;
                                @empty
                                    <p class="text-center">No emergency contact</p>
                                @endforelse
                            </div>
                        </div>

                        <div class="tab-pane fade profile-info" id="medical" role="tabpanel"
                             aria-labelledby="medical-tab">
                            <div class="profile-info-body">
                                <div class="peers ai-c jc-sb">
                                    <div class="peers peer-greed">
                                        <div class="peer">
                                            <h4>Medical Information</h4>
                                        </div>
                                    </div>
                                    @can('view', $profile->user)
                                    <div class="peer">
                                        <span><a href="#"><i class="mR-10 ti-pencil-alt" title="Edit"></i></a></span>
                                    </div>
                                    @endcan
                                </div>

                                <hr>
                                @forelse ($profile->medical as $medical)
                                    Blood type: {{$medical->bloodType ? : 'Not specified'}}<br>
                                    Height(m): {{$medical->height ? : 'Not specified'}}<br>
                                    Weight(kg): {{$medical->weight ? : 'Not specified'}}<br>
                                @empty
                                    <p class="text-center">No medical information</p>
                                @endforelse
                            </div>
                        </div>

                    @endcan

                    <div class="tab-pane fade profile-info" id="training" role="tabpanel"
                         aria-labelledby="training-tab">
                        <div class="profile-info-body">
                            <div class="peers ai-c jc-sb">
                                <div class="peers peer-greed">
                                    <div class="peer">
                                        <h4>Trainings</h4>
                                    </div>
                                </div>
                                @can('view', $profile->user)
                                <div class="peer">
                                    <span><a href="#"><i class="mR-10 ti-pencil-alt" title="Edit"></i></a></span>
                                </div>
                                @endcan
                            </div>

                            <table class="table table-sm w-100 mt-3">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Date from</th>
                                        <th>Date to</th>
                                        <th>Location</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse ($profile->training as $training)
                                    <tr>
                                        <td>{{$training->title}}</td>
                                        <td>{{$training->date_from === '0000-00-00' ? '':$training->date_from}}</td>
                                        <td>{{$training->date_to === '0000-00-00' ? '':$training->date_to}}</td>
                                        <td>{{$training->place_seminar}}</td>
                                    </tr>

                                @empty
                                    <tr>
                                        <td></td>
                                        <td class="text-right">No Training</td>
                                        <td class="text-left">Attended</td>
                                        <td></td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection


