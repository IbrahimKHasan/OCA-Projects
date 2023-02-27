@extends('admin.layout.master')
@section('title', 'Main Dashboard')
@section('dash-active', 'class=mm-active')
@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="row">
                    <div class="col-md-6 col-xl-3">
                        <div class="card mb-3 widget-content bg-midnight-bloom">
                            <div class="widget-content-wrapper text-white">
                                <div class="widget-content-left">
                                    <div class="widget-heading">Total Users</div>
                                </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-white"><span>{{ $nousers }}</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        <div class="card mb-3 widget-content bg-midnight-bloom">
                            <div class="widget-content-wrapper text-white">
                                <div class="widget-content-left">
                                    <div class="widget-heading">Total Owners</div>
                                </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-white"><span>{{ $noowners }}</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        <div class="card mb-3 widget-content bg-arielle-smile">
                            <div class="widget-content-wrapper text-white">
                                <div class="widget-content-left">
                                    <div class="widget-heading">Total Bookings</div>
                                </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-white"><span>{{ $nobookings }}</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        <div class="card mb-3 widget-content bg-grow-early">
                            <div class="widget-content-wrapper text-white">
                                <div class="widget-content-left">
                                    <div class="widget-heading">Total Revenue (JD)</div>
                                </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-white"><span>{{ $revenue }}</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">
                            @include('alerts.success')
                            <div class="card-header">Latest Users Bookings
                            </div>
                            <div class="table-responsive">
                                <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>User</th>
                                            @if (Auth::user()->role == 'admin')
                                                <th class="text-center">Company</th>
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
                                                        <select name="status"
                                                            id={{ 'input-status-' . $user->booking_id }}
                                                            class="form-control"
                                                            style="transform:scale(0.8);display:none">
                                                            <option value="pending">Pending</option>
                                                            <option value="in progress">In Progress</option>
                                                            <option value="completed">Completed</option>
                                                        </select>
                                                        <input type="hidden" name="company_id"
                                                            value={{ $user->company_id }}>
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
                            </div>
                        </div>
                    </div>
                </div>
                @if ($owners_display)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="main-card mb-3 card">
                                <div class="card-header">Latest Owners Table
                                </div>
                                <div class="table-responsive">
                                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>User</th>
                                                <th class="text-center">Company</th>
                                                <th class="text-center">Phone</th>
                                                <th class="text-center">Role</th>
                                                <th class="text-center">Created At</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($owners as $owner)
                                                <tr>
                                                    <td class="text-center text-muted">{{ $owner->id }}</td>
                                                    <td style="width: 15%">
                                                        <div class="widget-content p-0">
                                                            <div class="widget-content-wrapper">
                                                                <div class="widget-content-left mr-3">
                                                                    <div class="widget-content-left">
                                                                        <img width="40" class="rounded-circle"
                                                                            src="{{ asset('assets/images/users/' . $owner->image) }}"
                                                                            alt="">
                                                                    </div>
                                                                </div>
                                                                <div class="widget-content-left flex2">
                                                                    <div class="widget-heading">{{ $owner->name }}
                                                                    </div>
                                                                    <div class="widget-subheading opacity-7">
                                                                        {{ $owner->email }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ route('company.show', $owner->company_id) }}">{{ $owner->company_name }}
                                                        </a>
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $owner->phone }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $owner->role }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $owner->created_at }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">
                            <div class="card-header">Latest Users Reviews
                            </div>
                            <div class="table-responsive">
                                <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>User</th>
                                            <th class="text-center">Company</th>
                                            <th class="text-center">Review Body</th>
                                            <th class="text-center">Rate</th>
                                            <th class="text-center">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reviews as $review)
                                            <tr>
                                                <td class="text-center text-muted">{{ $review->review_id }}</td>
                                                <td style="width: 15%">
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left mr-3">
                                                                <div class="widget-content-left">
                                                                    <img width="40" class="rounded-circle"
                                                                        src="{{ asset('assets/images/users/' . $review->image) }}"
                                                                        alt="">
                                                                </div>
                                                            </div>
                                                            <div class="widget-content-left flex2">
                                                                <div class="widget-heading">{{ $review->name }}
                                                                </div>
                                                                <div class="widget-subheading opacity-7">
                                                                    {{ $review->email }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('company.show', $review->company_id) }}">{{ $review->company_name }}
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    {{ $review->review_body }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $review->review_rate }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $review->created_at }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
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
    </div>
@endsection
