{{-- !-- Delete Warning Modal --> --}}
<form action="{{ route('craftsman.destroy', $craftsman->id) }}" method="post">
    <div class="modal-body">
        @csrf
        @method('DELETE')
        <h5 class="text-center">{{ __('Are you sure you want to delete ')}} {{ $craftsman->username }}?</h5>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel')}}</button>
        <button type="submit" class="btn btn-danger">{{ __('Yes, Delete It')}}</button>
    </div>
</form>
