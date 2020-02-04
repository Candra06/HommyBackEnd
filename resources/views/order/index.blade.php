@extends('layout.index')

@section('content')
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor">Order</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active">Order</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"></h4>
                <h6 class="card-subtitle">List Orders</h6>

                <!-- <a href="/service/create" class="btn btn-primary my-3">Tambah Layanan</a> -->

                @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif

                <div class="table-responsive">
                    <table class="table color-bordered-table danger-bordered-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Service</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $orders as $order )
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $order->name }}</td>
                                <td>{{ $order->service }}</td>
                                <td>{{ $order->address }}</td>
                                <td>
                                    <a href="/order/{{ $order->id }}" class="badge badge-info">Detail</a>
                                    @if ({{ $order->status }} === 1)
                                        <form action="/order/{{ $order->id }}" method="post" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-info">Survei</button>
                                        </form>
                                    @elseif ( {{ $order->status }} === 2)
                                        <form action="/order/{{ $order->id }}" method="post" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-success">Progress</button>
                                        </form>
                                    @else
                                        <form action="/order/{{ $order->id }}" method="post" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-success">Finish</button>
                                        </form>
                                    @endif
                                </td>
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
