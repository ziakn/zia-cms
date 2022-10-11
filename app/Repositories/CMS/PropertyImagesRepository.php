<?php
namespace App\Repositories\CMS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PropertyImages;
class PropertyImagesRepository
{
    private $propertyImages;
    public function __construct()
    {
        $this->propertyImages = $this->propertyImages;
    }
    public function index($request)
    {
       
        //$data=PropertyImages::get();
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
        //     $response["data"]=PropertyImages::create([
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
        //     $response["data"]=PropertyImages::where("id",$id)
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
        //     $response["data"]=PropertyImages::where("id",$id)
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
        // $response["data"] = PropertyImages::find($id);
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
        