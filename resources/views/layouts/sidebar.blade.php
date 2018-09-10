<div class="sidebar" @mouseover="mouseHover" xmlns:v-bind="http://www.w3.org/1999/xhtml">
    <div class="sidebar-inner">
        <div class="sidebar-logo">
            <div v-bind:class="{'user-close': isClose,'user-open': !isClose }">
                <div >
                    <img class="rounded-circle"
                         src="{{asset('images/avatars/raj_male.png')}}"
                         alt="User avatar">
                </div>

                <span><a href="{{route('profile')}}">Kenneth Paul Cabrillas</a></span>

                <p >
                    <small >DEVELOPER</small>
                </p>
            </div>

        </div>
        <ul class="sidebar-menu scrollable pos-r">
            <li class="nav-item mT-30 active"><a class="sidebar-link" href="{{route('home')}}"><span class="icon-holder"><i
                                class="c-blue-500 ti-home"></i> </span><span class="title">Dashboard</span></a></li>
            <li class="nav-item"><a class="sidebar-link" href="{{route('team')}}"><span class="icon-holder"><i
                                class="c-blue-500 ti-star"></i> </span><span class="title">My Team</span></a></li>
            <li class="nav-item"><a class="sidebar-link" href="#"><span class="icon-holder"><i
                                class="c-blue-500 ti-alarm-clock"></i> </span><span
                            class="title">Attendance Management</span></a></li>
            <li class="nav-item"><a class="sidebar-link" href="#"><span class="icon-holder"><i
                                class="c-blue-500 ti-eye"></i> </span><span class="title">Personnel Action</span></a>
            </li>
            <li class="nav-item dropdown"><a class="dropdown-toggle" href="javascript:void(0);"><span
                            class="icon-holder"><i class="c-blue-500 ti-layout-list-thumb"></i> </span><span
                            class="title">Employee Management</span> <span class="arrow"><i
                                class="ti-angle-right"></i></span></a>
                <ul class="dropdown-menu">
                    <li><a class="sidebar-link" href="basic-table.html">Personnel List</a></li>
                    <li><a class="sidebar-link" href="datatable.html">New Employee</a></li>
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
                            <span>Roles</span>
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
        </ul>
    </div>
</div>