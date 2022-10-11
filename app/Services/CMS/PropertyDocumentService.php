<?php
namespace App\Services\CMS;
use App\Repositories\CMS\PropertyDocumentRepository;
class PropertyDocumentService
{
    private $propertyDocumentRepository;
    public function __construct(PropertyDocumentRepository $propertyDocumentRepository)
    {
        $this->propertyDocumentRepository = $propertyDocumentRepository;
    }
    public function index($request)
    {
        $data = $this->propertyDocumentRepository->index($request);
        return $data;
    }
    public function create()
    {
        //
    }
    public function store($request)
    {
        $data = $this->propertyDocumentRepository->store($request);
        return $data;
    }
    public function show($id)
    {
        $data = $this->propertyDocumentRepository->show($id);
        return $data;
    }
    public function edit($request, $id)
    {
        $data = $this->propertyDocumentRepository->edit($request, $id);
        return $data;
    }
    public function update($request, $id)
    {
        $data = $this->propertyDocumentRepository->update($request, $id);
        return $data;
    }
    public function destroy($id)
    {
        $data = $this->propertyDocumentRepository->destroy($id);
        return $data;
    }
}


        