{{-- !-- Delete Warning Modal -->  --}}
<form action="{{ route('order.destroy', $order->id) }}" method="post">
    <div class="modal-body">
        @csrf
        @method('DELETE')
        <h5 class="text-center">Are you sure you want to delete the order of product: {{ $order->product->title }}?</h5>
    </div>
    <div class="modal-footer">
        <button type="button"  class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-danger">Yes, Delete Order</button>
    </div>
</form>