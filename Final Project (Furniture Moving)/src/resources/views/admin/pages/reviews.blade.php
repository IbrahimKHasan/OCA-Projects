@extends('admin.layout.master')
@section('title', 'Manage Reviews')
@section('review-active', 'class=mm-active')
@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="col-lg-12">
                <div class="mb-4" style="width: 100%">
                    <form action="{{ route('admin.manage-reviews.store') }}" method="post">
                        @csrf
                        <div style="width: 40%;display:inline-block">
                            <input class="form-control" type="text" name="search" placeholder="Search">
                            <input class="form-control" type="hidden" name="type" value="search" placeholder="Search">
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
                        <table class="mb-0 table table-striped">
                            <thead>
                                <tr class="text-center">
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
                        @if ($reviews != null)
                            @if ($reviews[0] == null)
                                <h1 class="text-center">No Result</h1>
                            @endif
                        @endif
                    </div>
                </div>
                @if ($reviews != null)
                    <div class="pagination-content table-responsive">
                        {{ $reviews->links('pagination::bootstrap-4') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
