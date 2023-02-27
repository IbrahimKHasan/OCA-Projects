@extends('public.layout.master')
@section('title', 'Furniture Moving - Companies')
@section('breadcrumb', 'Companies')
@section('content')
    <section class="content-section">
        <div class="container mt-1 mb-5">
            <div class="d-flex justify-content-center row">
                <div class="col-md-10">
                    <div class="mb-4" style="width: 100%">
                        <form action="{{ route('companies.store') }}" method="post">
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
                    <div class="mb-4" style="width: 100%">
                        <form action="{{ route('companies.store') }}" method="post">
                            @csrf
                            <div style="width: 40%;display:inline-block">
                                <input type="hidden" name="type" value="filter">
                                <select class="form-control" name="filter" id="">
                                    <option value="high">Highest rate , Available</option>
                                    <option value="low">Lowest Rate , Available</option>
                                </select>
                            </div>
                            <div style="display:inline-block">
                                <input class="btn btn-primary" type="submit" value="Filter">
                            </div>
                        </form>
                    </div>
                    @if ($companies[0] == null)
                        <h1 class="text-center no-result" style="margin-bottom:80px">No Result</h1>
                    @endif
                    @foreach ($companies as $company)
                        <div class="row p-2 bg-white border rounded shadow-lg  mb-5 ">
                            <div class="col-md-3 mt-1"><a style="color:white;text-decoration:none"
                                    href="{{ route('company.show', $company->company_id) }}"><img
                                        class="img-fluid img-responsive rounded product-image"
                                        src="{{ asset('assets/images/companies/' . $company->company_image) }}"></a></div>
                            <div class="col-md-6 mt-1">
                                <h2 class="fw-bold">{{ $company->company_name }}</h2>
                                <div class="d-flex flex-row">
                                    <div class="ratings mr-2">
                                        <?php $rate = ('App\Models\Review')::where('company_id', $company->company_id)->avg('review_rate'); ?>
                                        {{-- <span class="fw-bold">({{ round($rate, 1) }})</span> --}}
                                        <span class="fw-bold">({{ round($company->company_rate, 1) }})</span>
                                        @for ($i = 1; $i <= ceil($company->company_rate); $i++)
                                            <i class="fa fa-star"></i>
                                        @endfor
                                        <?php $rate_count = ('App\Models\Review')::where('company_id', $company->company_id)->count(); ?>
                                        <small class="fw-light">({{ $company->company_rate_count }})</small>
                                    </div><span></span>
                                </div>
                                {{-- <small>No. of Bookings: {{ $company->company_bookings_count }}</small> --}}
                                <?php $count = ('App\Models\CompanyUser')::where('company_id', $company->company_id)->count(); ?>
                                <small>No. of Bookings: {{ $company->company_bookings_count }}</small>
                                <div class="mt-1 mb-1 spec-1"><span>Bedroom: {{ $company->bedroom_price }}
                                        JD</span><span class="dot"></span><span>Livingroom:
                                        {{ $company->livingroom_price }}
                                        JD</span><span class="dot"></span><span>Guestroom:
                                        {{ $company->guestroom_price }} JD<br></span>
                                </div>
                                <div class="mt-1 mb-1 spec-1"><span>Kitchen: {{ $company->kitchen_price }}
                                        JD</span><span class="dot"></span><span>Packing:
                                        {{ $company->pack_price }}
                                        JD</span><span class="dot"></span><span>Per Km:
                                        {{ $company->km_price }} JD<br></span>
                                    </span><span class="fw-bold">Location:
                                        {{ $company->company_location }}</span>
                                </div>
                                <p class="text-justify text-truncate para mb-0">
                                    {{ $company->company_description }}<br><br>
                                </p>
                            </div>
                            <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                                {{-- <div class="d-flex flex-row align-items-center">
                                    <h4 class="mr-1">$13.99</h4><span class="strike-text">$20.99</span>
                                </div> --}}
                                <h6
                                    class="@if ($company->status == 'Not Available') text-danger text-center @endif fw-bold text-center text-center @if ($company->status == 'Available') text-success @endif">
                                    {{ $company->status }}</h6>
                                <div class="d-flex flex-column mt-4">
                                    <button class="btn btn-primary btn-sm" type="button"><a
                                            style="color:white;text-decoration:none"
                                            href="{{ route('company.show', $company->company_id) }}">Details</a></button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="pagination-content table-responsive">
                        {{ $companies->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
