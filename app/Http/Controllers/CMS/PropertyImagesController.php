<?php
namespace App\Http\Controllers\CMS;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CMS\PropertyImagesService;
class PropertyImagesController extends Controller
{
    private $propertyImagesService;
    public function __construct(PropertyImagesService $propertyImagesService)
    {
        $this->propertyImagesService = $propertyImagesService;
    }
    public function index(Request $request)
    {
        $data = $this->propertyImagesService->index($request);
        return $data;
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $data = $this->propertyImagesService->store($request);
        return $data;
    }
    public function show($id)
    {
        $data = $this->propertyImagesService->show($id);
        return $data;
    }
    public function edit(Request $request, $id)
    {
        $data = $this->propertyImagesService->edit($request, $id);
        return $data;
    }
    public function update(Request $request, $id)
    {
        $data = $this->propertyImagesService->update($request, $id);
        return $data;
    }
    public function destroy($id)
    {
        $data = $this->propertyImagesService->destroy($id);
        return $data;
    }
}
        