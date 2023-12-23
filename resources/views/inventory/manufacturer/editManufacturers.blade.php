@extends('admin.layouts/layout')
@section('content')
    <div class="heading">
        <div class="title">
            <p>Edit Manufacturers</p>
        </div>
        <div class="create-new">
            <a href="{{ route('show.products') }}"><button class="back"><- Back</button></a>
        </div>
    </div>
@endsection