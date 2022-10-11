<?php
namespace App\Http\Controllers\CMS;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CMS\PropertyDocumentService;
class PropertyDocumentController extends Controller
{
    private $propertyDocumentService;
    public function __construct(PropertyDocumentService $propertyDocumentService)
    {
        $this->propertyDocumentService = $propertyDocumentService;
    }
    public function index(Request $request)
    {
        $data = $this->propertyDocumentService->index($request);
        return $data;
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $data = $this->propertyDocumentService->store($request);
        return $data;
    }
    public function show($id)
    {
        $data = $this->propertyDocumentService->show($id);
        return $data;
    }
    public function edit(Request $request, $id)
    {
        $data = $this->propertyDocumentService->edit($request, $id);
        return $data;
    }
    public function update(Request $request, $id)
    {
        $data = $this->propertyDocumentService->update($request, $id);
        return $data;
    }
    public function destroy($id)
    {
        $data = $this->propertyDocumentService->destroy($id);
        return $data;
    }
}
        