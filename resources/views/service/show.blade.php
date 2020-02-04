@extends('layout.index')

@section('content')
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor">Service</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item">Service</li>
            <li class="breadcrumb-item active">Detail Service</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-6 m-t-30">
        <div class="card-group">
            <div class="card">
                <img class="card-img-top img-responsive" src="{{url('image/service/'.$service->image)}}" alt="Card image cap">
                <div class="card-body">
                    <h4 class="card-title">{{ $service->name }}</h4>
                    <p class="card-text">{{ $service->description }}</p>

                    <a href="{{ $service->id }}/edit" class="btn btn-primary">Edit</a>
                    <form action="/service/{{ $service->id }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                    <a href="/service" class="btn btn-info">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
