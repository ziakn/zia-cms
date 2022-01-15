<?php
namespace App\Services\CMS;
use App\Repositories\CMS\UserRepository;
class UserService
{
    private $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function index($request)
    {
        $data = $this->userRepository->index($request);
        return $data;
    }
    public function create()
    {
        //
    }
    public function store($request)
    {
        $data = $this->userRepository->store($request);
        return $data;
    }
    public function show($id)
    {
        $data = $this->userRepository->show($id);
        return $data;
    }
    public function edit($request, $id)
    {
        $data = $this->userRepository->edit($request, $id);
        return $data;
    }
    public function update($request, $id)
    {
        $data = $this->userRepository->update($request, $id);
        return $data;
    }
    public function destroy($id)
    {
        $data = $this->userRepository->destroy($id);
        return $data;
    }
}


        