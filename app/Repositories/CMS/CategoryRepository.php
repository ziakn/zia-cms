<?php
namespace App\Repositories\CMS;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryRepository
{
    private $category;
    public function __construct()
    {
        $this->category = new Category();
    }
    public function index($request)
    {
       
        //$data=Category::get();
        //return $data;
        
        $data = Category::orderBy('sort','ASC');
        if(isset($request->parent_id) && !empty($request->parent_id))
        {
            $data=$data->where('parent_id',  $request->parent_id);
        }   
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
        DB::beginTransaction();
        try {
            $response["data"]=Category::create([
            'title' => $request->title,
            'description' => $request->description,
            'parent_id' => $request->parent_id,
            'status' => 1,
            'link' => $request->link,
            'image_id' => $request->image_id,
            'slug' => $request->slug,
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
            $response["data"]=Category::where("id",$id)
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
            $response["data"]=Category::where("id",$id)
            ->update([
                'title' => $request->title,
                'description' => $request->description,
                'parent_id' => $request->parent_id,
                'link' => $request->link,
                'image_id' => $request->image_id,
                'slug' => $request->slug,
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
        $response["data"] = Category::find($id);
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
        