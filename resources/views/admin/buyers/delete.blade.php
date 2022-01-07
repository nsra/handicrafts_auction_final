{{-- !-- Delete Warning Modal --> --}}
<form action="{{ route('buyer.destroy', $buyer->id) }}" method="post">
    <div class="modal-body">
        @csrf
        @method('DELETE')
        <h5 class="text-center">{{ __('Are you sure you want to delete product with title:')}} {{ $buyer->username }}, {{ __('with all his bids?') }}</h5>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
        <button type="submit" class="btn btn-danger">{{ __('Yes, Delete Buyer') }}</button>
    </div>
</form>
