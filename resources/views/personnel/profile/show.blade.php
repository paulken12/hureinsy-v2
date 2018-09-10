@extends('layouts.dashboard')

@section('content')

    <div class="full-container">
        <div class="email-app">
            <div class="email-side-nav remain-height ov-h">
                <div class="h-100 layers">
                    <div class="p-20 bgc-grey-100 layer w-100 text-center">
                        <span>All About Me</span>
                    </div>
                    <div class="scrollable pos-r bdT layer w-100 fxg-1">
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
                            <li class="nav-item">
                                <a href="#skills" class="nav-link c-grey-800 cH-blue-500" id="skills-tab"
                                   data-toggle="tab" role="tab" aria-controls="skills" aria-selected="true">
                                    <div class="peers ai-c jc-sb">
                                        <div class="peer peer-greed">
                                            <i class="mR-10 ti-medall"></i>
                                            <span>Skills</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="email-wrapper row remain-height pos-r scrollable bgc-white">
                <div class="tab-content email-content open no-inbox-view">
                    <div class="tab-pane fade show active profile-info" id="basic" role="tabpanel"
                         aria-labelledby="basic-tab">
                        <div class="email-content-wrapper">
                            <!-- Header -->
                            <div class="peers ai-c jc-sb pX-40 pY-30">
                                <div class="peers peer-greed">
                                    <div class="peer mR-20">
                                        <img class="bdrs-50p w-5r h-5r" alt="" src="{{asset('images/avatars/raj_male.png')}}">
                                    </div>
                                    <div class="peer">
                                        <h5 class="c-grey-900 mB-5">Kenneth Paul Bautista Cabrillas</h5>
                                        <span>email@gmail.com</span>
                                    </div>
                                </div>
                                <div class="peer">
                                    <a href="" class="btn btn-danger bdrs-50p p-15 lh-0">
                                        <i class="fa fa-reply"></i>
                                    </a>
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
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                </p>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade profile-info" id="contract" role="tabpanel"
                         aria-labelledby="contract-tab">
                        <div class="profile-info-body">
                            Contract
                        </div>
                    </div>
                    <div class="tab-pane fade profile-info" id="address" role="tabpanel"
                                aria-labelledby="address-tab">
                        <div class="profile-info-body">
                            Address
                        </div>
                    </div>
                    <div class="tab-pane fade profile-info" id="contact" role="tabpanel"
                               aria-labelledby="contact-tab">
                        <div class="profile-info-body">
                            Contact
                        </div>
                    </div>
                    <div class="tab-pane fade profile-info" id="benefit" role="tabpanel"
                         aria-labelledby="benefit-tab">
                        <div class="profile-info-body">
                            Benefit
                        </div>
                    </div>
                    <div class="tab-pane fade profile-info" id="family" role="tabpanel"
                         aria-labelledby="family-tab">
                        <div class="profile-info-body">
                            Family
                        </div>
                    </div>
                    <div class="tab-pane fade profile-info" id="education" role="tabpanel"
                         aria-labelledby="education-tab">
                        <div class="profile-info-body">
                            Education
                        </div>
                    </div>
                    <div class="tab-pane fade profile-info" id="experience" role="tabpanel"
                         aria-labelledby="experience-tab">
                        <div class="profile-info-body">
                            Experience
                        </div>
                    </div>
                    <div class="tab-pane fade profile-info" id="reference" role="tabpanel"
                         aria-labelledby="reference-tab">
                        <div class="profile-info-body">
                            Reference
                        </div>
                    </div>
                    <div class="tab-pane fade profile-info" id="emergency" role="tabpanel"
                         aria-labelledby="emergency-tab">
                        <div class="profile-info-body">
                            Emergency
                        </div>
                    </div>
                    <div class="tab-pane fade profile-info" id="medical" role="tabpanel"
                         aria-labelledby="medical-tab">
                        <div class="profile-info-body">
                            Medical
                        </div>
                    </div>
                    <div class="tab-pane fade profile-info" id="skills" role="tabpanel"
                         aria-labelledby="skills-tab">
                        <div class="profile-info-body">
                            Skills
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


