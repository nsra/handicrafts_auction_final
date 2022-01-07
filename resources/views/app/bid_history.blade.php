<div>
    <div class="modal-body">
    <h5 class="text-center">{{ __('Bid history for ')}}<b> {{$bid_history->first()->bid->user->username}}</b> {{ __('on')}} <b>{{$bid_history->first()->bid->product->title}} </b> 
        </h5>
        <table class="table table-bordered flip-content">
            <thead class="flip-content">
                <tr>
                    <th class="text-center">{{ __('price') }}</th>
                    <th class="text-center">{{ __('description') }}</th>
                    <th class="text-center">{{ __('created at') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bid_history as $bid)
                    <tr>
                        <td class="text-center">{{ $bid->price }}$</td>
                        <td class="text-center">{{ $bid->description }}</td>
                        <td class="text-center">{{ $bid->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
            <div class="com-md-12 text-right">
                {{ $bid_history->links('pagination::bootstrap-4') }}
            </div>
        </table>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-dark" onClick="removeBackdrop()" data-dismiss="modal">{{ __('OK')}}</button>
    </div>
</div>


