<?php
namespace App\Http\Controllers\CMS;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CMS\ImageFolderService;
class ImageFolderController extends Controller
{
    private $imageFolderService;
    public function __construct(ImageFolderService $imageFolderService)
    {
        $this->imageFolderService = $imageFolderService;
    }
    public function index(Request $request)
    {
        $data = $this->imageFolderService->index($request);
        return $data;
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $data = $this->imageFolderService->store($request);
        return $data;
    }
    public function show($id)
    {
        $data = $this->imageFolderService->show($id);
        return $data;
    }
    public function edit(Request $request, $id)
    {
        $data = $this->imageFolderService->edit($request, $id);
        return $data;
    }
    public function update(Request $request, $id)
    {
        $data = $this->imageFolderService->update($request, $id);
        return $data;
    }
    public function destroy($id)
    {
        $data = $this->imageFolderService->destroy($id);
        return $data;
    }
}
        