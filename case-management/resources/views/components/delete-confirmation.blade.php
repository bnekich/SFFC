@props(['route', 'itemId', 'message' => 'Are you sure you want to delete this item?'])

<form action="{{ $route }}" method="POST" class="d-inline delete-form">
    @csrf
    @method('DELETE')
    <button type="button"class="whitespace-nowrap text-sm text-red-500" data-bs-toggle="modal"
        data-bs-target="#deleteModal{{ $itemId }}">
        Delete
    </button>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal{{ $itemId }}" tabindex="-1"
        aria-labelledby="deleteModalLabel{{ $itemId }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel{{ $itemId }}">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>{{ $message }}</p>
                    <p class="text-muted small">This item will be soft deleted and can be restored by an administrator.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
</form>
