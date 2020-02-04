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
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <ul class="timeline">
                    @foreach( $orders as $order )
                    <li class="{{ $order->status == '1' ? ' ' : 'timeline-inverted' }}">
                        <div class="timeline-badge"><span><i class="fa fa-circle" style="color: #000000;"></i></span> </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">{{ $order->title }}</h4>
                            </div>
                            <div class="timeline-body">
                                <p>{{ $order->description }}</p>
                                <p>{{ $order->date }}</p>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection
