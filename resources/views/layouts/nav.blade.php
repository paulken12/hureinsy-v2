<div class="header navbar" xmlns:v-on="http://www.w3.org/1999/xhtml">
    <div class="header-container">
        <ul class="nav-left">
            <li><a v-on:click="isCollapsed = !isCollapsed"><i
                            class="ti-menu"></i></a>
            </li>
            <li class="search-box"><a class="search-toggle no-pdd-right" href="javascript:void(0);"><i
                            class="search-icon ti-search pdd-right-10"></i> <i
                            class="search-icon-close ti-close pdd-right-10"></i></a></li>
            <li class="search-input"><input class="form-control" type="text" placeholder="Search..."></li>
        </ul>
        <ul class="nav-right">
            <li class="notifications dropdown"><span class="counter ">3</span> <a href=""
                                                                                  class="dropdown-toggle no-after"
                                                                                  data-toggle="dropdown"><i
                            class="ti-bell"></i></a>
                <ul class="dropdown-menu">
                    <li class="pX-20 pY-15 bdB"><i class="ti-bell pR-10"></i> <span
                                class="fsz-sm fw-600 c-grey-900">Notifications</span></li>
                    <li>
                        <ul class="ovY-a pos-r scrollable lis-n p-0 m-0 fsz-sm">
                            <li><a href=""
                                   class="peers fxw-nw td-n p-20 bdB c-grey-800 cH-blue bgcH-grey-100">
                                    <div class="peer mR-15"><img class="w-3r bdrs-50p"
                                                                 src="{{asset('images/avatars/raj_male.png')}}"
                                                                 alt=""></div>
                                    <div class="peer peer-greed"><span><span
                                                    class="fw-500">John Doe</span> <span class="c-grey-600">approved <span
                                                        class="text-dark">Job Offer</span></span></span>
                                        <p class="m-0">
                                            <small class="fsz-xs">5 mins ago</small>
                                        </p>
                                    </div>
                                </a></li>
                            <li><a href=""
                                   class="peers fxw-nw td-n p-20 bdB c-grey-800 cH-blue bgcH-grey-100">
                                    <div class="peer mR-15"><img class="w-3r bdrs-50p"
                                                                 src="{{asset('images/avatars/raj_male.png')}}"
                                                                 alt=""></div>
                                    <div class="peer peer-greed"><span><span
                                                    class="fw-500">Moo Doe</span> <span
                                                    class="c-grey-600">disapproved <span class="text-dark">PAF</span></span></span>
                                        <p class="m-0">
                                            <small class="fsz-xs">7 mins ago</small>
                                        </p>
                                    </div>
                                </a></li>
                            <li><a href=""
                                   class="peers fxw-nw td-n p-20 bdB c-grey-800 cH-blue bgcH-grey-100">
                                    <div class="peer mR-15"><img class="w-3r bdrs-50p"
                                                                 src="{{asset('images/avatars/raj_male.png')}}"
                                                                 alt=""></div>
                                    <div class="peer peer-greed"><span><span
                                                    class="fw-500">Lee Doe</span> <span
                                                    class="c-grey-600">approved <span
                                                        class="text-dark">PAF</span></span></span>
                                        <p class="m-0">
                                            <small class="fsz-xs">10 mins ago</small>
                                        </p>
                                    </div>
                                </a></li>
                        </ul>
                    </li>
                    <li class="pX-20 pY-15 ta-c bdT"><span><a href=""
                                                              class="c-grey-600 cH-blue fsz-sm td-n">View All Notifications <i
                                        class="ti-angle-right fsz-xs mL-10"></i></a></span></li>
                </ul>
            </li>
            <li class="dropdown"><a href="" class="dropdown-toggle no-after peers fxw-nw ai-c lh-1"
                                    data-toggle="dropdown">
                    <div class="peer mR-10"><img class="w-2r bdrs-50p"
                                                 src="{{Auth::user()->avatar_path}}"
                                                 alt="">
                    </div>
                    <div class="peer"><span class="fsz-sm c-grey-900">{{Auth::user()->name}}</span></div>
                </a>
                <ul class="dropdown-menu fsz-sm">
                    <li><a href="" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700"><i
                                    class="ti-settings mR-10"></i> <span>Setting</span></a></li>
                    <li><a href="{{route('profiles',Auth::user()->basicInfo->first())}}" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700"><i
                                    class="ti-user mR-10"></i>
                            <span>Profile</span></a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="{{route('logout')}}"  class="d-b td-n pY-5 bgcH-grey-100 c-grey-700" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i
                                    class="ti-power-off mR-10"></i> <span>{{ __('Logout') }}</span></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>