<?php

namespace App\Http\Controllers;

use App\Models\DocumentCategory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DocumentCategoryController extends Controller
{
    use AuthorizesRequests;

    public function index(): View
    {
        $this->authorize('documentCategories.viewAny');

        return view('admin.document-categories.index', []);
    }

    public function create(): View
    {
        return view('admin.document-categories.create', []);
    }

    public function store(Request $request)
    {
        $this->authorize('create', DocumentCategory::class);

        $data = $request->validate([

        ]);

        return DocumentCategory::create($data);
    }

    public function show(DocumentCategory $documentCategory)
    {
        $this->authorize('view', $documentCategory);

        return $documentCategory;
    }

    public function update(Request $request, DocumentCategory $documentCategory)
    {
        $this->authorize('update', $documentCategory);

        $data = $request->validate([

        ]);

        $documentCategory->update($data);

        return $documentCategory;
    }

    public function destroy(DocumentCategory $documentCategory)
    {
        $this->authorize('delete', $documentCategory);

        $documentCategory->delete();

        return response()->json();
    }
}

