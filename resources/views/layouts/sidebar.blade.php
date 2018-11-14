<div class="sidebar" xmlns:v-bind="http://www.w3.org/1999/xhtml" xmlns:v-on="http://www.w3.org/1999/xhtml">
    <div class="sidebar-inner">
        <!-- ### $Sidebar Header ### -->
        <div class="sidebar-logo">
            <div class="peers ai-c fxw-nw">
                <div v-bind:class="{'peer peer-greed text-center sidebar-open':isCollapsed, 'sidebar-close':!isCollapsed,  }">
                    <img src="{{Auth::user()->avatar_path}}" alt="" class="rounded-circle">
                    <br>
                    <span class="pb-4">
                        <small style="text-transform: uppercase;">
                            {{Auth::user()->roles->pluck('display_name')->first()}}
                        </small>
                    </span>


                </div>
                <div class="peer">
                    <div class="mobile-toggle sidebar-toggle">
                        <a class="td-n" v-on:click="isCollapsed = !isCollapsed">
                            <i class="ti-arrow-circle-left"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- ### $Sidebar Menu ### -->
        <div class="remain-height pos-r scrollable pb-5">
            <ul class="sidebar-menu ">
                <li class="nav-item mT-30 active"><a class="sidebar-link" href="{{route('dashboard')}}"><span
                                class="icon-holder"><i
                                    class="c-blue-500 ti-home"></i> </span><span class="title">Dashboard</span></a></li>
                {{--<li class="nav-item"><a class="sidebar-link" href="{{route('team')}}"><span class="icon-holder"><i--}}
                                    {{--class="c-blue-500 ti-star"></i> </span><span class="title">My Team</span></a></li>--}}
                <li class="nav-item"><a class="sidebar-link" href="#"><span class="icon-holder"><i
                                    class="c-blue-500 ti-layout-tab"></i> </span><span class="title">Company Training</span></a></li>
                <li class="nav-item dropdown">
                    <a class="dropdown-toggle" href="javascript:void(0);">
                        <span class="icon-holder">
                        <i class="c-blue-500 ti-time"></i>
                        </span>
                        <span class="title">Attendance</span>
                        <span class="arrow">
                        <i class="ti-angle-right"></i>
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        @if(Auth::user()->hasRole('titan'))
                            <li class="nav-item dropdown">
                                <a href="javascript:void(0);">
                                    <span>Daily Time Record</span>
                                    <span class="arrow">
            <i class="ti-angle-right"></i>
            </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="javascript:void(0);">Upload Raw Data</a>
                                    </li>
                                    <li>
                                        <a href="{{route('attendances')}}">Schedule</a>
                                    </li>
                               </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="javascript:void(0);">
                                    <span>SIL Management</span>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="javascript:void(0);">
                                    <span>Payroll Generator</span>
                                </a>
                            </li>
                        @endif
                        <li class="nav-item dropdown">
                            <a href="javascript:void(0);">
                                <span>My DTR</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="javascript:void(0);">
                                <span>Apprise Forms</span>
                                <span class="arrow">
            <i class="ti-angle-right"></i>
            </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="javascript:void(0);">Late</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">Absence</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">Official Business</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">Over Time</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">Under Time</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">Time In/Out Validation</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">Under Time</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">Change of Shift</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    @inject('count', 'App\Helper\Paf\PersonnelActionManagement')
                    <a class="dropdown-toggle" href="javascript:void(0);">
                        <span class="icon-holder">
                        <i class="c-blue-500 ti-write"></i>
                        </span>
                        <span class="title">Personnel Action</span>
                        <span class="arrow">
                        <i class="ti-angle-right"></i>
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="nav-item dropdown">
                            <a href="{{route('paf.myrequest.list', [date('m'), date('Y')])}}">
                                <span>My request lists<small><span class="badge badge-pill badge-danger" title="New completed request">{{empty($count->count_complete_user()) ? '' : $count->count_complete_user()}}</span></small></span>
                            </a>
                        </li>

                        @if(Auth::user()->hasRole('supervisor') || Auth::user()->hasRole('admin') || Auth::user()->hasRole('titan'))
                            <li class="nav-item dropdown">
                                <a href="{{route('paf.view.list', [date('m'), date('Y')])}}">
                                    <span>View all paf request</span>
                                </a>
                            </li>
                        @endif
                        @if(Auth::user()->hasRole('manager') || Auth::user()->hasRole('admin') || Auth::user()->hasRole('titan'))
                            <li class="nav-item dropdown">
                                <a href="{{route('paf.search')}}">
                                    <span>Request a form</span>
                                </a>
                            </li>
                        @endif
                        @if(Auth::user()->hasRole('manager') || Auth::user()->hasRole('admin') || Auth::user()->hasRole('titan'))
                            <li class="nav-item dropdown">
                                <a href="{{route('paf.reassess.list', [date('m'), date('Y')])}}">
                                    <span>Reassessment <small><span class="badge badge-pill badge-danger" title="Your request needs reassessment">{{empty($count->count_open_man()) ? '' : $count->count_open_man()}}</span></small></span>
                                </a>
                            </li>
                        @endif
                        @if(Auth::user()->hasRole('human-resource') || Auth::user()->hasRole('admin') || Auth::user()->hasRole('titan'))
                            <li class="nav-item dropdown">
                                <a href="{{route('paf.assessment.list', [date('m'), date('Y')])}}">
                                    <span>Assessment <small><span class="badge badge-pill badge-danger" title="You have request to assess">{{empty($count->count_open_hr()) ? '' : $count->count_open_hr()}}</span></small></span>
                                </a>
                            </li>
                        @endif
                        @if(Auth::user()->hasRole('executive') || Auth::user()->hasRole('admin') || Auth::user()->hasRole('titan'))
                            <li class="nav-item dropdown">
                                <a href="{{route('paf.approval.list', [date('m'), date('Y')])}}">
                                    <span>Approval <small><span class="badge badge-pill badge-danger" title="You have request to approve">{{empty($count->count_open_exec()) ? '' : $count->count_open_exec()}}</span></small></span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>

                @if(Auth::user()->hasRole('titan'))
                    {{--<li class="nav-item dropdown"><a class="dropdown-toggle" href="javascript:void(0);"><span--}}
                                    {{--class="icon-holder"><i class="c-blue-500 ti-time"></i> </span><span--}}
                                    {{--class="title">Attendance Management</span> <span class="arrow"><i--}}
                                        {{--class="ti-angle-right"></i></span></a>--}}
                        {{--<ul class="dropdown-menu">--}}
                            {{--<li><a class="sidebar-link" href="#">DTR</a></li>--}}
                            {{--<li><a class="sidebar-link" href="#">SIL Management</a></li>--}}
                            {{--<li><a class="sidebar-link" href="#">Notify Supervisor</a></li>--}}
                            {{--<li><a class="sidebar-link" href="#">Payroll Generator</a></li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                    <li class="nav-item dropdown"><a class="dropdown-toggle" href="javascript:void(0);"><span
                                    class="icon-holder"><i class="c-blue-500 ti-layout-list-thumb"></i> </span><span
                                    class="title">Employee Management</span> <span class="arrow"><i
                                        class="ti-angle-right"></i></span></a>
                        <ul class="dropdown-menu">
                            <li><a class="sidebar-link" href="{{route('personnel')}}">Personnel List</a></li>
                            <li><a class="sidebar-link" href="{{route('create.recruit')}}">New Recruit</a></li>
                            <li><a class="sidebar-link" href="{{route('reports')}}">Reports</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle" href="javascript:void(0);">
                        <span class="icon-holder">
                        <i class="c-blue-500 ti-settings"></i>
                        </span>
                            <span class="title">Admin Setting</span>
                            <span class="arrow">
                        <i class="ti-angle-right"></i>
                        </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="nav-item dropdown">
                                <a href="javascript:void(0);">
                                    <span>Manage Users</span>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="javascript:void(0);">
                                    <span>Role & Permission</span>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="javascript:void(0);">
                                    <span>Company Masters</span>
                                    <span class="arrow">
                                        <i class="ti-angle-right"></i>
                                    </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{route('setting.masters.departments')}}">Departments</a>
                                    </li>
                                    <li>
                                        <a href="{{route('setting.masters.titles')}}">Positions</a>
                                    </li>
                                    <li>
                                        <a href="{{route('setting.masters.companies')}}">Companies</a>
                                    </li>
                                    <li>
                                        <a href="{{route('setting.masters.employeestatuses')}}">Employment Status</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Teams</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="javascript:void(0);">
                                    <span>Paf Masters</span>
                                    <span class="arrow">
                                        <i class="ti-angle-right"></i>
                                    </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{route('setting.masters.contract')}}">Contract change</a>
                                    </li>
                                    <li>
                                        <a href="{{route('setting.masters.schedrequest')}}">Schedule Request</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="javascript:void(0);">
                                    <span>Other Masters</span>
                                    <span class="arrow">
                                        <i class="ti-angle-right"></i>
                                    </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{route('setting.masters.address')}}">Address Types</a>
                                    </li>
                                    <li>
                                        <a href="{{route('setting.masters.blood')}}">Blood Types</a>
                                    </li>
                                    <li>
                                        <a href="{{route('setting.masters.civil')}}">Civil Statuses</a>
                                    </li>
                                    <li>
                                        <a href="{{route('setting.masters.education')}}">Education Types</a>
                                    </li>
                                    <li>
                                        <a href="{{route('setting.masters.citizenship')}}">Citizenship</a>
                                    </li>
                                    <li>
                                        <a href="{{route('setting.masters.extension')}}">Name Extension</a>
                                    </li>
                                    <li>
                                        <a href="{{route('setting.masters.family')}}">Family Type</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    @else
                    <li class="nav-item"><a class="sidebar-link" href="{{route('personnel')}}"><span class="icon-holder"><i
                                        class="c-blue-500 ti-list"></i> </span><span class="title">Personnel List</span></a></li>
                    @endif

            </ul>
        </div>
    </div>
</div>

