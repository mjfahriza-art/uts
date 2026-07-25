@extends('layouts.sbadmin')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Edit Trainer</h1>
            <p class="text-muted">Perbarui informasi trainer.</p>
        </div>
        <a href="{{ route('trainers.index') }}" class="btn btn-secondary shadow-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <form action="{{ route('trainers.update', $trainer) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('trainers.form', ['trainer' => $trainer])
    </form>
@endsection

