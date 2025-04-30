<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentFormRequest;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Exceptions\UnauthorizedException;

class DocumentController extends Controller
{
    public function index(DocumentFormRequest $request)
    {
        $query = $request->input('query');

        $documentsQuery = Document::query();

        // Restrict to user's documents unless they have 'view all documents' permission
        //if (!auth()->user()->hasPermissionTo('view all documents')) {
        $documentsQuery->where('user_id', auth()->id());
        //}

        // Apply full-text search if query is provided
        if ($query) {
            $documentsQuery->whereRaw('MATCH(content) AGAINST(? IN BOOLEAN MODE)', [$query]);
        }

        // Paginate results
        $documents = $documentsQuery->orderBy('created_at', 'desc')->paginate(10);

        return view('document.index', compact('documents', 'query'));
    }

    public function download(Document $document)
    {
        // Check if user has permission to download
        if (
            !auth()->user()->hasPermissionTo('view documents') ||
            (!auth()->user()->hasPermissionTo('view all documents') && $document->user_id !== auth()->id())
        ) {
            throw new UnauthorizedException(403, 'Unauthorized to download this document.');
        }

        // Verify file exists
        if (!Storage::disk('public')->exists($document->path)) {
            abort(404, 'File not found.');
        }

        return Storage::disk('public')->download($document->path, $document->name);
    }
}
