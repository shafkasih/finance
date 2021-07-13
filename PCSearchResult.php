<p>
	<div class="well">
        <div class="alert alert-success fade in">
            <strong>Search Result(s)</strong>
        </div>
		<div class="row" style="max-height:300px;overflow-y:auto;overflow-x:hidden">
			<table class="table table-bordered table-hover" id="tbl_search_list">
			<thead>
			<tr>
				<th class="text-center">#</th>
				<th class="text-center">Project Code ID</th>
				<th class="text-center">Project Code Description</th>
				<th class="text-center">Action</th>
			</tr>
			</thead>
			<tbody>
			<?php
				$no = 0;
				
				if (!empty($pc)) {
					foreach ($pc as $PCSearch) {
						echo '
						<tr data-pc-id="' . $PCSearch->PM_PROJECT_CODE . '" data-pc-des="' . $PCSearch->PM_PROJECT_DESC . '">
							<td class="text-center col-md-1">' . ++$no . '</td>
							<td class="text-center col-md-1">' . $PCSearch->PM_PROJECT_CODE . '</td>
							<td class="text-left col-md-6">' . $PCSearch->PM_PROJECT_DESC . '</td>
							<td class="text-center col-md-1">
								<button type="button" class="btn btn-primary btn-xs select_pc_btn"><i class="fa fa-check-square-o"></i> Select</button>
							</td>
						</tr>
						';
					}
				} else {
			?>
				<tr role="row">
					<td class="center text-center" colspan="5">No record found.</td>
				</tr>
			<?php
				} 
			?>
			</tbody>
			</table>	
		</div>	
	</div>
</p>


<script>
$(document).ready(function() {
    
    $('#tbl_search_list').dataTable({"language": {"search": "Search Detail :"}} );      
        
} );
</script>