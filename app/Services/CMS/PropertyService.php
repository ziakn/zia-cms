<?php
namespace App\Services\CMS;
use App\Repositories\CMS\PropertyRepository;
class PropertyService
{
    private $propertyRepository;
    public function __construct(PropertyRepository $propertyRepository)
    {
        $this->propertyRepository = $propertyRepository;
    }
    public function index($request)
    {
        $data = $this->propertyRepository->index($request);
        return $data;
    }
    public function create()
    {
        //
    }
    public function store($request)
    {
        $data = $this->propertyRepository->store($request);
        return $data;
    }
    public function show($id)
    {
        $data = $this->propertyRepository->show($id);
        return $data;
    }
    public function edit($request, $id)
    {
        $data = $this->propertyRepository->edit($request, $id);
        return $data;
    }
    public function update($request, $id)
    {
        $data = $this->propertyRepository->update($request, $id);
        return $data;
    }
    public function destroy($id)
    {
        $data = $this->propertyRepository->destroy($id);
        return $data;
    }
}


        