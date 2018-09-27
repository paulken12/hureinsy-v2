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
                <li class="nav-item"><a class="sidebar-link" href="{{route('team')}}"><span class="icon-holder"><i
                                    class="c-blue-500 ti-star"></i> </span><span class="title">My Team</span></a></li>

                <li class="nav-item dropdown">
                    <a class="dropdown-toggle" href="javascript:void(0);">
                        <span class="icon-holder">
                        <i class="c-blue-500 ti-time"></i>
                        </span>
                        <span class="title">Attendace</span>
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
                                        <a href="javascript:void(0);">Scheduler</a>
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
                            <li><a class="sidebar-link" href="#">Reports</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="sidebar-link" href="#"><span class="icon-holder"><i
                                        class="c-blue-500 ti-eye"></i> </span><span class="title">Personnel Action</span></a>
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
                                        <a href="javascript:void(0);">Departments</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Positions</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Companies</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Teams</a>
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
                                        <a href="javascript:void(0);">Address Types</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Blood Types</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Civil Statuses</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Education Types</a>
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

