@extends('layout.index')

@section('content')
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor">Member</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item">Member</li>
            <li class="breadcrumb-item active">Detail Member</li>
        </ol>
    </div>
</div>

<div class="row">
    <!-- Column -->
    <div class="col-lg-8 col-xlg-9 col-md-7">
        <div class="card">
            <div class="card-body">
                <center class="m-t-30"> <img src="{{url('assets/images/users/5.jpg')}}" class="img-circle"
                        width="150" />
                    <h4 class="card-title m-t-10">{{ $member->name }}</h4>
                </center>
            </div>
            <div>
                <hr>
            </div>
            <div class="card-body">
                <small class="text-muted">Email address </small>
                <h6>{{ $member->email }}</h6> <small class="text-muted p-t-30 db">Phone</small>
                <h6>{{ $member->handphone }}</h6>
                <small class="text-muted p-t-30 db">Address</small>
                <h6>{{ $member->address }}</h6>
                
                <br />
                <a href="{{ $member->id }}/edit" class="btn btn-primary">Edit</a>
                    <form action="/member/{{ $member->id }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    <a href="/member" class="btn btn-info">Back</a>
            </div>
        </div>
    </div>
    <!-- Column -->
</div>

@endsection
