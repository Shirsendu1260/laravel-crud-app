<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Laravel CRUD • Create</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar p-3 bg-light">
        <div class="container-fluid d-flex justify-content-center">
            <span class="navbar-brand mb-0 h1 text-dark fw-bold">CREATE STUDENT DATA</span>
        </div>
    </nav>

    <!-- Main -->
    <div class="container py-3">
        <div class="d-flex justify-content-end py-3">
            <a href="{{ route('students.index') }}" class="btn btn-light">Back</a>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('students.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control @error('name')
                        is-invalid @enderror" name="name" placeholder="Mr. Bean" value="{{ old('name') }}">
                        @error('name')
                        <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            placeholder="email@exmaple.com" value="{{ old('email') }}">
                        @error('email')
                        <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea name="address" class="form-control" rows="3" style="resize: none;"
                            placeholder="XYZ Street, State, Country">{{ old('address') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Photo</label>
                        <input type="file" class="form-control @error('photo') is-invalid @enderror" name="photo">
                        @error('photo')
                        <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Save</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>