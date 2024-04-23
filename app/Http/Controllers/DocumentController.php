<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DocumentController extends Controller
{
    use AuthorizesRequests;

    public function index(): View
    {
        $this->authorize('documents.viewAny');

        return view('employee.documents.index');
    }

    public function create(): View
    {
        $this->authorize('documents.create');

        return view('employee.documents.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Document::class);

        $data = $request->validate([

        ]);

        return Document::create($data);
    }

    public function show(Document $document)
    {
        $this->authorize('view', $document);

        return $document;
    }

    public function update(Request $request, Document $document)
    {
        $this->authorize('update', $document);

        $data = $request->validate([

        ]);

        $document->update($data);

        return $document;
    }

    public function destroy(Document $document)
    {
        $this->authorize('delete', $document);

        $document->delete();

        return response()->json();
    }
}
