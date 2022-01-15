<?php
namespace App\Http\Controllers\CMS;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CMS\UserService;
class UserController extends Controller
{
    private $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function index(Request $request)
    {
        $data = $this->userService->index($request);
        return $data;
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $data = $this->userService->store($request);
        return $data;
    }
    public function show($id)
    {
        $data = $this->userService->show($id);
        return $data;
    }
    public function edit(Request $request, $id)
    {
        $data = $this->userService->edit($request, $id);
        return $data;
    }
    public function update(Request $request, $id)
    {
        $data = $this->userService->update($request, $id);
        return $data;
    }
    public function destroy($id)
    {
        $data = $this->userService->destroy($id);
        return $data;
    }
}
        