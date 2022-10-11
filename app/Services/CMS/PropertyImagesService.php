<?php
namespace App\Services\CMS;
use App\Repositories\CMS\PropertyImagesRepository;
class PropertyImagesService
{
    private $propertyImagesRepository;
    public function __construct(PropertyImagesRepository $propertyImagesRepository)
    {
        $this->propertyImagesRepository = $propertyImagesRepository;
    }
    public function index($request)
    {
        $data = $this->propertyImagesRepository->index($request);
        return $data;
    }
    public function create()
    {
        //
    }
    public function store($request)
    {
        $data = $this->propertyImagesRepository->store($request);
        return $data;
    }
    public function show($id)
    {
        $data = $this->propertyImagesRepository->show($id);
        return $data;
    }
    public function edit($request, $id)
    {
        $data = $this->propertyImagesRepository->edit($request, $id);
        return $data;
    }
    public function update($request, $id)
    {
        $data = $this->propertyImagesRepository->update($request, $id);
        return $data;
    }
    public function destroy($id)
    {
        $data = $this->propertyImagesRepository->destroy($id);
        return $data;
    }
}


        