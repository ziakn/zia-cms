<?php
namespace App\Http\Controllers\CMS;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CMS\AmenityService;
class AmenityController extends Controller
{
    private $amenityService;
    public function __construct(AmenityService $amenityService)
    {
        $this->amenityService = $amenityService;
    }
    public function index(Request $request)
    {
        $data = $this->amenityService->index($request);
        return $data;
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $data = $this->amenityService->store($request);
        return $data;
    }
    public function show($id)
    {
        $data = $this->amenityService->show($id);
        return $data;
    }
    public function edit(Request $request, $id)
    {
        $data = $this->amenityService->edit($request, $id);
        return $data;
    }
    public function update(Request $request, $id)
    {
        $data = $this->amenityService->update($request, $id);
        return $data;
    }
    public function destroy($id)
    {
        $data = $this->amenityService->destroy($id);
        return $data;
    }
}
        