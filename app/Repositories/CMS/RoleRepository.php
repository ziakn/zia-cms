<?php
namespace App\Repositories\CMS;
use Illuminate\Http\Request;
use App\Models\Role;
class RoleRepository
{
    private $role;
    public function __construct()
    {
        $this->role = new Role();
    }
    public function index($request)
    {
       
        //$data=Role::get();
        //return $data;
    }
    public function create()
    {
        //
    }
    public function store($request)
    {
        // $response=array();
        // $response["status"]=false;
        // $response["data"] ="";
        // $auth_id = Auth::id();
        // DB::beginTransaction();
        // try {
        //     $response["data"]=Role::create([
        //         
        //     ]);
        //     DB::commit();
        //     $response["status"] = true;
        // } catch (\Exception $e) {
        //     $response["data"]=$e->getMessage();
        //     $response["status"] = false;
        //     DB::rollback();
        // }

        // return response()->json($response);
    }
    public function show($id)
    {
        //
    }

    public function edit($request, $id)
    {
        // $response=array();
        // $response["status"]=false;
        // $response["data"] ="";

        // DB::beginTransaction();
        // try
        // {
        //     $response["data"]=Role::where("id",$id)
        //     ->update([
        //         "status" => $request->status=="true"?1:0,
        //     ]);
        //     DB::commit();
        //     $response["status"] = true;
        // }
        // catch (\Exception $e)
        // {
        //     $response["data"]=$e->getMessage().", line:".$e->getLine();
        //     $response["status"] = false;
        //     DB::rollback();
        // }

        // return response()->json($response);
    }
       public function update($request,  $id)
    {
        // $response=array();
        // $response["status"]=false;
        // $response["data"] ="";

        // DB::beginTransaction();
        // try
        // {
        //     $response["data"]=Role::where("id",$id)
        //     ->update([
            //     ]);
            //     DB::commit();
            //     $response["status"] = true;
            // }
            // catch (\Exception $e)
            // {
            //     $response["data"]=$e->getMessage().", line:".$e->getLine();
            //     $response["status"] = false;
            //     DB::rollback();
            // }
    
            // return response()->json($response);
    }


    public function destroy($id)
    {
        // $response=array();
        // $response["status"]=false;
        // $response["data"] = Banner::find($id);
        // if($response["data"])
        //  {
        //         $response["data"]=$response["data"]->delete();
        //         $response["status"]=true;

        //  }
        //  else
        //  {
        //      $response["data"]="Data Not deleted";
        //  }
        // return response()->json($response);
    }
}
        