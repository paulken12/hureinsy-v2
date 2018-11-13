@extends('layouts.dashboard')

@section('content')

    <div class="full-container" xmlns:v-on="http://www.w3.org/1999/xhtml">
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
                                                <span>Registration No.</span>
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
                                                <span>Bio Stats</span>
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
                            @include('personnel.profile.include.info')

                            <objective-form
                                    :profile="{{$profile}}"
                                    :objective="{{$profile->skill}}"
                                    :owner="{{$isOwner}}">
                            </objective-form>
                        </div>
                    </div>

                    @can('view', $profile->user)

                        @permission('read-contract')
                        <div class="tab-pane fade profile-info" id="contract" role="tabpanel"
                             aria-labelledby="contract-tab">
                            <div class="profile-content-wrapper">
                                <!-- Header -->
                            @include('personnel.profile.include.info')

                            <!-- Content -->
                                <div class="bdT pX-40 pY-30">
                                    @foreach ($profile->empContract as $contract)
                                        @if($contract->jobDescription !== null)
                                            <h5>Contract</h5>
                                            <div class="row">
                                                <div class="col-sm">
                                                    <small>Job Title |</small>
                                                    <span>{{$contract->jobDescription->job_title}}</span><br>
                                                    <small>Job Description |</small>
                                                    <span>{{$contract->jobDescription->job_description}}</span><br>
                                                    <small>Department |</small>
                                                    <span>{{$contract->jobDescription->jobDepartment->department}}</span><br>
                                                    <small>Effective |</small>
                                                    <span>{{$contract->job_description_effective === '0000-00-00' ? 'n/a' : $contract->job_description_effective }}</span>
                                                    <br>
                                                </div>
                                                <div class="col-sm-5">
                                                    <small>Contract Start |</small>
                                                    <span>{{$contract->contract_start === '0000-00-00' ? 'n/a' : $contract->contract_start }}</span><br>
                                                    <small>Contract End |</small>
                                                    <span>{{$contract->contract_end === '0000-00-00' ? 'n/a' : $contract->contract_end }}</span><br>
                                                    <small>Employment Status |</small>
                                                    <span> {{$contract->status->employee_status}}</span><br>
                                                    <small>Resigned Date |</small>
                                                    <span>{{$contract->resigned_date === '0000-00-00' ? 'n/a' : $contract->resigned_date }}</span><br>
                                                </div>
                                            </div>

                                            <hr>

                                            <small>Project Assignment |</small>
                                            <span>{{$contract->project()->project_title}}</span><br>
                                            <small>Project Description |</small>
                                            <span>{{$contract->project()->project_desc}}</span><br>
                                            <small>Duration |</small> <span>{{$contract->project()->project_start === '0000-00-00' ? 'n/a' : $contract->project()->project_start->format('M j, Y')}}
                                                to {{$contract->project()->project_end === '0000-00-00' ? 'n/a' : $contract->project()->project_end->format('M j, Y')}}</span>
                                            <br>
                                            <small>Company/Client |</small>
                                            <span>{{$contract->project()->company->name}}</span><br>
                                            <small>Location |</small>
                                            <span>{{$contract->project()->company->address}}</span><br>
                                        @else
                                            <div class="container-fluid text-center">
                                                <span>Contract ended</span>
                                            </div>
                                        @endif

                                    @endforeach

                                </div>
                            </div>
                        </div>
                        @endpermission

                        <div class="tab-pane fade profile-info" id="address" role="tabpanel"
                             aria-labelledby="address-tab">
                            <div class="profile-info-body">

                                <address-form
                                        @emit-address="addressEdit"
                                        :address="{{$profile->address}}"
                                        :profile="{{$profile}}"
                                ></address-form>
                            </div>
                        </div>

                        <div class="tab-pane fade profile-info" id="contact" role="tabpanel"
                             aria-labelledby="contact-tab">
                            <div class="profile-info-body">

                                <contact-form
                                        :profile="{{$profile}}"
                                        :info="{{$profile->info}}"
                                        :employee="{{$profile->user}}"
                                        :owner="{{$isOwner}}">
                                </contact-form>

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
                                            <span><a href="#"><i class="mR-10 ti-pencil-alt"
                                                                 title="Edit"></i></a></span>
                                        </div>
                                    @endcan
                                </div>
                                <hr>
                                @forelse($profile->benefit as $benefit)
                                    SSS No. : <span class="c-grey-900">{{$benefit->sss_num? :'n/a'}}</span> <br>
                                    PAGIBIG No. : <span class="c-grey-900">{{$benefit->pagibig_num? :'n/a'}}</span><br>
                                    PHILHEALTH No. : <span
                                            class="c-grey-900">{{$benefit->philhealth_num? :'n/a'}}</span> <br>
                                    TIN No. : <span class="c-grey-900">{{$benefit->tin_num? :'n/a'}}</span><br>
                                    PAYROLL No. : <span class="c-grey-900">{{$benefit->payroll_account? :'n/a'}}</span>
                                    <br>
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
                                            <span><a href="#"><i class="mR-10 ti-pencil-alt"
                                                                 title="Edit"></i></a></span>
                                        </div>
                                    @endcan
                                </div>
                                <hr>
                                @forelse ($profile->family as $family)
                                    <br>
                                    <h5>{{$family->family}}</h5>
                                    <br>
                                    Name: {{$family->last_name}},&nbsp;{{$family->first_name}} <br>
                                    Birth
                                    date: {{$family->date_of_birth === '0000-00-00' ?  '-' : $family->date_of_birth }}
                                    <br>
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

                                <education-form
                                        :profile="{{$profile}}"
                                        :educations="{{$profile->education}}"
                                        :edu_type="{{$profile->education->pluck('background')}}"
                                        :education_type="{{$education_type}}"
                                        :owner="{{$isOwner}}">
                                </education-form>

                            </div>
                        </div>

                        <div class="tab-pane fade profile-info" id="experience" role="tabpanel"
                             aria-labelledby="experience-tab">
                            <div class="profile-info-body">

                                <experience-form
                                        :profile="{{$profile}}"
                                        :experience="{{$profile->experience}}"
                                        :owner="{{$isOwner}}">
                                </experience-form>

                            </div>
                        </div>

                        <div class="tab-pane fade profile-info" id="reference" role="tabpanel"
                             aria-labelledby="reference-tab">
                            <div class="profile-info-body">

                                <reference-form
                                        :profile="{{$profile}}"
                                        :reference="{{$profile->reference}}"
                                        :owner="{{$isOwner}}">
                                </reference-form>

                                {{--<div class="peers ai-c jc-sb">--}}
                                    {{--<div class="peers peer-greed">--}}
                                        {{--<div class="peer">--}}
                                            {{--<h4>Character Reference</h4>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--@can('view', $profile->user)--}}
                                        {{--<div class="peer">--}}
                                            {{--<span><a href="#"><i class="mR-10 ti-pencil-alt"--}}
                                             {{--title="Edit"></i></a></span>--}}
                                        {{--</div>--}}
                                    {{--@endcan--}}
                                {{--</div>--}}

                                {{--<hr>--}}
                                {{--@forelse ($profile->reference as $reference)--}}
                                    {{--Job title: {{$reference->job_title}}<br>--}}
                                    {{--Name: {{$reference->first_name}}&nbsp;{{$reference->middle_name}}--}}
                                    {{--&nbsp;{{$reference->last_name}}<br>--}}
                                    {{--Company name: {{$reference->company_name? : 'Not specified'}}<br>--}}
                                    {{--Company address: {{$reference->company_address? : 'Not specified'}}<br>--}}
                                    {{--Contact: {{$reference->contact_num? : 'Not specified'}}&nbsp;<br><br>--}}
                                {{--@empty--}}
                                    {{--<p class="text-center">No character reference</p>--}}
                                {{--@endforelse--}}
                            </div>
                        </div>

                        <div class="tab-pane fade profile-info" id="emergency" role="tabpanel"
                             aria-labelledby="emergency-tab">
                            <div class="profile-info-body">
                                <emergency-form
                                        :profile="{{$profile}}"
                                        :emergency="{{$profile->emergency}}"
                                        :owner="{{$isOwner}}">
                                </emergency-form>
                            </div>
                        </div>

                        <div class="tab-pane fade profile-info" id="medical" role="tabpanel"
                             aria-labelledby="medical-tab">
                            <div class="profile-info-body">
                                <medical-form
                                        :profile="{{$profile}}"
                                        :medical="{{$profile->medical}}"
                                        :blood="{{$blood}}"
                                        :owner="{{$isOwner}}">
                                </medical-form>
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


