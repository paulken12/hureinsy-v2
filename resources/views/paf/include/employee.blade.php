<h4><i class="ti-user"></i> &nbsp; <strong>Employee Information</strong></h4>
<hr>

<div class="row">
	<div class="col">
		<div class="form-group">
			<label for="raj_id"><strong>Employee ID:</strong></label>
			<p>{{$employee_name->company_id}}</p>
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			<label for="name"><strong>Name of Employee:</strong></label>
			<p>{{$employee_name->first_name}} {{$employee_name->middle_name}} {{$employee_name->last_name}}</p>
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
			<p>{{$employee_contract->jobs->job_title}} {{$employee_contract->jobs->job_description}}</p>
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			<label for="department"><strong>Department</strong></label>
			<p>{{$employee_contract->jobs->department->department}}</p>
		</div>
	</div>
</div>