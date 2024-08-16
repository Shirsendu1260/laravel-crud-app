<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Laravel CRUD</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
</head>

<body>
    <div class="container d-flex flex-column justify-content-center align-items-center min-vh-100">
        <h1 class="text-center">LARAVEL CRUD</h1>
        <p class="mt-1 mb-2 col-10 text-center">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis placeat sapiente enim nam totam suscipit
            nemo aperiam rerum quaerat vitae.
        </p>
        <a href="{{ route('students.index') }}" class="btn btn-primary mt-3" role="button">Proceed</a>
    </div>
</body>

</html>