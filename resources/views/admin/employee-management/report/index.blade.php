@extends('layouts.dashboard')

@section('content')
    <div class="bd bgc-white">
        <form action="{{route('generate.reports')}}" method="POST">

            {{csrf_field()}}

            <div class="layers">
                <div class="layer w-100 p-20">
                    <div class="peers">
                        <div class="peer peer-greed">
                            <h5>Generate Report</h5>
                        </div>
                        <div class="peer">
                            <label class="sr-only" for="employee">Employee</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="ti-user"></i></div>
                                </div>
                                <select name="employee" id="employee" class="form-control" >
                                    <option value="all" readonly="">- All Selected -</option>
                                    @foreach ($employees as $employee)
                                        <option value="{{$employee->id}}">{{$employee->fullName}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="first_name" value="emp_basics.first_name">
                <input type="hidden" name="middle_name" value="emp_basics.middle_name">
                <input type="hidden" name="last_name" value="emp_basics.last_name">

                <div class="row p-0 m- w-100">
                    <div class="col bdT bdR p-0">
                        <div class="p-10 bgc-grey-100 layer w-100 text-center">
                            Personal Information
                        </div>
                        <div class="bdT layer w-100 fxg-1 p-20">
                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                <input type="checkbox" class="custom-control-input" id="birth_day" name="birth_day" value="emp_basics.date_of_birth">
                                <label class="custom-control-label" for="birth_day">Birth Date</label>
                            </div>
                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                <input type="checkbox" class="custom-control-input" id="sss" name="sss" value="emp_benefits.sss_num">
                                <label class="custom-control-label" for="sss">SSS No.</label>
                            </div>
                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                <input type="checkbox" class="custom-control-input" id="philhealth" name="philhealth" value="emp_benefits.philhealth_num">
                                <label class="custom-control-label" for="philhealth">Philhealth No.</label>
                            </div>
                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                <input type="checkbox" class="custom-control-input" id="hdmf" name="hdmf" value="emp_benefits.pagibig_num">
                                <label class="custom-control-label" for="hdmf">HDMF No.</label>
                            </div>
                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                <input type="checkbox" class="custom-control-input" id="tin" name="tin" value="emp_benefits.tin_num">
                                <label class="custom-control-label" for="tin">TIN No.</label>
                            </div>
                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                <input type="checkbox" class="custom-control-input" id="city_add" name="city_add" value="emp_addresses.unit_num">
                                <label class="custom-control-label" for="city_add">City Address</label>
                            </div>
                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                <input type="checkbox" class="custom-control-input" id="contact_num" name="contact_num" value="emp_contacts.mobile_num">
                                <label class="custom-control-label" for="contact_num">Contact No.</label>
                            </div>
                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                <input type="checkbox" class="custom-control-input" id="email" name="email" value="users.email">
                                <label class="custom-control-label" for="email">Email Address</label>
                            </div>
                        </div>
                    </div>
                    <div class="col bdT bdR p-0">
                        <div class="p-10 bgc-grey-100 layer w-100 text-center">
                            Educational Background
                        </div>
                        <div class="bdT layer w-100 fxg-1 p-20">
                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                <input disabled type="checkbox" class="custom-control-input" id="course" name="course" value="emp_educations.course">
                                <label class="custom-control-label" for="course">Course</label>
                            </div>
                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                <input disabled type="checkbox" class="custom-control-input" id="studies" name="studies" value="emp_educations.master_education_key">
                                <label class="custom-control-label" for="studies">Graduate Studies</label>
                            </div>
                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                <input disabled type="checkbox" class="custom-control-input" id="name_of_school" name="name_of_school" value="emp_educations.name_of_school">
                                <label class="custom-control-label" for="name_of_school">Name of School</label>
                            </div>
                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                <input disabled type="checkbox" class="custom-control-input" id="year_graduated" name="year_graduated" value="emp_educations.year_graduated">
                                <label class="custom-control-label" for="year_graduated">Year Graduated</label>
                            </div>
                        </div>
                    </div>
                    <div class="col bdT bdR p-0">
                        <div class="p-10 bgc-grey-100 layer w-100 text-center">
                            Work Experience
                        </div>
                        <div class="bdT layer w-100 fxg-1 p-20">
                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                <input disabled type="checkbox" class="custom-control-input" id="position" name="position" value="emp_experiences.master_job_title_key">
                                <label class="custom-control-label" for="position">Position</label>
                            </div>
                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                <input disabled type="checkbox" class="custom-control-input" id="company" name="company" value="emp_experiences.company_name">
                                <label class="custom-control-label" for="company">Company</label>
                            </div>
                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                <input disabled type="checkbox" class="custom-control-input" id="employment_type" name="employment_type" value="emp_experiences.company_address">
                                <label class="custom-control-label" for="employment_type">Employment Type</label>
                            </div>
                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                <input disabled type="checkbox" class="custom-control-input" id="contract_start" name="contract_start" value="emp_experiences.date_from">
                                <label class="custom-control-label" for="contract_start">Contract Start</label>
                            </div>
                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                <input disabled type="checkbox" class="custom-control-input" id="contract_end" name="contract_end" value="emp_experiences.date_to">
                                <label class="custom-control-label" for="contract_end">Contract End</label>
                            </div>
                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                <input disabled type="checkbox" class="custom-control-input" id="responsibilities" name="responsibilities" value="emp_experiences.responsibilities">
                                <label class="custom-control-label" for="responsibilities">Date Resigned</label>
                            </div>
                        </div>
                    </div>
                    <div class="col bdT bdR p-0">
                        <div class="p-10 bgc-grey-100 layer w-100 text-center">
                            Training/Seminar
                        </div>
                        <div class="bdT layer w-100 fxg-1 p-20">
                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                <input disabled type="checkbox" class="custom-control-input" id="training" name="training" value="emp_trainings.title">
                                <label class="custom-control-label" for="training">Training</label>
                            </div>
                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                <input disabled type="checkbox" class="custom-control-input" id="train_start" name="train_start" value="emp_trainings.date_from">
                                <label class="custom-control-label" for="train_start">Training Start</label>
                            </div>
                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                <input disabled type="checkbox" class="custom-control-input" id="train_end" name="train_end" value="emp_trainings.date_to">
                                <label class="custom-control-label" for="train_end">Training End</label>
                            </div>
                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                <input disabled type="checkbox" class="custom-control-input" id="train_loc" name="train_loc" value="emp_trainings.place_seminar">
                                <label class="custom-control-label" for="train_loc">Location</label>
                            </div>
                        </div>
                    </div>
                    <div class="col bdT   p-0">
                        <div class="p-10 bgc-grey-100 layer w-100 text-center">
                            Training/Seminar
                        </div>
                        <div class="bdT layer w-100 fxg-1 p-20">
                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                <input disabled type="checkbox" class="custom-control-input" id="training">
                                <label class="custom-control-label" for="training">Training</label>
                            </div>
                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                <input disabled type="checkbox" class="custom-control-input" id="train_start">
                                <label class="custom-control-label" for="train_start">Training Start</label>
                            </div>
                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                <input disabled type="checkbox" class="custom-control-input" id="train_end">
                                <label class="custom-control-label" for="train_end">Training End</label>
                            </div>
                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                <input disabled type="checkbox" class="custom-control-input" id="train_loc">
                                <label class="custom-control-label" for="train_loc">Location</label>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="ta-r bdT w-100 p-20">
                <button type="submit" class="btn btn-info">Generate Report</button>
            </div>
        </form>
    </div>
@endsection
