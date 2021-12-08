{{-- !-- Delete Warning Modal --> --}}
<form action="{{ route('buyer.order.destroy', $order->id) }}" method="post">
    <div class="modal-body">
        @csrf
        @method('DELETE')
        <h5 class="text-center">Are you sure you have received your ordered product:{{ $order->product->title }} ?
        </h5>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onClick="removeBackdrop()" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success">Yes, I received it</button>
    </div>
</form>
