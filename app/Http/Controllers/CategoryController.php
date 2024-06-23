<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    
    public function index()
    {
        $categories = $this->categoryRepository->allCategories();

        return view('categories.index', 
            compact('categories')
        );
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        // dd($request);
        // $data = $request->validate([
        //     'name' => 'required|string|max:255',
        //     'slug' => 'required|string|max:255',
        // ]);

        $this->categoryRepository->storeCategory($request->only('name', 'slug'));
    }

    public function show(string $id)
    {
        return view('categories.index');
    }

    public function edit(string $id)
    {
        $category = $this->categoryRepository->findCategory($id);
        
        return view('categories.edit',
            compact('category')
        );
    }

    public function update(Request $request, string $id)
    {
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'slug' => 'required|string|max:255',
        // ]);

        $this->categoryRepository->updateCategory($request->all(), $id);

        // return redirect()->route('categories.index')->with('message', 'Category Updated Successfully');
        return to_route('categories.index');
    }

    public function destroy(string $id)
    {
        $this->categoryRepository->destroyCategory($id);

        // return redirect()->route('categories.index')->with('status', 'Category Delete Successfully');
        return to_route('categories.index');
    }
}
