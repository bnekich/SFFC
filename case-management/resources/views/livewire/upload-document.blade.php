<div class="card">
    <div class="card-body">
        <h5 class="card-title">Upload Document</h5>
        @if (session()->has('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <form wire:submit.prevent="uploadFile" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="file" class="form-label">Select File</label>
                <input type="file" class="form-control" id="file" wire:model.live="file"
                    accept=".pdf,.doc,.docx,.xlsx,.jpg,.png,.txt,.csv,.odt">
                @error('file')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                <span wire:loading wire:target="uploadFile">Uploading...</span>
                <span wire:loading.remove wire:target="uploadFile">Upload</span>
            </button>
        </form>
        <div wire:loading wire:target="file" class="progress mt-3">
            <div class="progress-bar" role="progressbar" style="width: 100%"></div>
        </div>
    </div>
</div>
