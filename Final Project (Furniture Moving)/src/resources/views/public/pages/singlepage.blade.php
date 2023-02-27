@extends('public.layout.master')
@section('title', 'Furniture Moving - Company')
@section('none', 'none')
@section('content')
    <div class="breadcrumb-container" style="" aria-label="breadcrumb">
        <h2 class="breadcrumb-heading">{{ $company->company_name }} Company</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $company->company_name }} Company</li>
        </ol>
    </div>
    @include('sweetalert::alert')
    <section class="company-section">
        <div class="row">
            <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12">
                <h1 class="d-inline-block">{{ $company->company_name }}</h1>
                <div class="d-flex flex-row">
                    <div class="ratings mr-2">
                        {{-- <span class="fw-bold">{{ round($rate, 1) }}</span> --}}
                        <span class="fw-bold">({{ round($company->company_rate, 1) }})</span>
                        @for ($i = 1; $i <= ceil($company->company_rate); $i++)
                            <i class="fa fa-star"></i>
                        @endfor
                        <small class="fw-light">({{ $company->company_rate_count }})</small>
                    </div><span></span>
                </div>
                {{-- <small>No. of Bookings: {{ $company->company_bookings_count }}</small> --}}
                <?php $count = ('App\Models\CompanyUser')::where('company_id', $company->company_id)->count(); ?>
                <small>No. of Bookings: {{ $company->company_bookings_count }}</small>
                <h6
                    class="@if ($company->status == 'Not Available') text-danger @endif fw-bold  @if ($company->status == 'Available') text-success @endif">
                    {{ $company->status }}</h6>

                <img width='100%' class="mb-3"
                    src="{{ asset('assets/images/companies/' . $company->company_image) }}" alt="">
                <h2>Description</h2>
                <p>{{ $company->company_description }}</p>
                <p class="fw-bold">Email: {{ $company->company_email }}</p>
                <p class="fw-bold">Phone: {{ $company->company_phone }}</p>
                <p class="fw-bold">Location: {{ $company->company_location }}</p>
                <h4 class='text-decoration-underline'>Not Available Dates</h4>
                @foreach ($not_available_time as $time)
                    <li style="color:red;font-weight:bold">{{ $time->date }}</li>
                @endforeach
                <h4 class="mt-3 text-decoration-underline">Pricing</h4>
                <li><span class="fw-bold"> Bedroom Price:</span> {{ $company->bedroom_price }} JD
                </li>
                <li><span class="fw-bold"> Livingroom Price:</span> {{ $company->livingroom_price }} JD</li>
                <li><span class="fw-bold"> Guestroom Price:</span> {{ $company->guestroom_price }} JD</li>
                <li><span class="fw-bold"> Kitchen Price:</span> {{ $company->kitchen_price }} JD</li>
                <li><span class="fw-bold"> Pack Price:</span> {{ $company->pack_price }} JD</li>
                <li><span class="fw-bold"> Distance/Km Price:</span> {{ $company->km_price }} JD</li>
            </div>
            <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 mt-4">
                <h2>Booking</h2>
                <div class="card">
                    @include('alerts.success')
                    <div class="card-body">
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mb-2 text-primary">Personal Details</h6>
                            </div>
                            <form id="booking" action="{{ route('company.store') }}" enctype="multipart/form-data"
                                action="" method="POST">
                                @csrf
                                <div class="form-row">
                                    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12">
                                        <label for="fullName">Name</label>
                                        <input type="text" name="name" class="form-control" id="fullName" value=""
                                            placeholder="Enter full name">
                                    </div>
                                    <br>
                                    <div class="col-xl-12 col-lg-12 col-md-8 col-sm-6 col-12">
                                        <label for="eMail">Email</label>
                                        <input type="email" name="email" class="form-control" id="eMail" value=""
                                            placeholder="Enter email ID">
                                    </div>
                                    <br>
                                    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12 mb-4">
                                        <label for="website">Phone</label>
                                        <input type="number" name="phone" class="form-control" id="website" value=""
                                            placeholder="phone" required>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12 mb-4">
                                        <label for="website">Date</label>
                                        <input type="date" name="date" class="datepicker form-control" id="date" value=""
                                            placeholder="phone" required>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 d-inline-block mb-3">
                                        <label for="validationCustom02">Bedroom No.</label>
                                        <input name="bedroom_no" type="number" class="form-control" id="bedroom_no"
                                            placeholder="" required>
                                        <input type="hidden" id="bedroom_price" name="bedroom_price"
                                            value={{ $company->bedroom_price }}>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 d-inline-block mb-3">
                                        <label for="validationCustom02">Livingroom No.</label>
                                        <input name="livingroom_no" type="number" class="form-control" id="livingroom_no"
                                            placeholder="" required>
                                        <input type="hidden" name="livingroom_price" id="livingroom_price"
                                            value={{ $company->livingroom_price }}>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 d-inline-block mb-3">
                                        <label for="validationCustom02">Guestroom No.</label>
                                        <input name="guestroom_no" type="number" class="form-control" id="guestroom_no"
                                            placeholder="" required>
                                        <input type="hidden" name="guestroom_price" id="guestroom_price"
                                            value={{ $company->guestroom_price }}>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 d-inline-block mb-3">
                                        <label for="validationCustom02">Kitchenroom No.</label>
                                        <input name="kitchen_no" type="number" class="form-control" id="kitchen_no"
                                            placeholder="" required>
                                        <input type="hidden" name="kitchen_price" id="kitchen_price"
                                            value={{ $company->kitchen_price }}>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 d-inline-block mb-3">
                                        <label for="validationCustom02">Distance/Km</label>
                                        <input name="km_no" type="number" class="form-control" id="km_no" placeholder=""
                                            required>
                                        <input type="hidden" id="km_price" name="km_price"
                                            value={{ $company->km_price }}>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 d-inline-block mb-3">
                                        <label for="validationCustom02">Packing</label>
                                        <input type="hidden" name="pack_price" value={{ $company->pack_price }}
                                            id="pack_price">
                                        <select class="form-control" name="packing" id="packing">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="company_id" value={{ $company->company_id }}>
                                <div class="text-left mb-0">
                                    <button type="button" id="check" name="edit_btn" class="btn btn-danger">Check
                                        Price</button>
                                    @if (Auth::user() != null)
                                        <button type="submit" id="submit" name="edit_btn"
                                            class="btn btn-primary">Book</button>
                                    @endif
                                    @if (Auth::user() == null)
                                        <br><small><a href="/login">Login</a> or <a href="/register">Signup</a> to
                                            Book</small>
                                    @endif
                                </div>
                            </form>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row mt-4">
            <h2>Reviews</h2>
            <div class="ui comments review-width">
                @foreach ($reviews as $review)
                    <div class="comment rounded shadow p-3 mb-4">
                        <a class="avatar">
                            <img src="{{ asset('assets/images/users/' . $review->image) }}">
                        </a>
                        <div class="content">
                            <a class="author">{{ $review->name }}</a>
                            <div class="metadata">
                                <span class="date">{{ $review->created_at }}</span>
                            </div>
                            <br><small class="ratings mr-2">
                                <span class="fw-bold">({{ $review->review_rate }})</span>
                                @for ($i = 1; $i <= $review->review_rate; $i++)
                                    <i class="fa fa-star"></i>
                                @endfor
                            </small><span></span>
                            <div class="text">
                                {{ $review->review_body }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <h2>Add Review</h2>
            <form action="{{ route('review.store') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="rate">
                    <input type="radio" id="star5" name="rate" value="5" required />
                    <label for="star5" title="text">5 stars</label>
                    <input type="radio" id="star4" name="rate" value="4" required />
                    <label for="star4" title="text">4 stars</label>
                    <input type="radio" id="star3" name="rate" value="3" required />
                    <label for="star3" title="text">3 stars</label>
                    <input type="radio" id="star2" name="rate" value="2" required />
                    <label for="star2" title="text">2 stars</label>
                    <input type="radio" id="star1" name="rate" value="1" required />
                    <label for="star1" title="text">1 star</label>
                </div>
                <input name="company_id" type="hidden" value={{ $company->company_id }}>
                <textarea class="form-control" name="review_body" id="" cols="30" rows="5" required></textarea>
                @if (Auth::user() != null)
                    @if ($check == 'yes')
                        <button type="submit" id="submit" name="review_botton" class="btn btn-primary mt-2 ms-auto">Add
                            Review</button>
                    @endif
                    @if ($check == 'no booking')
                        <br>
                        <p style="color: red;font-weight:bold;font-size:large">You Can't Add Review Without Booking</p>
                    @endif
                    @if ($check == 'no')
                        <br>
                        <p style="color: red;font-weight:bold;font-size:large">Each user has only one review</p>
                    @endif
                @endif
                @if (Auth::user() == null)
                    <br>
                    <p><a href="/login">Login</a> or <a href="/register">Signup</a> to
                        Add Review</p>
                @endif
            </form>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(function() {
            var dtToday = new Date();
            var month = dtToday.getMonth() + 1;
            var day = dtToday.getDate();
            var year = dtToday.getFullYear();
            if (month < 10) month = "0" + month.toString();
            if (day < 10) day = "0" + day.toString();
            var maxDate = year + "-" + month + "-" + day;
            $("#date").attr("min", maxDate);
        });
        document.getElementById('check').onclick = () => {
            var bedroom_price = document.getElementById('bedroom_no').value * document.getElementById('bedroom_price')
                .value;
            var livingroom_price = document.getElementById('livingroom_no').value * document.getElementById(
                'livingroom_price').value;
            var guestroom_price = document.getElementById('guestroom_no').value * document.getElementById(
                'guestroom_price').value;
            var kitchen_price = document.getElementById('kitchen_no').value * document.getElementById('kitchen_price')
                .value;
            var km_price = document.getElementById('km_no').value * document.getElementById('km_price').value;
            console.log(document.getElementById('packing').value)

            if (document.getElementById('packing').value == "yes") {
                var pack_price = document.getElementById('pack_price').value
            } else {
                var pack_price = 0;
            }
            var price = bedroom_price + livingroom_price + guestroom_price + kitchen_price + km_price + +pack_price
            Swal.fire({
                icon: 'info',
                title: 'Check Price',
                text: `The Total Price is: ${price} JD`,
            })
        }
    </script>
@endsection
