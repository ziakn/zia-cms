<?php
namespace App\Services\CMS;
use App\Repositories\CMS\AmenityRepository;
class AmenityService
{
    private $amenityRepository;
    public function __construct(AmenityRepository $amenityRepository)
    {
        $this->amenityRepository = $amenityRepository;
    }
    public function index($request)
    {
        $data = $this->amenityRepository->index($request);
        return $data;
    }
    public function create()
    {
        //
    }
    public function store($request)
    {
        $data = $this->amenityRepository->store($request);
        return $data;
    }
    public function show($id)
    {
        $data = $this->amenityRepository->show($id);
        return $data;
    }
    public function edit($request, $id)
    {
        $data = $this->amenityRepository->edit($request, $id);
        return $data;
    }
    public function update($request, $id)
    {
        $data = $this->amenityRepository->update($request, $id);
        return $data;
    }
    public function destroy($id)
    {
        $data = $this->amenityRepository->destroy($id);
        return $data;
    }
}


        