
<main class="content">
    <div class="container-fluid p-0">

        <div class="row">
            <div class="col-xl-12 col-xxl-12 d-flex">
                <div class="w-100">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header">
									<h5 class="card-title">Link detail</h5>
								</div>
                                <div class="card-body">
                                    <table class="table table-sm mb-4">
										<tbody>
											<tr>
												<th>Short</th>
												<td><?php echo base_url($link['link_key']);?></td>
											</tr>
											<tr>
												<th>Destination</th>
												<td><?php echo $link['destination_link'];?></td>
											</tr>
											<tr>
												<th>Create At.</th>
												<td><?php echo $link['created_at'];?></td>
											</tr>
											<tr>
												<th>Creator</th>
												<td><?php echo $link['user_id'];?> (IP: <?php echo $link['ipaddr_created'];?>)</td>
											</tr>
										</tbody>
									</table>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                        
                            <div class="card">
                                <div class="card-header">
									<h5 class="card-title">Visitors detail</h5>
								</div>
                                <div class="card-body">
                                    <table id="datatable" class="table table-hover table-stripexd" style="width:100%">
										<thead>
											<tr>
												<th style="width:20%;">Visit At?</th>
												<th style="width:15%;">IP Address</th>
												<th style="width:15%;">Referrer</th>
												<th style="width:15%;">Device</th>
												<th style="width:15%;">OS</th>
												<th style="width:15%;">Browser</th>
											</tr>
										</thead>
										<tbody></tbody>
									</table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

    </div>
</main>

<link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
const BASE_URL = `<?php echo base_url();?>`;
const LINK_ID = `<?php echo $LINK_ID;?>`
var table;
document.addEventListener("DOMContentLoaded", function() {


    // Datatables Fixed Header
    table = jQuery("#datatable").DataTable({
        fixedHeader: true,
        order: [[0, 'desc']],
        pageLength: 10,
        ajax: {
            url: `${BASE_URL}/link/${LINK_ID}?data=visitors`,
            dataSrc: 'data',
        },
        "drawCallback": function(settings) {
            feather.replace()
            //do whatever  
        },
        columns: [
            {
                data: 'created_at',
            },
            {
                data: 'v_ipaddr',
                // render: function (data, type) {
                //     if (type === 'display') {
                //         return `<a href="${BASE_URL}/${data}">${BASE_URL}/${data}</a>`;
                //     }
 
                //     return data;
                // },
            },
            {
                data: 'raw_referrer',
            },
            {
                data: 'v_ua_device',
            },
            {
                data: 'v_ua_os',
            },
            {
                data: 'v_ua_browser',
            }
        ]
    });
    
});



</script>