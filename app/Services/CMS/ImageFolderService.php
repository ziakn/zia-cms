<?php
namespace App\Services\CMS;
use App\Repositories\CMS\ImageFolderRepository;
class ImageFolderService
{
    private $imageFolderRepository;
    public function __construct(ImageFolderRepository $imageFolderRepository)
    {
        $this->imageFolderRepository = $imageFolderRepository;
    }
    public function index($request)
    {
        $data = $this->imageFolderRepository->index($request);
        return $data;
    }
    public function create()
    {
        //
    }
    public function store($request)
    {
        $data = $this->imageFolderRepository->store($request);
        return $data;
    }
    public function show($id)
    {
        $data = $this->imageFolderRepository->show($id);
        return $data;
    }
    public function edit($request, $id)
    {
        $data = $this->imageFolderRepository->edit($request, $id);
        return $data;
    }
    public function update($request, $id)
    {
        $data = $this->imageFolderRepository->update($request, $id);
        return $data;
    }
    public function destroy($id)
    {
        $data = $this->imageFolderRepository->destroy($id);
        return $data;
    }
}


        