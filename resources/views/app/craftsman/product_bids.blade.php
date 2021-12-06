@extends('layouts.main_layout')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">{{__('Search')}}</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{route('craftsman.product.bids', $product->id)}}" method="GET">
                                <div class="form-group lg-10">
                                    <input class="form-group " type="text" name="name" placeholder="{{__('Enter Price or description')}}" 
                                         value="{{app('request')->get('name')}}">

                                {{-- <div class="form-action col-sm-12 text-right"> --}}
                                    <input type="submit" value="{{__('Search')}}" class="btn btn-warning">
                                    <a class="btn btn-secondary"
                                       href="{{route('craftsman.product.bids', $product->id)}}">{{__('Cancel')}}
                                    </a>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Bids for product: {{$product->title}} - OrderNowPrice: {{$product->orderNowPrice}}$</h3>
                </div>
                <br>
                <div class="panel-body">
                    <table class="table table-bordered flip-content">
                        <thead class="flip-content">
                        <tr>
                            <th class="text-center">{{__('price')}}</th>
                            <th class="text-center">{{__('description')}}</th>
                            <th class="text-center">{{__('created at')}}</th>
                            <th class="text-center">{{__('Bid Owner-Buyer')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($bids as $bid)
                            <tr>
                                <td class="text-center">{{$bid->price}}</td>
                                <td class="text-center">{{$bid->description}}</td>
                                <td class="text-center">{{$bid->created_at}}</td>
                                <td class="text-center">
                                    <a href="{{route('craftsman.product.bid.user', $bid->id)}}">{{$bid->user->username}}</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <div class="com-md-12 text-right">
                            {{$bids->links('pagination::bootstrap-4')}}
                        </div>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <div class="text-center ">
        <a href="{{route('craftsman.product.edit', $product->id)}}" type="reset" name="cancel"
           class="btn btn-warning">{{__('Cancel')}}</a>
    </div>
@endsection

