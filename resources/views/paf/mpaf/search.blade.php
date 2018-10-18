@extends('layouts.dashboard')
@section('content')
	<div class="full-container">
        <div class="remain-height pos-r scrollable">
            <div class="bgc-white bdrs-3">
				<span class="align-middle">
  					<h3 class="pt-3 text-center">Request PAF</h3>
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
				</span>
                <table id="paf-list" class="table" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th class="text-center">Company ID</th>
							<th>Employee Name</th>
							<th>Employment Status</th>
							<th class="text-center"></th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th class="text-center">Company ID</th>
							<th>Employee Name</th>
							<th>Employment Status</th>
							<th class="text-center"></th>
						</tr>
					</tfoot>
					<tbody>
						@foreach ($employee_info as $lists)
							@if($lists->contract->pluck('contract_start')->first() <= date('Y-m-d', strtotime(date('Y-m-d'). ' - 6 months')) && $lists->contract->pluck('contract_start')->first() != date('0000-00-00'))
								<tr>
									<th class="text-center">{{empty($lists->company_id) ? '' : $lists->company_id}}</th>
									<td>{{empty($lists->company_id) ? '' : $lists->last_name .', '. $lists->first_name}}</td>
									<td>{{$lists->contract->pluck('employment_status')->first()}}</td>
									<td>
										<a class="btn btn-primary btn-sm" href="{{route('paf.search.result.show', $lists->company_id)}}">Request a form</a>
									</td>
								</tr>
							@endif
						@endforeach
					</tbody>
                </table>
            </div>
        </div>
    </div>
@endsection