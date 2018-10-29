@extends('layouts.dashboard')
@section('content')
<div class="full-container">
    <div class="remain-height pos-r scrollable">
        <div class="bgc-white bdrs-3 ">
			<div class="card">
				<div class="card-header bg-white">
					<div class="btn-toolbar justify-content-between">
						<h4><i class="ti-write"></i> &nbsp; <strong>Personnel Action Form (For Approval)</strong></h4>
						<div>	
							<a href="{{route('paf.approval.list', [date('m'), date('Y')])}}" class="btn btn-secondary btn-sm" type="button">Go Back</a>
						</div>
					</div>
				</div>

				@if(count($errors))
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						@foreach($errors->all() as $err)
							<li>{!!$err!!}</li>
						@endforeach
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				@endif

				<form action="{{route('paf.approval.list.store', $get_paf_details->id)}}" method="post">
					{{csrf_field()}}

					<div class="nav nav-tabs" id="nav-tab" role="tablist">

						<a class="nav-item nav-link active" id="nav-empinfo-tab" data-toggle="tab" href="#nav-empinfo" role="tab" aria-controls="nav-empinfo" aria-selected="true">Employee Info</a>

						<a class="nav-item nav-link" id="nav-natact-tab" data-toggle="tab" href="#nav-natact" role="tab" aria-controls="nav-natact" aria-selected="false">Nature of Action</a>

						<a class="nav-item nav-link" id="nav-job-tab" data-toggle="tab" href="#nav-job" role="tab" aria-controls="nav-job" aria-selected="false">Change in Job Title, Duties, and Responsibilities Details</a>

						<a class="nav-item nav-link" id="nav-sched-tab" data-toggle="tab" href="#nav-sched" role="tab" aria-controls="nav-sched" aria-selected="false">Change in Work Schedule Details</a>

						<a class="nav-item nav-link" id="nav-compe-tab" data-toggle="tab" href="#nav-compe" role="tab" aria-controls="nav-compe" aria-selected="false">Change in Compensation and Benefit Details</a>

						<a class="nav-item nav-link" id="nav-rem-tab" data-toggle="tab" href="#nav-rem" role="tab" aria-controls="nav-rem" aria-selected="false">HR Assessment</a>
						

					</div>

					<div class="tab-content" id="nav-tabContent">

							<div class="tab-pane fade show active" id="nav-empinfo" role="tabpanel" aria-labelledby="nav-empinfo-tab">
								<div class="card-body">
									@include('paf.include.employee')
								</div>
							</div>

							<div class="tab-pane fade" id="nav-natact" role="tabpanel" aria-labelledby="nav-natact-tab">
								<div class="card-body">
									@include('paf.include.readnature')
								</div>
							</div>

							<div class="tab-pane fade" id="nav-job" role="tabpanel" aria-labelledby="nav-job-tab">
								<div class="card-body">
									@include('paf.epaf.include.job')
								</div>
							</div>
							
							<div class="tab-pane fade" id="nav-sched" role="tabpanel" aria-labelledby="nav-sched-tab">
								<div class="card-body">
									@include('paf.epaf.include.schedule')
								</div>
							</div>
							
							<div class="tab-pane fade" id="nav-compe" role="tabpanel" aria-labelledby="nav-compe-tab">
								<div class="card-body">
									@include('paf.epaf.include.compensation')
								</div>
							</div>

							<div class="tab-pane fade" id="nav-rem" role="tabpanel" aria-labelledby="nav-rem-tab">
								<div class="card-body">
									@include('paf.include.readremarks')
								</div>
							</div>	

					</div>
					<hr>
		
					<div class="container">				
						<action-management 	
							:categories="{{$request_status}}"
							:subcategories="{{$sub_request_status}}">
						</action-management>
					</div>

					<div class="form-group text-center">
						<button class="btn btn-success" type="submit">Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection