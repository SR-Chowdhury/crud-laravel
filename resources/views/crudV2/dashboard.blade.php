<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Shihanur Rahman Chowdhury">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <!-- toastr CSS (includes Bootstrap)-->
    <link href="{{ asset('public//assets/v2.0/toastr_styles.css')}}" rel="stylesheet" />

    <!-- Toastr CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <title>Explore SuperStar World</title>
</head>

<body>
    <div class="container py-3">
        <h1 class="text-center text-success">Bismillahir Rahmanir Rahim</h1>
        <h2 class="text-center text-info">CRUD Laravel v2.0</h2>
    </div>

    <div class="container">

        @yield('content')

    </div>



    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>

    <!-- Sweet Alert 2 just use this CDN; no need any dependencies -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- JQuery CDN-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- toastr CDN-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <!-- toastr JS-->
    <script src="{{ asset('public/assets/v2.0/toastr_scripts.js') }}"></script>

    <script>

        $(document).on("click", '#deleteSingleId', function(event) {
            event.preventDefault();

            var link = $(this).attr("href");

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = link;
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })

        })

    </script>

    <script>
          @if (Session::has('message'))

              var type = "{{ Session::get('alert-type', 'success') }}"

              switch(type) {
                  case 'success' :
                      toastr.success(" {{ Session::get('message') }} ");
                      break;
                  case 'info' :
                      toastr.info(" {{ Session::get('message') }} ");
                      break;
                  case 'warning' :
                      toastr.warning(" {{ Session::get('message') }} ");
                      break;
                  case 'error' :
                      toastr.error(" {{ Session::get('message') }} ");
              }

          @endif
    </script>

</body>

</html>
