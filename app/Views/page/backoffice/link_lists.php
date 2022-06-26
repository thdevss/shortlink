
<main class="content">
    <div class="container-fluid p-0">

        <div class="row">
            <div class="col-xl-12 col-xxl-12 d-flex">
                <div class="w-100">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
									<h5 class="card-title">All link with short!</h5>
								</div>
                                <div class="card-body">
                                    <table id="datatable" class="table table-hover table-stripexd" style="width:100%">
										<thead>
											<tr>
												<th style="width:20%;">Created At</th>
												<th>Short Link</th>
												<th style="width:15%;">Destination Link</th>
												<th>Remark</th>
												<th style="width:10%;"></th>
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
var table;
document.addEventListener("DOMContentLoaded", function() {
    // Datatables Fixed Header
    table = jQuery("#datatable").DataTable({
        fixedHeader: true,
        order: [[0, 'desc']],
        pageLength: 10,
        ajax: {
            url: `<?php echo site_url('/link');?>`,
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
                data: 'link_key',
                render: function (data, type) {
                    if (type === 'display') {
                        return `<a href="${BASE_URL}/${data}">${BASE_URL}/${data}</a>`;
                    }
 
                    return data;
                },
            },
            {
                data: 'destination_link',
            },
            {
                data: 'remark',
            },
            {
                data: 'id',
                render: function (data, type) {
                    if (type === 'display') {
                        return `
                        <a href="${BASE_URL}/backoffice/link/${data}"><i data-feather="file-text"></i></a>
                        <a onclick="delete_btn(${data})" style="cursor:pointer;"><i data-feather="trash"></i></a>
                        `;
                    }
 
                    return data;
                },
            },
        ]
    });
    
});

const delete_btn = function(link_id) {
    if(!link_id) {
        return;
    }

    Swal.fire({
        title: 'Delete it?',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        icon: 'warning',
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                html: '<h5>Loading...</h5>',
                showConfirmButton: false,
                allowEscapeKey: false,
                allowOutsideClick: false
            });

            axios.delete(`../../../../../link/${link_id}`, {}).then(function (response) {
                if(response.data.status == true) {
                    Swal.fire('Deleted!', '', 'success')
                    // reload table
                    table.ajax.reload();
                } else {    
                    let error_txt = '';
                    for (const i in response.data.data) {
                        error_txt += response.data.data[i] + "<br />";
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                        footer: error_txt
                    })

                }
            }).catch(function (error) {

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                    footer: error.message
                })

            });


        }
    })
}

      

</script>