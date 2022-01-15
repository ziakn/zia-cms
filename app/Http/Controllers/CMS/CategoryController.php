<?php
namespace App\Http\Controllers\CMS;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CMS\CategoryService;
class CategoryController extends Controller
{
    private $categoryService;
    public function __construct(CategoryService $categoryService)
    {
         $this->middleware('permission:category-list|category-create|category-edit|category-delete', ['only' => ['index','show']]);
         $this->middleware('permission:category-create', ['only' => ['create','store']]);
         $this->middleware('permission:category-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:category-delete', ['only' => ['destroy']]);
        $this->categoryService = $categoryService;
    }
    public function index(Request $request)
    {
        $data = $this->categoryService->index($request);
        return $data;
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $data = $this->categoryService->store($request);
        return $data;
    }
    public function show($id)
    {
        $data = $this->categoryService->show($id);
        return $data;
    }
    public function edit(Request $request, $id)
    {
        $data = $this->categoryService->edit($request, $id);
        return $data;
    }
    public function update(Request $request, $id)
    {
        $data = $this->categoryService->update($request, $id);
        return $data;
    }
    public function destroy($id)
    {
        $data = $this->categoryService->destroy($id);
        return $data;
    }
}
        