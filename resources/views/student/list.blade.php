<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Laravel CRUD • Home</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar p-3 bg-light">
        <div class="container-fluid d-flex justify-content-center">
            <span class="navbar-brand mb-0 h1 text-dark fw-bold">DETAILS OF STUDENTS</span>
        </div>
    </nav>

    <!-- Main -->
    <div class="container py-3">
        <div class="d-flex justify-content-between py-3">
            <h4 class="m-0">Students</h4>
            <a href="{{ route('students.create') }}" class="btn btn-light">Create</a>
        </div>
        @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
        @endif
        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th>ID</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                    @if($students->isNotEmpty())
                    @foreach($students as $student)
                    <tr valign="middle">
                        <td>{{ $student->id }}</td>
                        <td>
                            @if($student->photo != '' && file_exists(public_path() . '/uploads/students/' .
                            $student->photo))
                            <img src="{{ url('/uploads/students/' . $student->photo) }}" width="52" height="52"
                                class="rounded-circle">
                            @else
                            <img src="{{ url('/assets/images/' . 'user.png') }}" width="52" height="52"
                                class="rounded-circle">
                            @endif
                        </td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->address }}</td>
                        <td>
                            <a href="{{ route('students.edit', $student->id) }}" type="button"
                                class="btn btn-sm btn-light">Edit</a>
                            <a href="{{ route('students.destroy, $student->id }}"
                                onclick="deleteStudent({{ $student->id }})" type="button"
                                class="btn btn-sm btn-danger">Delete</a>
                            <form action="{{ route('students.destroy', $student->id) }}" method="post"
                                id="student-delete-{{ $student->id }}">
                                @csrf
                                @method('delete')
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <td colspan="6" class="alert alert-success">Record Not Found</td>
                    @endif
                </table>
            </div>
        </div>
        <div class="mt-3">
            {{ $students->links() }}
        </div>
    </div>
    <script>
        function deleteStudent(id) {
            if (confirm("Are you sure you want to delete?")) {
                document.getElementById('student-delete-' + id).submit();
            }
        }
    </script>
</body>

</html>