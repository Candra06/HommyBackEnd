@extends('layout.index')

@section('content')
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor">Member</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item">Member</li>
            <li class="breadcrumb-item active">Edit Member</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <!-- <h4 class="card-title">Sample Form with the Icons</h4>
                <h6 class="card-subtitle">made with bootstrap elements</h6> -->
                <div class="row">
                    <div class="col-lg-10">
                        <form class="form p-t-20" method="post" action="/member/{{ $member->id }}" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="ti-user"></i></div>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ $member->name }}">
                                    @error('name') &nbsp;<div class="invalid-feedback">{{$message}}</div> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="ti-email"></i></div>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ $member->email }}">
                                    @error('email') &nbsp;<div class="invalid-feedback">{{$message}}</div> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="handphone">Handphone</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="ti-email"></i></div>
                                    <input type="text" class="form-control @error('handphone') is-invalid @enderror"
                                        id="handphone" name="handphone" value="{{ $member->handphone }}">
                                    @error('handphone') &nbsp;<div class="invalid-feedback">{{$message}}</div> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="ti-email"></i></div>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror"
                                        id="address" name="address" value="{{ $member->address }}">
                                    @error('address') &nbsp;<div class="invalid-feedback">{{$message}}</div> @enderror
                                </div>
                            </div>
                            
                            <button type="submit"
                                class="btn btn-success waves-effect waves-light m-r-10">Ubah Data</button>
                                <a href="/member/{{ $member->id }}" class="btn btn-info">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
