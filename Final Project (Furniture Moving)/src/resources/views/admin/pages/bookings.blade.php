@extends('admin.layout.master')
@section('title', 'Bookings')
@section('booking-active', 'class=mm-active')
@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="col-lg-12">
                <div class="mb-4" style="width: 100%">
                    <form action="{{ route('admin.booking.store') }}" method="post">
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
                        <h5 class="card-title">Reviews Table</h5>
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>User</th>
                                    @if (Auth::user()->role == 'admin')
                                        <th class="text-center">Company Name</th>
                                    @endif
                                    <th class="text-center">Phone</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="text-center text-muted">{{ $user->booking_id }}</td>
                                        <td style="width: 15%">
                                            <div class="widget-content p-0">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left mr-3">
                                                        <div class="widget-content-left">
                                                            <img width="40" class="rounded-circle"
                                                                src="{{ asset('assets/images/users/' . $user->image) }}"
                                                                alt="">
                                                        </div>
                                                    </div>
                                                    <div class="widget-content-left flex2">
                                                        <div class="widget-heading">{{ $user->name }}</div>
                                                        <div class="widget-subheading opacity-7">
                                                            {{ $user->email }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        @if (Auth::user()->role == 'admin')
                                            <td class="text-center">
                                                <a href="{{ route('company.show', $user->company_id) }}">{{ $user->company_name }}
                                                </a>
                                            </td>
                                        @endif
                                        <td class="text-center">
                                            {{ $user->phone }}
                                        </td>
                                        <td class="text-center">
                                            {{ $user->price }} JD
                                        </td>
                                        <td class="text-center">
                                            <form method="POST"
                                                action="{{ route('admin.booking.update', $user->booking_id) }}"
                                                enctype="multipart/form-data" novalidate>
                                                @csrf
                                                @method('PUT')
                                                <span
                                                    class="badge @if ($user->status == 'completed') badge-success @endif @if ($user->status == 'pending') badge-warning @endif @if ($user->status == 'in progress') badge-danger @endif"
                                                    id={{ 'status-' . $user->booking_id }}>{{ $user->status }}</span>
                                                <select name="status" id={{ 'input-status-' . $user->booking_id }}
                                                    class="form-control" style="transform:scale(0.8);display:none">
                                                    <option value="pending">Pending</option>
                                                    <option value="in progress">In Progress</option>
                                                    <option value="completed">Completed</option>
                                                </select>
                                                <input type="hidden" name="company_id" value={{ $user->company_id }}>
                                        </td>
                                        <td class="text-center">
                                            {{ $user->date }}
                                        </td>
                                        <td class="text-center">
                                            <button id={{ 'btn-' . $user->booking_id }} style="display: none"
                                                type="submit" class="btn btn-success">Save</button>
                                            </form>
                                            <a style="display: none" class="btn btn-danger"
                                                id={{ 'btn2-' . $user->booking_id }}
                                                href="{{ route('admin.index') }}">Cancel</a>
                                            <button id={{ 'edit-' . $user->booking_id }} onclick="edit(event)"
                                                value={{ $user->booking_id }} type="button"
                                                class="btn btn-primary">Edit</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if ($users != null)
                            @if ($users[0] == null)
                                <h1 class="text-center">No Result</h1>
                            @endif
                        @endif
                    </div>
                </div>
                @if ($users != null)
                    <div class="pagination-content table-responsive">
                        {{ $users->links('pagination::bootstrap-4') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <script>
        const edit = (event) => {
            id = event.target.value
            document.getElementById(`edit-${id}`).style.display = "none"
            document.getElementById(`btn-${id}`).style.display = "inline"
            document.getElementById(`btn2-${id}`).style.display = "inline"
            document.getElementById(`status-${id}`).style.display = 'none'
            document.getElementById(`input-status-${id}`).style.display = ''
        }
    </script>
@endsection
