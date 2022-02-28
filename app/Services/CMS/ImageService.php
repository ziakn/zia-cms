<?php
namespace App\Services\CMS;
use App\Repositories\CMS\ImageRepository;
class ImageService
{
    private $imageRepository;
    public function __construct(ImageRepository $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }
    public function index($request)
    {
        $data = $this->imageRepository->index($request);
        return $data;
    }
    public function create()
    {
        //
    }
    public function store($request)
    {
        $data = $this->imageRepository->store($request);
        return $data;
    }
    public function show($id)
    {
        $data = $this->imageRepository->show($id);
        return $data;
    }
    public function edit($request, $id)
    {
        $data = $this->imageRepository->edit($request, $id);
        return $data;
    }
    public function update($request, $id)
    {
        $data = $this->imageRepository->update($request, $id);
        return $data;
    }
    public function destroy($id)
    {
        $data = $this->imageRepository->destroy($id);
        return $data;
    }
}


        