<?php
namespace App\Http\Controllers\CMS;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CMS\ImageService;
class ImageController extends Controller
{
    private $imageService;
    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }
    public function index(Request $request)
    {
        $data = $this->imageService->index($request);
        return $data;
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $data = $this->imageService->store($request);
        return $data;
    }
    public function show($id)
    {
        $data = $this->imageService->show($id);
        return $data;
    }
    public function edit(Request $request, $id)
    {
        $data = $this->imageService->edit($request, $id);
        return $data;
    }
    public function update(Request $request, $id)
    {
        $data = $this->imageService->update($request, $id);
        return $data;
    }
    public function destroy($id)
    {
        $data = $this->imageService->destroy($id);
        return $data;
    }
}
        