@extends('layouts.dashboard')

@section('content')
<div class="full-container">
	<div class="card  remain-height pos-r scrollable">
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
		<div class="card-header">
			<div class="btn-toolbar justify-content-between">
				<h4><i class="ti-write"></i> &nbsp; <strong>Personnel Action Form</strong></h4>
				<a href="{{route('paf.search')}}" class="btn btn-secondary" type="button">Back</a>
			</div>
		</div>

		<form action="{{route('paf.search.result.store', $employee_info->company_id)}}" method="post">	
			<div class="card-body">
				{{csrf_field()}}

				<h4><i class="ti-user"></i> &nbsp; <strong>Employee Information</strong></h4>
				<hr>
		
				<div class="row">
					<div class="col">
						<div class="form-group">
							<label for="raj_id"><strong>Employee ID:</strong></label>
							<p>{{$employee_info->company_id}}</p>
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							<label for="name"><strong>Name of Employee:</strong></label>
							<p>{{$employee_info->first_name}} {{$employee_info->middle_name}} {{$employee_info->last_name}}</p>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col">
						<div class="form-group">
							<label for="date_hired"><strong>Date Hired</strong></label>
							<p>{{$employee_contract->contract_start}}</p>
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							<label for="team"><strong>Team</strong></label>
							<p></p>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col">
						<div class="form-group">
							<label for="position"><strong>Position</strong></label>
							<p>{{empty($employee_contract->master_job_title_id) ? '' : $jobTitles->where('id', $employee_contract->master_job_title_id)->pluck('job_titles')->first() .' - '. $jobTitles->where('id', $employee_contract->master_job_title_id)->pluck('description')->first()}}</p>
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							<label for="department"><strong>Department</strong></label>
							<p>{{empty($employee_contract->master_department_key) ? '' : $department->where('key', $employee_contract->master_department_key)->pluck('department')->first()}}</p>
						</div>
					</div>
				</div>

				<hr>
				<h4><i class="ti-pencil"></i> &nbsp; <strong>Nature of Action</strong></h4>
				<hr>

				<div class="row">
					<div class="col">
						<div class="form-group">
							<label for="employment_status"><strong>Employment Status</strong></label>
							<select name="employment_status" id="employment_status" class="form-control" required>
								<option value="" >--select--</option>
								@foreach ($employment_status as $employment)
									<option value="{{$employment->key}}">{{$employment->change_type}}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col">
						<div class="form-group">
							<label for="remarks"><strong>Remarks</strong></label>
							<input type="text" id="remarks" name="remarks" class="form-control" title="Remarks">
						</div>
					</div>
				</div>	

				<div id="accordion">
					@include('paf.mpaf.include.job')
					@include('paf.mpaf.include.schedule')
					@include('paf.mpaf.include.compensation')
				</div>
				
				<hr>
				<div class="row">
					<div class="col">
						<div class="form-group text-center">
							<button class="btn btn-success" type="submit">Request to Human Resource</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection