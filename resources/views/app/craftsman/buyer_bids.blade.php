@extends('layouts.main_layout')
@section('content')
    <div class="row">
      
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Buyer Bids</h3>
                </div>
                <br>
                <div class="panel-body">
                    <table class="table table-bordered flip-content">
                        <thead class="flip-content">
                        <tr>
                            <th class="text-center">{{__('price')}}</th>
                            <th class="text-center">{{__('description')}}</th>
                            <th class="text-center">{{__('created at')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($bids as $bid)
                            <tr>
                                <td class="text-center">{{$bid->price}}</td>
                                <td class="text-center">{{$bid->description}}</td>
                                <td class="text-center">{{$bid->created_at}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                       
                    </table>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <div class="text-center ">
        
        <a href="{{route('craftsman.product.bid.user', $bid->id)}}" type="reset" name="cancel"
           class="btn btn-warning">{{__('Cancel')}}</a>
    </div>
@endsection

