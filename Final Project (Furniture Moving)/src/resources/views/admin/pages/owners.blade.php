@extends('admin.layout.master')
@section('title', 'Owners')
@section('owner-active', 'class=mm-active')
@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="col-lg-12">
                <div class="mb-4" style="width: 100%">
                    <form action="{{ route('admin.owners.store') }}" method="post">
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
                <div class="col-lg-12">
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
                    <div class="pagination-content table-responsive">
                        {{ $owners->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    @endsection
