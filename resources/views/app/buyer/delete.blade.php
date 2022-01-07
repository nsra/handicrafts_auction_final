{{-- !-- Delete Warning Modal --> --}}
<form action="{{ route('buyer.bid.destroy', $bid->id) }}" method="post">
    <div class="modal-body">
        @csrf
        @method('DELETE')
        <h5 class="text-center">{{__('Are you sure you want to delete bid with price:')}} {{ $bid->price }}$ ?</h5>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onClick="removeBackdrop()" data-dismiss="modal">{{ __("Cancel")}}</button>
        <button type="submit" class="btn btn-danger">{{__('Yes, Delete Bid')}}</button>
    </div>
</form>
