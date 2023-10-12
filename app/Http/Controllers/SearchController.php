<?php

namespace App\Http\Controllers;

use App\Services\SearchService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __construct(private SearchService $searchService)
    {
    }

    public function search (Request $request)
    {
        $request->flash();
        $searchResults = $this->searchService->search($request->input('searchTerm'));
        return view('search.index', compact('searchResults'));
    }
}
