@extends('layouts.dashboard')
@section('content')
	<div class="full-container">
        <div class="remain-height pos-r scrollable">
            <div class="bgc-white bdrs-3">
				<span class="align-middle">
  					<h3 class="pt-3 text-center text-primary">Request PAF</h3>
					<hr> 
					@if(session('error'))
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							{{session('error')}}
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					@elseif(session('success'))
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							{{session('success')}}
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					@endif	
	                <table id="paf-list" class="table" cellspacing="0" width="100%">
						<thead>
							<tr class="text-primary">
								<th class="text-center">Company ID</th>
								<th>Employee Name</th>
								<th>Employment Status</th>
								<th>Date Joined</th>
								<th class="text-center"></th>
							</tr>
						</thead>
						<tfoot>
							<tr class="text-primary">
								<th class="text-center">Company ID</th>
								<th>Employee Name</th>
								<th>Employment Status</th>
								<th class="text-center"></th>
							</tr>
						</tfoot>
						<tbody>
							@foreach ($employee_info as $lists)
								@if($lists->contract->pluck('employment_status')->first() != 'resigned')
									<tr>
										<th class="text-center">{{empty($lists->company_id) ? '' : $lists->company_id}}</th>
										<td>{{empty($lists->company_id) ? '' : $lists->last_name .', '. $lists->first_name}}</td>
										<td>{{$lists->contract->pluck('employment_status')->first()}}</td>
										<td>{{$lists->contract->pluck('contract_start')->first()}}</td>
										@if($lists->contract->pluck('contract_start')->first() <= date('Y-m-d', strtotime(date('Y-m-d'). ' - 6 months')) && $lists->contract->pluck('employment_status')->first() != 'resigned')
											<td>
												<a class="btn btn-primary btn-sm" href="{{route('paf.search.result.show', $lists->id)}}">Request Paf</a>
											</td>
										@else
											<td>
												<a class="btn btn-secondary btn-sm" href="{{route('paf.search.result.create', $lists->id)}}">Emergency Request</a>
											</td>
										@endif
									</tr>
								@endif
							@endforeach
						</tbody>
	                </table>
				</span>
            </div>
        </div>
    </div>

	<div>
		<div id="request-modal" class="modal fade">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Paf Request</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<p>Name: <span v-text="emp_name"></span></p>
						<p>Description: <span v-text="emp_id"></span></p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary">Save changes</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>	
		</div>
	</div>
@endsection

{{--

												<a class="btn btn-primary btn-sm" @click="modalShow({{$lists}})" href="#">Request a form</a>
												<make-paf
													:emp_info = "{{$lists}}"
												></make-paf>
												--}}