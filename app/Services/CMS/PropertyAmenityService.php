<?php
namespace App\Services\CMS;
use App\Repositories\CMS\PropertyAmenityRepository;
class PropertyAmenityService
{
    private $propertyAmenityRepository;
    public function __construct(PropertyAmenityRepository $propertyAmenityRepository)
    {
        $this->propertyAmenityRepository = $propertyAmenityRepository;
    }
    public function index($request)
    {
        $data = $this->propertyAmenityRepository->index($request);
        return $data;
    }
    public function create()
    {
        //
    }
    public function store($request)
    {
        $data = $this->propertyAmenityRepository->store($request);
        return $data;
    }
    public function show($id)
    {
        $data = $this->propertyAmenityRepository->show($id);
        return $data;
    }
    public function edit($request, $id)
    {
        $data = $this->propertyAmenityRepository->edit($request, $id);
        return $data;
    }
    public function update($request, $id)
    {
        $data = $this->propertyAmenityRepository->update($request, $id);
        return $data;
    }
    public function destroy($id)
    {
        $data = $this->propertyAmenityRepository->destroy($id);
        return $data;
    }
}


        