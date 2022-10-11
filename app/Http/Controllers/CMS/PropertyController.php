<?php
namespace App\Http\Controllers\CMS;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CMS\PropertyService;
class PropertyController extends Controller
{
    private $propertyService;
    public function __construct(PropertyService $propertyService)
    {
        $this->propertyService = $propertyService;
    }
    public function index(Request $request)
    {
        $data = $this->propertyService->index($request);
        return $data;
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $data = $this->propertyService->store($request);
        return $data;
    }
    public function show($id)
    {
        $data = $this->propertyService->show($id);
        return $data;
    }
    public function edit(Request $request, $id)
    {
        $data = $this->propertyService->edit($request, $id);
        return $data;
    }
    public function update(Request $request, $id)
    {
        $data = $this->propertyService->update($request, $id);
        return $data;
    }
    public function destroy($id)
    {
        $data = $this->propertyService->destroy($id);
        return $data;
    }
}
        