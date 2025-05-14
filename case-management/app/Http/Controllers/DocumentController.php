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

        if (!auth()->user()->hasPermissionTo('documents-viewAny')) {
            $documentsQuery->where('user_id', auth()->id());
        }

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
        if (
            !auth()->user()->hasPermissionTo('documents-view') ||
            (!auth()->user()->hasPermissionTo('documents-download') && $document->user_id !== auth()->id())
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
