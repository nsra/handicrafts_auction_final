{{-- !-- Delete Warning Modal --> --}}
<form action="{{ route('craftsman.product.destroy', $product->id) }}" method="post">
    <div class="modal-body">
        @csrf
        @method('DELETE')
        <h5 class="text-center">{{ __('Are you sure you want to delete your product:')}} {{ $product->title }}?</h5>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onClick="removeBackdrop()" data-dismiss="modal">{{ __('Cancel')}}</button>
        <button type="submit" class="btn btn-danger">{{ __('Yes, Delete Product')}}</button>
    </div>
</form>
