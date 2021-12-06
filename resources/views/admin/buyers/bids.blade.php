@extends('base_layout._layout')

@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-search"></i>{{__('Search')}}</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{route('admin.buyer.bids', $buyer->id)}}" method="GET">
                                <div class="form-group lg-10">
                                    <input type="text" name="name" placeholder="{{__('search by bid Price or description')}}" class="form-control"
                                           value="{{app('request')->get('name')}}">
                                </div>

                                <div class="form-action col-sm-12 text-right">
                                    <input type="submit" value="{{__('Search')}}" class="btn btn-primary">
                                    <a class="btn btn-default"
                                       href="{{route('admin.buyer.bids', $buyer->id)}}">{{__('Cancel')}}
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
                    <h3 class="panel-title"><i class="fa fa-book"></i>{{__('Bids')}}</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped table-condensed flip-content">
                        <thead class="flip-content">
                        <tr>
                            <th class="text-center">{{__('price')}}</th>
                            <th class="text-center">{{__('product')}}</th>
                            <th class="text-center">{{__('description')}}</th>
                            <th class="text-center">{{__('created at')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($bids as $bid)
                            <tr>
                                <td class="text-center">{{$bid->price}}</td>
                                <td class="text-center">
                                    <a href="{{route('admin.buyer.bid.product', $bid->id)}}">
                                        {{$bid->product->title}}
                                    </a>
                                </td>
                                <td class="text-center">{{$bid->description}}</td>
                                <td class="text-center">{{$bid->created_at}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="com-md-12 text-right">
                        {{$bids->links('pagination::bootstrap-4')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <div class="text-center ">
        <a href="{{route('buyers.index')}}" type="reset" name="cancel"
           class="btn btn-default">{{__('Cancel')}}</a>
    </div>
@endsection

