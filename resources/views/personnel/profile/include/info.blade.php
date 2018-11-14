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
            @foreach ($profile->empContract as $contract)
                @if(!empty($contract->jobDescription !== null))
                    <div class="peer peer-greed">
                        <i class="mR-10 ti-crown" title="Position"></i>
                        <span title="Position">{{$contract->jobDescription->job_title}}</span>
                    </div>
                @endif
            @endforeach

            @can('view', $profile->user)
                <div class="peer peer-greed">
                    <i class="mR-10 ti-email" title="Email"></i>
                    <span>{{$profile->user->email}}</span>
                </div>
            @endcan

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