<?php
namespace App\Repositories\CMS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Amenity;
use Illuminate\Support\Facades\Auth;

class AmenityRepository
{
    private $amenity;
    public function __construct()
    {
        $this->amenity = $this->amenity;
    }
    public function index($request)
    {
       
        $data=Amenity::orderBy('id', 'DESC');  
        if(isset($request->search) && !empty($request->search))
        {
            $data=$data->where('title',  $request->search);
        } 
        if(isset($request->show) && !empty($request->show))
        {
            $show=$request->show;
            $data=$data->paginate($show);
        }
        else
        {
            $data=$data->paginate(20);
        }
        return $data;
    }
    public function create()
    {
        //
    }
    public function store($request)
    {
        $response=array();
        $response["status"]=false;
        $response["data"] ="";
        $auth_id = Auth::id();
        DB::beginTransaction();
        try {
            $response["data"]=Amenity::create([
            'user_id' => $auth_id,
            'title' => $request->title,
            'icon' => $request->icon,
            'status' => 1,
            ]);
            DB::commit();
            $response["status"] = true;
        } catch (\Exception $e) {
            $response["data"]=$e->getMessage();
            $response["status"] = false;
            DB::rollback();
        }

        return response()->json($response);
    }
    public function show($id)
    {
        //
    }

    public function edit($request, $id)
    {
        $response=array();
        $response["status"]=false;
        $response["data"] ="";

        DB::beginTransaction();
        try
        {
            $response["data"]=Amenity::where("id",$id)
            ->update([
                "status" => $request->status=="true"?1:0,
            ]);
            DB::commit();
            $response["status"] = true;
        }
        catch (\Exception $e)
        {
            $response["data"]=$e->getMessage().", line:".$e->getLine();
            $response["status"] = false;
            DB::rollback();
        }

        return response()->json($response);
    }
       public function update($request,  $id)
    {
        $response=array();
        $response["status"]=false;
        $response["data"] ="";

        DB::beginTransaction();
        try
        {
            $response["data"]=Amenity::where("id",$id)
            ->update([
                'title' => $request->title,
                'icon' => $request->icon,
                ]);
                DB::commit();
                $response["status"] = true;
            }
            catch (\Exception $e)
            {
                $response["data"]=$e->getMessage().", line:".$e->getLine();
                $response["status"] = false;
                DB::rollback();
            }
    
            return response()->json($response);
    }


    public function destroy($id)
    {
        $response=array();
        $response["status"]=false;
        $response["data"] = Amenity::find($id);
        if($response["data"])
         {
                $response["data"]=$response["data"]->delete();
                $response["status"]=true;
         }
         else
         {
             $response["data"]="Data Not deleted";
         }
        return response()->json($response);
    }
}
        