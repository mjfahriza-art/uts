@extends('layouts.sbadmin')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Gym Dashboard</h1>
            <p class="text-muted">Lihat statistik, atau langsung kelola member dari sini.</p>
        </div>
        <div class="d-flex gap-2 align-items-center">
            <a href="{{ route('members.index') }}" class="btn btn-sm btn-success">
                <i class="fas fa-users"></i> Kelola Member
            </a>
            <a href="{{ url('/') }}" class="btn btn-sm btn-primary">Back to Welcome</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Gyms</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $gyms->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-building fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Members</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $members->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Memberships</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $memberships->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-id-card fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Gyms</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Members</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($gyms as $gym)
                                    <tr>
                                        <td>{{ $gym->name }}</td>
                                        <td>{{ $gym->address }}</td>
                                        <td>{{ $gym->members_count }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success">Last Memberships</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Member</th>
                                    <th>Gym</th>
                                    <th>Package</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($memberships->take(8) as $membership)
                                    <tr>
                                        <td>{{ $membership->member->name }}</td>
                                        <td>{{ $membership->gym->name }}</td>
                                        <td>{{ $membership->package }}</td>
                                        <td>{{ ucfirst($membership->status) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
