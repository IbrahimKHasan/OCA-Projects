@extends('public.layout.master')
@section('title', 'Furniture Moving - Contact Us')
@section('breadcrumb', 'Contact Us')
@section('content')
    <section class="content-section">
        <h1>Contact Us</h1>
        @include('sweetalert::alert')
        <div class="row gutters">
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="account-settings">
                            <div class="user-profile">
                                <img style="width: 100%" src="{{ asset('assets/images/main.jpg') }}" alt="Maxwell Admin">
                                <div class="contact-info mt-4">
                                    <i class="fas fa-user"></i><span class="pers-info-margin-1"> Furniture
                                        Moving</span><br><br>
                                    <i class="fas fa-map-marker-alt"></i><span class="pers-info-margin-1"> Amman,
                                        Jordan</span><br><br>
                                    <i class="fas fa-envelope"></i></i><span class="pers-info-margin-2">
                                        info@furniture-moving.com</span><br><br>
                                    <i class="fa-solid fa-globe"></i><span class="pers-info-margin-2">
                                        www.furniture-moving.com</span><br><br>
                                    <i class="fas fa-phone-square-alt"></i><span class="pers-info-margin-2">
                                        0788888888</span>
                                </div>
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
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mb-2 text-primary">Contact Us</h6>
                            </div>
                            <form enctype="multipart/form-data" action="{{ route('contact.store') }}" method="POST"
                                class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12">
                                @csrf
                                <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12">
                                    <label for="fullName">Name</label>
                                    <input type="text" name="contact_name" class="form-control" id="fullName"
                                        value="@if (Auth::user() != null) {{ Auth::user()->name }} @endif"
                                        placeholder="Enter full name">
                                </div>
                                <br>
                                <div class="col-xl-12 col-lg-12 col-md-8 col-sm-6 col-12">
                                    <label for="eMail">Email</label>
                                    <input type="email" name="contact_email" class="form-control" id="eMail"
                                        value="@if (Auth::user() != null) {{ Auth::user()->email }} @endif"
                                        placeholder="Enter email ID">
                                </div>
                                <br>
                                <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12 mb-3">
                                    <label for="website">Phone</label>
                                    <input type="number" name="contact_phone" class="form-control" id="website" value=''
                                        placeholder="phone">
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12 mb-3">
                                    <label for="image">Message</label>
                                    <textarea class="form-control" name="contact_message" id="" cols="30"
                                        rows="5"></textarea>
                                </div>
                                <div class="text-left">
                                    <button type="submit" id="submit" name="edit_btn" class="btn btn-primary">Send</button>
                                </div>
                            </form>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
        <h1>Location</h1>
        <img style="width: 80%" src="{{ asset('assets/images/map.jpg') }}" alt="Maxwell Admin">
    </section>
@endsection
