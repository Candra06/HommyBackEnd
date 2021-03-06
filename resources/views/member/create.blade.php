@extends('layout.index')

@section('content')
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor">Member</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item">Member</li>
            <li class="breadcrumb-item active">Add Member</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <!-- <h4 class="card-title">Sample Form with the Icons</h4>
                <h6 class="card-subtitle">made with bootstrap elements</h6> -->
                <div class="row">
                    <div class="col-lg-6">
                        <form class="form p-t-20" method="post" action="/service" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="ti-user"></i></div>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ old('name') }}" placeholder="Ketik Nama Layanan">
                                    @error('name') &nbsp;<div class="invalid-feedback">{{$message}}</div> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description">Deskripsi</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="ti-email"></i></div>
                                    <input type="text" class="form-control @error('description') is-invalid @enderror"
                                        id="description" name="description" value="{{ old('description') }}" placeholder="Ketik Deskripsi Layanan">
                                    @error('description') &nbsp;<div class="invalid-feedback">{{$message}}</div> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="img">Foto</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="ti-lock"></i></div>
                                    <input type="file" class="form-control"
                                        id="image" name="image" >
                                </div>
                            </div>
                            <button type="submit"
                                class="btn btn-success waves-effect waves-light m-r-10">Tambah</button>
                            <button type="reset" class="btn btn-inverse waves-effect waves-light">Batal</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
