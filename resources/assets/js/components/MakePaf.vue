<template>

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
						<p>Name: {{ emp_name }}</p>
						<p>Description: {{ emp_id }}</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary">Save changes</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>	
		</div>
		<div>
			<a class="btn btn-primary btn-sm" @click="PafRequested(emp_info)" href="#">ww</a>
		</div>
	</div>

</template>

<script>

export default{ 
	props: ['emp_info'],

	data: function(){
		return {
			empl_name: '',
			empl_id: '',

		}
	},

	methods: {

        PafRequested(emp_info) {
          this.empl_name = empl_info.first_name;
          this.empl_id = empl_info.company_id;
					$("#request-modal").modal('show');
        },

	}
}
	
</script>
