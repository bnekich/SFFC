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
        //$query = $request->input('query');
        $query = $request->input('search');

        $documentsQuery = Document::query();

        if (!auth()->user()->hasPermissionTo('document-viewAny')) {
            $documentsQuery->where('user_id', auth()->id());
        }

        // Apply full-text search if query is provided
        if ($query) {
            $documentsQuery->whereFullText('content', $query);
        }

        // Paginate results
        $documents = $documentsQuery->orderBy('created_at', 'desc')->paginate(10);

        return view('document.index', compact('documents', 'query'));
    }

    public function download(Document $document)
    {
        // Check if the user has permission to download any document or if it's their own document
        $canDownloadAny = auth()->user()->hasPermissionTo('document-downloadAny');
        $isOwner = $document->user_id === auth()->id();

        if (!$canDownloadAny && !$isOwner) {
            throw new UnauthorizedException(403, 'Unauthorized to download this document.');
        }

        if (!Storage::disk('spaces')->exists($document->path)) {
            abort(404, 'File not found.');
        }

        return Storage::disk('spaces')->download($document->path, $document->name);
    }
}
