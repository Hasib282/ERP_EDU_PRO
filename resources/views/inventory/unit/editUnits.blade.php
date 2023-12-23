@extends('admin.layouts/layout')
@section('content')
    <div class="heading">
        <div class="title">
            <p>Edit Units</p>
        </div>
        <div class="create-new">
            <a href="{{ route('show.units') }}"><button class="back"><- Back</button></a>
        </div>
    </div>
@endsection