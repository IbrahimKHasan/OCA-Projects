@extends('public.layout.master')
@section('title', 'Furniture Moving - User')
@section('breadcrumb', 'User Profile')
@section('content')
    <section id="services" class="features-area mt-4">
        <div class="container">
            <div class="row gutters">
                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="account-settings">
                                <div class="user-profile">
                                    <img style="width: 40%;
                                                                                                                                                                                                                    margin: auto;
                                                                                                                                                                                                                     display: block;"
                                        src="{{ asset('assets/images/users/' . Auth::user()->image) }}"
                                        alt="Maxwell Admin">
                                    <h5 class="user-name text-center">{{ Auth::user()->name }}</h5>
                                    <h6 class="user-email text-center">{{ Auth::user()->email }}</h6>
                                    <br>
                                    <p style="font-size: smaller;font-weight:bolder;" class="text-center">Number of
                                        Bookings
                                        Taken: <span style="color:rgb(50, 214, 50)">{{ $count }}</span></p>
                                    <p style="font-size: smaller;font-weight:bolder;" class="text-center">Total Price:
                                        <span style="color:rgb(50, 214, 50)">{{ $price }} JD</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                    <div class="card h-100">
                        @include('alerts.success')
                        <div class="card-body">
                            <div class="row gutters">
                                <div class="col-12">
                                    <h6 class="mb-2 text-primary">Personal Details</h6>
                                </div>
                                <form enctype="multipart/form-data" action="{{ route('user.update', Auth::user()->id) }}"
                                    method="POST" class="col-12">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <label for="fullName">Name</label>
                                        <input type="text" name="name" class="form-control" id="fullName"
                                            value="{{ Auth::user()->name }}" placeholder="Enter full name">
                                    </div>
                                    <br>
                                    <div class="col-12">
                                        <label for="eMail">Email</label>
                                        <input type="email" name="email" class="form-control" id="eMail"
                                            value="{{ Auth::user()->email }}" placeholder="Enter email ID">
                                    </div>
                                    <br>
                                    <div class="col-12 mb-3">
                                        <label for="website">Password</label>
                                        <input type="password" name="password" class="form-control" id="website" value=""
                                            placeholder="password">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="image">Profile Picture</label>
                                        <input type="file" name="image" class="form-control" id="image" value=""
                                            placeholder="password">
                                    </div>
                                    <div class="text-left">
                                        <button type="submit" id="submit" name="edit_btn"
                                            class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                            <br>

                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="main-card mb-3 card">
                <div class="card-body table-responsive">
                    <h1 class="text-center">My Bookings</h1>
                    <br>
                    <table class="table" style="overflow-x: scroll">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Company Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Date</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $item)
                                <tr style="text-align: center">
                                    <td>{{ $item->booking_id }}</td>
                                    <td>{{ Auth::user()->name }}</td>
                                    <td>{{ Auth::user()->email }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td><a
                                            href="{{ route('company.show', $item->company_id) }}">{{ $item->company_name }}</a>
                                    </td>
                                    <td>{{ $item->price }} JD</td>
                                    <td>{{ $item->date }}</td>
                                    <td>
                                        <span
                                            class="text-white p-1 @if ($item->booking_status == 'completed') bg-success @endif @if ($item->booking_status == 'pending') bg-warning @endif  @if ($item->booking_status == 'in progress') bg-danger @endif">{{ $item->booking_status }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="main-card mb-3 card">
                <div class="card-body table-responsive">
                    <h1 class="text-center">My Reviews</h1>
                    <br>
                    <table class="table mb-5">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">#</th>
                                <th scope="col">Company Name</th>
                                <th scope="col">Review Body</th>
                                <th scope="col">Review Rate</th>
                                <th scope="col">Created at</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reviews as $review)
                                <tr style="text-align: center">
                                    <td>{{ $review->review_id }}</td>
                                    <td><a
                                            href="{{ route('company.show', $review->company_id) }}">{{ $review->company_name }}</a>
                                    </td>
                                    <td>{{ $review->review_body }}</td>
                                    <td>{{ $review->review_rate }}</td>
                                    <td>{{ $review->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
    </section>



@endsection
