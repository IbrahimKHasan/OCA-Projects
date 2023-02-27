@extends('admin.layout.master')
@section('title', 'Manage Companies')
@section('company-active', 'class=mm-active')
@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="col-lg-12">
                <div class="mb-4" style="width: 100%">
                    <form action="{{ route('admin.manage-companies.store') }}" method="post">
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
                @if ($companies[0] == null)
                    <h1 class="text-center">No Result</h1>
                @endif
                @if ($show_form)
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Add Company</h5>
                            @include('alerts.success')
                            <form method="POST" action="{{ route('admin.manage-companies.store') }}"
                                class="needs-validation" enctype="multipart/form-data" novalidate>
                                @csrf
                                <div class="form-row">
                                    <div class="col-lg-6 mb-3">
                                        <label for="validationCustom01">Company Name</label>
                                        <input type="hidden" name="type" value="add">
                                        <input name="company_name" type="text" class="form-control"
                                            id="validationCustom01" placeholder="Company Name" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="validationCustom01">Company Email</label>
                                        <input name="company_email" type="email" class="form-control"
                                            id="validationCustom01" placeholder="Company Email" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="validationCustom01">Company Phone</label>
                                        <input name="company_phone" type="number" class="form-control"
                                            id="validationCustom01" placeholder="Company phone" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom02">Location</label>
                                        <input name="company_location" type="text" class="form-control"
                                            id="validationCustom02" placeholder="Company Location" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="validationCustom02">Description</label>
                                        <textarea name="company_description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label for="validationCustom02">Bedroom Price</label>
                                        <input name="bedroom_price" type="number" class="form-control"
                                            id="validationCustom02" placeholder="Bedroom Price" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label for="validationCustom02">Livingroom Price</label>
                                        <input name="livingroom_price" type="number" class="form-control"
                                            id="validationCustom02" placeholder="Livingroom Price" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label for="validationCustom02">Guestroom Price</label>
                                        <input name="guestroom_price" type="number" class="form-control"
                                            id="validationCustom02" placeholder="Guestroom Price" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label for="validationCustom02">Kitchenroom Price</label>
                                        <input name="kitchen_price" type="number" class="form-control"
                                            id="validationCustom02" placeholder="Kitchenroom Price" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label for="validationCustom02">Km Price</label>
                                        <input name="km_price" type="number" class="form-control" id="validationCustom02"
                                            placeholder="Km Price" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label for="validationCustom02">Packing Price</label>
                                        <input name="pack_price" type="number" class="form-control"
                                            id="validationCustom02" placeholder="Packing Price" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom02">Image</label>
                                        <input name="company_image" type="file" class="form-control"
                                            id="validationCustom02" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Add Company</button>
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
            </div>
            @endif
            @foreach ($companies as $company)
                <div class="col-lg-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body table-responsive">
                            <h5 class="card-title">Company Information</h5>
                            <table class="mb-0 table table-striped company-table">
                                <tbody>
                                    <tr class="mb-4">
                                    <tr class="text-center">
                                        <form action="{{ route('admin.manage-companies.update', $company->company_id) }}"
                                            method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
                                            @csrf
                                            @method('PUT')
                                            <th>#</th>
                                            <th>{{ $company->company_id }}</th>
                                    </tr>
                                    <tr class="text-center">
                                        <th style="width: 10%">Company Name</th>
                                        <td>
                                            <span id={{ 'name-' . $company->company_id }}>{{ $company->company_name }}
                                            </span>
                                            <input style="display: none;width:70%;margin:auto" name="company_name"
                                                type="text" class="form-control"
                                                id={{ 'input-name-' . $company->company_id }} placeholder="Full name"
                                                value="{{ $company->company_name }}" required>
                                        </td>
                                    </tr>
                                    <tr class="text-center">
                                        <th>Company Email</th>
                                        <td>
                                            <span
                                                id={{ 'email-' . $company->company_id }}>{{ $company->company_email }}</span>
                                            <input style="display: none;width:70%;margin:auto" name="company_email"
                                                type="email" class="form-control"
                                                id={{ 'input-email-' . $company->company_id }} placeholder="Email"
                                                value="{{ $company->company_email }}" required>
                                        </td>
                                    </tr>
                                    <tr class="text-center">
                                        <th>Company Phone</th>
                                        <td>
                                            <span
                                                id={{ 'phone-' . $company->company_id }}>{{ $company->company_phone }}</span>
                                            <input style="display: none;width:70%;margin:auto" name="company_phone"
                                                type="text" class="form-control"
                                                id={{ 'input-name-' . $company->company_id }} placeholder="Phone"
                                                value="{{ $company->company_phone }}" required>
                                        </td>
                                    </tr>
                                    <tr class="text-center ">
                                        <th>Company Description</th>
                                        <td>
                                            <div id={{ 'desc-' . $company->company_id }}>
                                                {{ $company->company_description }}</div>
                                            <textarea style="display: none" name="company_description" class="form-control"
                                                id={{ 'input-desc-' . $company->company_id }} cols="90"
                                                placeholder="Description"
                                                required>{{ $company->company_description }}</textarea>
                                        </td>
                                    </tr>
                                    <tr class="text-center">
                                        <th>Company Location</th>
                                        <td>
                                            <span
                                                id={{ 'loc-' . $company->company_id }}>{{ $company->company_location }}</span>
                                            <input style="display: none;width:70%;margin:auto" name="company_location"
                                                type="text" class="form-control"
                                                id={{ 'input-loc-' . $company->company_id }} placeholder="Location"
                                                value="{{ $company->company_location }}" required>
                                        </td>
                                    </tr>
                                    <tr class="text-center">
                                        <th>Bedroom Price</th>
                                        <td>
                                            <span
                                                id={{ 'bed-' . $company->company_id }}>{{ $company->bedroom_price }}</span>
                                            <input style="display: none;width:70%;margin:auto" name="bedroom_price"
                                                type="number" class="form-control"
                                                id={{ 'input-bed-' . $company->company_id }} placeholder="Bedroom Price"
                                                value="{{ $company->bedroom_price }}" required>
                                        </td>
                                    </tr>
                                    <tr class="text-center">
                                        <th>Livingroom Price</th>
                                        <td>
                                            <span
                                                id={{ 'liv-' . $company->company_id }}>{{ $company->livingroom_price }}</span>
                                            <input style="display: none;width:70%;margin:auto" name="livingroom_price"
                                                type="number" class="form-control"
                                                id={{ 'input-liv-' . $company->company_id }}
                                                placeholder="Livingroom Price" value="{{ $company->livingroom_price }}"
                                                required>
                                        </td>
                                    </tr>
                                    <tr class="text-center">
                                        <th>Guestroom Price</th>
                                        <td>
                                            <span
                                                id={{ 'guest-' . $company->company_id }}>{{ $company->guestroom_price }}</span>
                                            <input style="display: none;width:70%;margin:auto" name="guestroom_price"
                                                type="number" class="form-control"
                                                id={{ 'input-guest-' . $company->company_id }}
                                                placeholder="Guestroom Price" value="{{ $company->guestroom_price }}"
                                                required>
                                        </td>
                                    </tr>
                                    <tr class="text-center">
                                        <th>Kitchen Price</th>
                                        <td>
                                            <span
                                                id={{ 'kit-' . $company->company_id }}>{{ $company->kitchen_price }}</span>
                                            <input style="display: none;width:70%;margin:auto" name="kitchen_price"
                                                type="number" class="form-control"
                                                id={{ 'input-kit-' . $company->company_id }} placeholder="Kitchen Price"
                                                value="{{ $company->kitchen_price }}" required>
                                        </td>
                                    </tr>
                                    <tr class="text-center">
                                        <th>Distance Price</th>
                                        <td>
                                            <span
                                                id={{ 'km-' . $company->company_id }}>{{ $company->km_price }}</span>
                                            <input style="display: none;width:70%;margin:auto" name="km_price" type="number"
                                                class="form-control" id={{ 'input-km-' . $company->company_id }}
                                                placeholder="Distance Price" value="{{ $company->km_price }}" required>
                                        </td>
                                    </tr>
                                    <tr class="text-center">
                                        <th>Packing Price</th>
                                        <td>
                                            <span
                                                id={{ 'pack-' . $company->company_id }}>{{ $company->pack_price }}</span>
                                            <input style="display: none;width:70%;margin:auto" name="pack_price"
                                                type="number" class="form-control"
                                                id={{ 'input-pack-' . $company->company_id }} placeholder="Pack Price"
                                                value="{{ $company->pack_price }}" required>
                                        </td>
                                    </tr>
                                    <tr class="text-center">
                                        <th>Image</th>
                                        <td>
                                            <img src="{{ asset('assets/images/companies/' . $company->company_image) }}"
                                                alt="" width="50px" height="50px">
                                            <input id={{ 'input-img-' . $company->company_id }} type="file"
                                                class="form-control" name="company_image"
                                                style="transform:scale(0.8);display:none">
                                        </td>
                                    </tr>
                                    <tr class="text-center">
                                        <th>Status</th>
                                        <td>
                                            <span
                                                class="badge @if ($company->status == 'Available') badge-success @endif @if ($company->status == 'Not Available') badge-danger @endif"
                                                id={{ 'status-' . $company->company_id }}>{{ $company->status }}</span>
                                            <select name="status" id={{ 'input-status-' . $company->company_id }}
                                                class="form-control" style="transform:scale(0.8);display:none">
                                                <option value="Available">Available</option>
                                                <option value="Not Available">Not Available</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr class="text-center">
                                        <th>Created At</th>
                                        <td>{{ $company->created_at }}</td>
                                    </tr>
                                    <tr class="text-center">
                                        <th>Edit/Delete</th>
                                        <td>
                                            <button id={{ 'btn-' . $company->company_id }} style="display: none"
                                                type="submit" class="btn btn-success">Save</button>
                                            <a style="display: none" class="btn btn-danger"
                                                id={{ 'btn2-' . $company->company_id }}
                                                href="{{ route('admin.manage-companies.index') }}">Cancel</a>
                                            </form>
                                            <button id={{ 'edit-' . $company->company_id }} onclick="edit(event)"
                                                value={{ $company->company_id }} class="btn btn-primary">Edit</button>
                                            <form id={{ 'del-' . $company->company_id }} style="display:inline"
                                                action="{{ route('admin.manage-companies.destroy', $company->company_id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="pagination-content table-responsive">
                {{ $companies->links('pagination::bootstrap-4') }}
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
            document.getElementById(`input-desc-${id}`).style.display = ''
            document.getElementById(`desc-${id}`).style.display = 'none'
            document.getElementById(`input-loc-${id}`).style.display = ''
            document.getElementById(`loc-${id}`).style.display = 'none'
            document.getElementById(`input-bed-${id}`).style.display = ''
            document.getElementById(`bed-${id}`).style.display = 'none'
            document.getElementById(`input-liv-${id}`).style.display = ''
            document.getElementById(`liv-${id}`).style.display = 'none'
            document.getElementById(`input-guest-${id}`).style.display = ''
            document.getElementById(`guest-${id}`).style.display = 'none'
            document.getElementById(`input-kit-${id}`).style.display = ''
            document.getElementById(`kit-${id}`).style.display = 'none'
            document.getElementById(`input-km-${id}`).style.display = ''
            document.getElementById(`km-${id}`).style.display = 'none'
            document.getElementById(`input-pack-${id}`).style.display = ''
            document.getElementById(`pack-${id}`).style.display = 'none'
            document.getElementById(`input-img-${id}`).style.display = ''
            document.getElementById(`status-${id}`).style.display = 'none'
            document.getElementById(`input-status-${id}`).style.display = ''
            // document.getElementById(`input-image-${id}`).style.display = 'block'
        }
    </script>
@endsection
