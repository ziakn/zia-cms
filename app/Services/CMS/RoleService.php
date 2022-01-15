<?php
namespace App\Services\CMS;
use App\Repositories\CMS\RoleRepository;
class RoleService
{
    private $roleRepository;
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }
    public function index($request)
    {
        $data = $this->roleRepository->index($request);
        return $data;
    }
    public function create()
    {
        //
    }
    public function store($request)
    {
        $data = $this->roleRepository->store($request);
        return $data;
    }
    public function show($id)
    {
        $data = $this->roleRepository->show($id);
        return $data;
    }
    public function edit($request, $id)
    {
        $data = $this->roleRepository->edit($request, $id);
        return $data;
    }
    public function update($request, $id)
    {
        $data = $this->roleRepository->update($request, $id);
        return $data;
    }
    public function destroy($id)
    {
        $data = $this->roleRepository->destroy($id);
        return $data;
    }
}


        