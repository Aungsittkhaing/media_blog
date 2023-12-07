<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Auth\Access\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate as FacadesGate;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $this->authorize('viewAny', Category::class);
        $categories = Category::when(request()->has('keyword'), function ($query) {
            $keyword = request()->keyword;
            $query->where("title", "like", "%" . $keyword . "%");
            $query->orWhere("description", "like", "%" . $keyword . "%");
        })
            ->when(request()->has('title'), function ($query) {
                $sortType = request()->title ?? 'asc';
                $query->orderBy('title', $sortType);
            })
            ->latest('id')
            ->paginate(7)->withQueryString();
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Category::class);
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        // $this->authorize('create', Category::class);
        $categories = Category::create([
            "title" => $request->title,
            "slug" => Str::slug($request->titile),
            "user_id" => Auth::id()
        ]);
        return redirect()->route('category.index')->with('status', $categories->title . " is created😊");
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        // $this->authorize('update', Category::class);
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        // FacadesGate::authorize('update', $category);

        // if ($request->user()->cannot('update', $category)) {
        //     return abort(403, 'sorry');
        // }
        // $this->authorize('update', $category);
        $category->update(['title' => $request->title, 'slug' => Str::slug($request->title)]);
        return redirect()->route('category.index')->with('status', "Category is updated😊");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        FacadesGate::authorize('delete', $category);
        $category->delete();
        return redirect()->back()->with('status', 'category is deleted😊');
    }
}
