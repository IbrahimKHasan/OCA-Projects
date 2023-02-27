@extends('admin.layout.master')
@section('title', 'Manage Contacts')
@section('contact-active', 'class=mm-active')
@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="col-lg-12">
                <div class="mb-4" style="width: 100%">
                    <form action="{{ route('admin.manage-contacts.store') }}" method="post">
                        @csrf
                        <div style="width: 40%;display:inline-block">
                            <input class="form-control" type="text" name="search" placeholder="Search">
                        </div>
                        <div style="display:inline-block">
                            <input class="btn btn-primary" type="submit" value="Search">
                        </div>
                    </form>
                </div>
                <div class="main-card mb-3 card">
                    <div class="card-body table-responsive">
                        @include('alerts.success')
                        <h5 class="card-title">Contacts Table</h5>
                        <table class="mb-0 table table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Message</th>
                                    <th>Date</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contacts as $contact)
                                    <tr class="text-center">
                                        <th>{{ $contact->id }}</th>
                                        <td>{{ $contact->contact_name }}</td>
                                        <td>{{ $contact->contact_email }}</td>
                                        <td>{{ $contact->contact_phone }}</td>
                                        <td>{{ $contact->contact_message }}</td>
                                        <td>{{ $contact->created_at }}</td>
                                        <td>
                                            <form style="display:inline"
                                                action="{{ route('admin.manage-contacts.destroy', $contact->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if ($contacts[0] == null)
                            <h1 class="text-center">No Result</h1>
                        @endif
                    </div>
                </div>
                <div class="pagination-content table-responsive">
                    {{ $contacts->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
