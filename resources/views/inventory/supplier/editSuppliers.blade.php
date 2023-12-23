@extends('admin.layouts/layout')

@section('content')
    <div class="heading">
        <div class="title">
            <p>Edit Suppliers</p>
        </div>
        <div class="create-new">
            <a href="{{ route('show.suppliers') }}"><button class="back"><- Back</button></a>
        </div>
    </div>
@endsection