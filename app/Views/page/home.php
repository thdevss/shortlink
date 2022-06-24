
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Short a link.">
    <title>Short a link.</title>

    

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">



    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>

    
</head>
<body>
    
    <main class="container">
        <div class="bg-light p-5 rounded mt-3">
            <h1>Short a link!</h1>
            
            <div class="mb-3">
                <input type="url" class="form-control" id="destination_link" style="margin-top: 5%;margin-bottom: 5%;" placeholder="https://google.com">
            </div>
            
            <div class="text-end">

                <button class="btn btn-outline-primary" id="btn-short" type="button">
                    <span class="spinner-border spinner-border-sm" style="display:none;" role="status" aria-hidden="true"></span>
                    <span class="txt">Short!</span>
                </button>

            </div>
        </div>
    </main>
    <nav class="navbar fixed-bottom navbar-expand-sm navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Short a link</a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
            <ul class="navbar-nav ">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/backoffice/login" tabindex="-1" aria-disabled="true">Backoffice</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://github.com/thdevss">Github</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://www.linkedin.com/in/pichet-s-89a5a8178">Linkedin</a>
                </li>
            </ul>
        </div>
    </div>
    </nav>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.querySelector("#btn-short").addEventListener('click', short_a_link, false);


        function short_a_link() {

            if(document.querySelector('#destination_link').value == '') {
                alert('error!')
                return;
            }

            document.querySelector("#btn-short .spinner-border").style.display = 'inline-block'
            document.querySelector("#btn-short .txt").textContent = 'Loading'

            axios.post('/link', {
                destination_link: document.querySelector('#destination_link').value,
            }).then(function (response) {
                if(response.data.status == true) {
                    Swal.fire({
                        title: 'แปลงลิ้งค์สำเร็จ',
                        html: `นำ URL ด้านล่างไปใช้งานได้ทันที<br /><input id="swal-input1" class="swal2-input" value="<?php echo base_url();?>/${response.data.data.link_key}">`,
                        focusConfirm: false
                    })      
                    document.querySelector('#destination_link').value = '';
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
