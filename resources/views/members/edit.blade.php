@extends('layouts.sbadmin')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Edit Member</h1>
            <p class="text-muted">Perbarui informasi member trainer.</p>
        </div>
        <a href="{{ route('members.index') }}" class="btn btn-secondary shadow-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <form action="{{ route('members.update', $member) }}" method="POST">
        @csrf
        @method('PUT')
        @include('members.form', ['member' => $member, 'gyms' => $gyms])
    </form>
@endsection

