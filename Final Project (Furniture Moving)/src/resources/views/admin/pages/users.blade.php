@extends('admin.layout.master')
@section('title', 'Manage Users')
@section('user-active', 'class=mm-active')
@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="col-lg-12">
                <div class="mb-4" style="width: 100%">
                    <form action="{{ route('admin.manage-users.store') }}" method="post">
                        @csrf
                        <div style="width: 40%;display:inline-block">
                            <input type="hidden" name="type" value="search">
                            <input class="form-control" type="text" name="search" placeholder="Search">
                        </div>
                        <div style="display:inline-block">
                            <input class="btn btn-primary" type="submit" value="Search">
                        </div>
                    </form>
                </div>
                @if ($show_form)
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Add User</h5>
                            @include('alerts.success')
                            <form method="POST" action="{{ route('admin.manage-users.store') }}" class="needs-validation"
                                enctype="multipart/form-data" novalidate>
                                @csrf
                                <div class="form-row">
                                    <div class="col-lg-6 mb-3">
                                        <label for="validationCustom01">Full name</label>
                                        <input type="hidden" name="type" value="add">
                                        <input name="name" type="text" class="form-control" id="validationCustom01"
                                            placeholder="Full name" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom02">Role</label>
                                        <select name="role" id="" required placeholder="Role"
                                            class="form-control form-select">
                                            <option value="user">User</option>
                                            <option value="admin">Admin</option>
                                            <option value="owner">Owner</option>
                                        </select>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom02">Email</label>
                                        <input name="email" type="email" class="form-control" id="validationCustom02"
                                            placeholder="Email Address" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom02">Phone</label>
                                        <input name="phone" type="number" class="form-control" id="validationCustom02"
                                            placeholder="Phone Number" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom02">Password</label>
                                        <input name="password" type="password" class="form-control"
                                            id="validationCustom02" placeholder="Password" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom02">Image</label>
                                        <input name="image" type="file" class="form-control" id="validationCustom02">
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Add User</button>
                            </form>
                            <script>
                                // Example starter JavaScript for disabling form submissions if there are invalid fields
                                (function() {
                                    'use strict';
                                    window.addEventListener('load', function() {
                                        // Fetch all the forms we want to apply custom Bootstrap validation styles to
                                        var forms = document.getElementsByClassName('needs-validation');
                                        // Loop over them and prevent submission
                                        var validation = Array.prototype.filter.call(forms, function(form) {
                                            form.addEventListener('submit', function(event) {
                                                if (form.checkValidity() === false) {
                                                    event.preventDefault();
                                                    event.stopPropagation();
                                                }
                                                form.classList.add('was-validated');
                                            }, false);
                                        });
                                    }, false);
                                })();
                            </script>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-lg-12">
                <div class="main-card mb-3 card">
                    <div class="card-body table-responsive">
                        <h5 class="card-title">Users Table</h5>
                        <table class="mb-0 table table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Full Name</th>
                                    <th>Role</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Image</th>
                                    <th>Created At</th>
                                    <th>Edit/Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr class="text-center">
                                        <form action="{{ route('admin.manage-users.update', $user->id) }}" method="POST"
                                            class="needs-validation" novalidate>
                                            @csrf
                                            @method('PUT')
                                            <th>{{ $user->id }}</th>
                                            <td>
                                                <span id={{ 'name-' . $user->id }}>{{ $user->name }}</span>
                                                <input style="display: none;width:70%;margin:auto" name="name" type="text"
                                                    class="form-control" id={{ 'input-name-' . $user->id }}
                                                    placeholder="Full name" value="{{ $user->name }}" required>
                                            </td>
                                            <td>
                                                <span id={{ 'role-' . $user->id }}>{{ $user->role }}</span>
                                                <input style="display: none;width:70%;margin:auto" name="role" type="text"
                                                    class="form-control" id={{ 'input-role-' . $user->id }}
                                                    placeholder="Role" value="{{ $user->role }}" required>
                                            </td>
                                            <td>
                                                <span id={{ 'email-' . $user->id }}>{{ $user->email }}</span>
                                                <input style="display: none;width:70%;margin:auto" name="email" type="email"
                                                    class="form-control" id={{ 'input-email-' . $user->id }}
                                                    placeholder="Email" value="{{ $user->email }}" required>
                                            </td>
                                            <td>
                                                <span id={{ 'phone-' . $user->id }}>{{ $user->phone }}</span>
                                                <input style="display: none;width:70%;margin:auto" name="phone"
                                                    type="number" class="form-control"
                                                    id={{ 'input-phone-' . $user->id }} placeholder="Phone"
                                                    value="{{ $user->phone }}" required>
                                            </td>
                                            <td>
                                                <img src="{{ asset('assets/images/users/' . $user->image) }}" alt=""
                                                    width="100px" height="100px">
                                            </td>
                                            <td>{{ $user->created_at }}</td>
                                            <td>
                                                <button id={{ 'btn-' . $user->id }} style="display: none" type="submit"
                                                    class="btn btn-success">Save</button>
                                                <a style="display: none" class="btn btn-danger"
                                                    id={{ 'btn2-' . $user->id }}
                                                    href="{{ route('admin.manage-users.index') }}">Cancel</a>
                                        </form>
                                        <button id={{ 'edit-' . $user->id }} onclick="edit(event)"
                                            value={{ $user->id }} class="btn btn-primary">Edit</button>
                                        <form id={{ 'del-' . $user->id }} style="display:inline"
                                            action="{{ route('admin.manage-users.destroy', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if ($users[0] == null)
                            <h1 class="text-center">No Result</h1>
                        @endif
                    </div>
                </div>
                <div class="pagination-content table-responsive">
                    {{ $users->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
    <script>
        const edit = (event) => {
            id = event.target.value
            document.getElementById(`edit-${id}`).style.display = "none"
            document.getElementById(`del-${id}`).style.display = "none"
            document.getElementById(`btn-${id}`).style.display = "inline"
            document.getElementById(`btn2-${id}`).style.display = "inline"
            document.getElementById(`input-name-${id}`).style.display = ''
            document.getElementById(`name-${id}`).style.display = 'none'
            document.getElementById(`input-role-${id}`).style.display = ''
            document.getElementById(`role-${id}`).style.display = 'none'
            document.getElementById(`input-email-${id}`).style.display = ''
            document.getElementById(`email-${id}`).style.display = 'none'
            document.getElementById(`input-phone-${id}`).style.display = ''
            document.getElementById(`phone-${id}`).style.display = 'none'
            // document.getElementById(`input-image-${id}`).style.display = 'block'
        }
    </script>
@endsection
