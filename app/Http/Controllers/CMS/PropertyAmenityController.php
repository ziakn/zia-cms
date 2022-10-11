<?php
namespace App\Http\Controllers\CMS;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CMS\PropertyAmenityService;
class PropertyAmenityController extends Controller
{
    private $propertyAmenityService;
    public function __construct(PropertyAmenityService $propertyAmenityService)
    {
        $this->propertyAmenityService = $propertyAmenityService;
    }
    public function index(Request $request)
    {
        $data = $this->propertyAmenityService->index($request);
        return $data;
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $data = $this->propertyAmenityService->store($request);
        return $data;
    }
    public function show($id)
    {
        $data = $this->propertyAmenityService->show($id);
        return $data;
    }
    public function edit(Request $request, $id)
    {
        $data = $this->propertyAmenityService->edit($request, $id);
        return $data;
    }
    public function update(Request $request, $id)
    {
        $data = $this->propertyAmenityService->update($request, $id);
        return $data;
    }
    public function destroy($id)
    {
        $data = $this->propertyAmenityService->destroy($id);
        return $data;
    }
}
        