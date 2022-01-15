<?php
namespace App\Services\CMS;
use App\Repositories\CMS\CategoryRepository;
class CategoryService
{
    private $categoryRepository;
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    public function index($request)
    {
        $data = $this->categoryRepository->index($request);
        return $data;
    }
    public function create()
    {
        //
    }
    public function store($request)
    {
        $data = $this->categoryRepository->store($request);
        return $data;
    }
    public function show($id)
    {
        $data = $this->categoryRepository->show($id);
        return $data;
    }
    public function edit($request, $id)
    {
        $data = $this->categoryRepository->edit($request, $id);
        return $data;
    }
    public function update($request, $id)
    {
        $data = $this->categoryRepository->update($request, $id);
        return $data;
    }
    public function destroy($id)
    {
        $data = $this->categoryRepository->destroy($id);
        return $data;
    }
}
        