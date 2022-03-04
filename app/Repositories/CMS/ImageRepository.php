<?php
namespace App\Repositories\CMS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Image;
use App\Models\ImageFolder;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ImageRepository
{
    use ImageTrait;

    private $image;
    public function __construct()
    {
        $this->image = $this->image;
    }
    public function index($request)
    {
        // print_r('hi');
        $auth_id=Auth::id();
        $data=Image::orderBy('id','ASC');
        // ->where('user_id',$auth_id);
        if(isset($request->image_folder_id) && !empty($request->image_folder_id))
        {
            $data= $data->where('image_folder_id',$request->image_folder_id);
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
        $data->map(function($item){

            $item->src = $this->getImage($item->id);
        });

        return $data;
    }
    public function create()
    {
        //
    }


    public function store($request)
    {
        // dd($request->all());
        $auth_id=Auth::id();
        $response=array();
        $response['status']=false;
        $response['data'] ='';
        // dd($request->all());
        $validator = Validator::make(
            $request->all(), [
                'folder_id' => 'required',
                'myFile.*' => 'required|image|max:3000'
                ]);
        if ($validator->fails()) {
            $response['data'] =$validator->errors();
            return response()->json($response,200);
        }
        DB::beginTransaction();

        try {
            $response['data']=array();
            foreach($request->myFile as $media)
            {
                $digits = 6;
                $data=Image::create([
                    'user_id' => $auth_id,
                    'image_folder_id' => $request->folder_id,
                    'title' => $media->getClientOriginalName(),
                    'file_name' => $media->getClientOriginalName(),
                    'extension' => pathinfo($media->getClientOriginalName(), PATHINFO_EXTENSION),
                    'salt' => rand(pow(10, $digits-1), pow(10, $digits)-1),
                    'status' => 1,

                ]);

                $date = strtotime($data->created_at);
                $media->storeAs(('public/files/images/'.date('Y', $date).'/'.date('m', $date).'/'.date('d', $date).'/'.strtotime($data->created_at).'-'.$data->salt.'/'),date('Y', $date).date('m', $date).date('d', $date).'_'. strtotime($data->created_at).'-'.$data->salt.'.'.$data->extension);  
                $data->src = $this->getImage($data->id);
                array_push($response['data'],$data);
            }
            DB::commit();
            $response['status'] = true;
        } catch (\Exception $e) {
            $response['data']=$e->getMessage();
            DB::rollback();
        }

        return response()->json($response);
    }
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update($request, $id)
    {
        $response=array();
        $response['status']=false;
        $response['data'] ='';
        $validator = Validator::make(
            $request->all(), [
            'name' => 'required|string|max:255',
            'parent_id' => 'required',
        ]);
        if ($validator->fails()) {
            $response['data'] =$validator->errors();
            return response()->json($response,200);
        }

        DB::beginTransaction();
        try {
            $response['data']=ImageFolder::where('id',$id)
            ->update($request->all());
            DB::commit();
            $response['status'] = true;
        } catch (\Exception $e) {
            $response['data']=$e->getMessage();
            $response['status'] = false;
            DB::rollback();
        }

        return response()->json($response);
    }
    public function destroy($id)
    {
        $response=array();
        $response['status']=false;
        $response['data'] = Image::find($id);
        if($response['data'])
        {
                $response['data']=$response['data']->delete();
                $response['status']=true;
        }
        else
        {
            $response['data']="Status not Exist";
        }
        return response()->json($response);

    }

}
