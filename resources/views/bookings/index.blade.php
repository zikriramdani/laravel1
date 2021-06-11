@extends('layouts.layouts')
@section('title')
    Booking Mobil
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/libs/select2/dist/css/select2.min.css')}}">
    <style>
        .car-img{
            width: 100%;
            max-height: 150px;
            padding-bottom: 20px;
        }
    </style>
@endsection
@section('content')
    <h2>Pilih Mobil</h2>
    <div class="row">
        @foreach ($cars as $car)
        <div class="col-lg-3">
            <div class="card">
                <img class="car-img" src="{{$car->getPhoto()}}" alt="car images">
                <div class="card-body">
                    <div class="d-flex no-block align-items-center mb-3">
                        <span><strong>{{number_format($car->price)}} / Hari</strong></span>
                        <div class="ml-auto">
                            <span><i class="ti-car"></i> {{$car->type}}</span>
                        </div>
                    </div>
                    <h3>{{$car->car_name}}</h3>
                    <div class="d-flex no-block align-items-center pb-3">
                        <span class="text-muted">{{$car->brand->brand_name}}</span>
                        <div class="ml-auto">
                            <span class="text-muted"><strong>{{$car->plat_number}}</strong></span>
                        </div>
                    </div>
                    <div id="accordion" class="accordion">
                        <div class="card mt-2">
                            <div id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-block btn-info" data-toggle="collapse" data-target="#collapse{{$car->id}}" aria-expanded="true" aria-controls="collapse{{$car->id}}">
                                    <i class="fa fa-car"></i> Rental
                                    </button>
                                </h5>
                            </div>
                            <div id="collapse{{$car->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">
                                    <form action="/bookings/calculate" method="post">
                                    @csrf
                                    <input type="hidden" name="car_id" value="{{$car->id}}">
                                    <div class="form-group">
                                        <label>Kode Booking</label>
                                        <input type="text" name="booking_code" readonly required value="M-{{rand()}}" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="#clients">Plih Penyewa</label><br>
                                        <select type="text" class="form-control" name="client_id" id="clients">
                                            <option disabled selected >-- Pilih Penyewa --</option>
                                            @foreach ($clients as $client)
                                            <option value="{{$client->id}}">{{$client->id}} - {{$client->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Order</label>
                                        <input type="date" name="order_date" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Durasi / Hari</label>
                                        <input type="number" class="form-control" name="duration">
                                    </div>

                                    <button type="submit" class="btn btn-block btn-secondary">Rental</button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

@endsection
@section('script')
<script src="{{asset('assets/libs/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('assets/libs/select2/dist/js/select2.min.js')}}"></script>
<script src="{{asset('dist/js/pages/forms/select2/select2.init.js')}}"></script>
<script>
    $(document).ready(function(){
        $('#clients').select2();
    })
</script>
@endsection