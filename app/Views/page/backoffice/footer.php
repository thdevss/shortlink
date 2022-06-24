
			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">
								<span class="text-muted">Powered by CodeIgniter 4, Bootstrap 5, Template by <a href="https://adminkit.io/" class="text-muted" target="_blank"><strong>AdminKit</strong></a></span> &copy;
							</p>
						</div>
						<div class="col-6 text-end">
							<ul class="list-inline">
								<li class="list-inline-item">
									<a class="text-muted" href="https://github.com/thdevss" target="_blank">Github</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>


	<!-- modal -->

	<div class="modal fade" id="createLinkModal" tabindex="-1" aria-labelledby="createLinkModalLabel" aria-hidden="true">
  		<div class="modal-dialog">
    		<div class="modal-content">
      			<div class="modal-header">
        			<h5 class="modal-title" id="createLinkModalLabel">Short a link!</h5>
        			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      			</div>
      			<div class="modal-body">
				  	<div class="mb-3">
						<label for="destination_link" class="form-label">URL</label>
						<input type="url" class="form-control" id="destination_link" name="destination_link">
					</div>
					<div class="mb-3">
						<label for="remark" class="form-label">Remark</label>
						<input type="text" class="form-control" id="remark">
					</div>
      			</div>
      			<div class="modal-footer">
        			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button class="btn btn-primary" id="btn-short" type="button">
						<span class="spinner-border spinner-border-sm" style="display:none;" role="status" aria-hidden="true"></span>
						<span class="txt">Short!</span>
					</button>
      			</div>
    		</div>
  		</div>
	</div>



	<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.querySelector("#btn-short").addEventListener('click', short_a_link, false);
		var createLinkModal = new bootstrap.Modal(document.getElementById("createLinkModal"), {});


        function short_a_link() {
			if(document.querySelector('#destination_link').value == '') {
                alert('error!')
                return;
            }

            document.querySelector("#btn-short .spinner-border").style.display = 'inline-block'
            document.querySelector("#btn-short .txt").textContent = 'Loading'

            axios.post('../../../../link', {
                destination_link: document.querySelector('#destination_link').value,
				remark: document.querySelector('#remark').value,
            }).then(function (response) {
				createLinkModal.hide()

                if(response.data.status == true) {

                    Swal.fire({
                        title: 'แปลงลิ้งค์สำเร็จ',
                        html: `นำ URL ด้านล่างไปใช้งานได้ทันที<br /><input id="swal-input1" class="swal2-input" value="<?php echo base_url();?>/${response.data.data.link_key}">`,
                        focusConfirm: false
                    })      
                    document.querySelector('#destination_link').value = '';
                    document.querySelector('#remark').value = '';

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
                console.log(error);
            });
            
            document.querySelector("#btn-short .spinner-border").style.display = 'none'
            document.querySelector("#btn-short .txt").textContent = 'Short!'

        }
        
    </script>

</body>

</html>