@extends('main')

@section('content')

<!-- Custom styling plus plugins -->
    <link href="css/custom.css" rel="stylesheet">
    <!-- link href="css/icheck/flat/green.css" rel="stylesheet" -->
    <!-- link href="css/datatables/tools/css/dataTables.tableTools.css" rel="stylesheet" -->

					 <div class="module">
							<div class="module-head">
								<h3>Pending Sessions</h3>
							</div>
							<div class="module-body table">
								<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
									<thead>
										<tr class="headings">
											<th>Claim ID</th>
											<th>Date</th>
											<th>Member Name</th>
											<th>Folder Number</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
									@foreach($sessions as $session)
										<tr class="even pointer">
											<td>{{ $session->Claim_No }}</td>
											<td>{{ date($session->Date_Created) }}</td>
											<td class="center">{{ $session->Name_Of_Member }}</td>
											<td class="center">{{ $session->Hosp_Folder_No }}</td>
											<td class="center"><a href="/Claim/{{ $session->Claim_No }}" class="btn btn-success pull-right">Fill Details</a></td>
										</tr>
									@endforeach
										
										
									</tbody>
									
								</table>
							</div>
						</div>





<script src="scripts/jquery-1.9.1.min.js"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="scripts/datatables/jquery.dataTables.js"></script>
	<script>
		$(document).ready(function() {
			$('.datatable-1').dataTable();
			$('.dataTables_paginate').addClass("btn-group datatable-pagination");
			$('.dataTables_paginate > a').wrapInner('<span />');
			$('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
			$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
		} );
	</script>


@stop