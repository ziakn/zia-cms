<?php
namespace App\Repositories\CMS;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
class UserRepository
{
    private $user;
    public function __construct()
    {
        $this->user = new User();
    }
    public function index($request)
    {
       
        $data=User::orderBy('id','DESC');    
        if(isset($request->show) && !empty($request->show))
        {
            $show=$request->show;
            $data=$data->paginate($show);
        }
        else
        {
            $data=$data->get();
        }

        $data->map(function($item){
            $item->role_id = $item->roles->pluck('id')[0]??NULL;
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
        $response=array();
        $response['status']=false;
        $response['data'] ='';
        DB::beginTransaction();
        try 
        {
           

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'mobile' => $request->mobile,
                'address' => $request->address,
                'status' => 1,
                'image' => '/profile.png',
            ]);
            $user->assignRole($request->role_id);
            DB::commit();
            $response['data']=User::find($user->id);  
            $response['status'] = true;
        } catch (\Exception $e) {
            $response['data']=$e->getMessage();
            $response['status'] = false;
            DB::rollback();
        }
            
        return response()->json($response);


        // $this->validate($request, [
        //     'name' => 'required',
        //     'email' => 'required|email|unique:users,email',
        //     'password' => 'required|same:confirm-password',
        //     'roles' => 'required'
        // ]);
    
        // $input = $request->all();
        // $input['password'] = Hash::make($input['password']);
    
        // $user = User::create($input);
        // $user->assignRole($request->input('roles'));
    
        // return redirect()->route('users.index')
        //                 ->with('success','User created successfully');
    }
    public function show($id)
    {
        $data=User::find($id);
        return $data;
    }

    public function edit($request, $id)
    {
        $response=array();
        $response["status"]=false;
        $response["data"] ="";

        DB::beginTransaction();
        try
        {
            $response["data"]=User::where("id",$id)
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
        $response['status']=false;
        $response['data'] ='';
        DB::beginTransaction();
        try {
           User::where('id',$id)
            ->update(
            [
                'name' => $request->name,
                'mobile' => $request->mobile,
                'address' => $request->address,
            ]
        );
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user=User::find($id);

        $user->assignRole($request->role_id);

        DB::commit();
        $response['status'] = true;
        $response['data']=User::find($user->id);   
        } catch (\Exception $e) {
            $response['data']=$e->getMessage();
            $response['status'] = false;
            DB::rollback();
        }
            
        return response()->json($response);

            // $this->validate($request, [
            //     'name' => 'required',
            //     'email' => 'required|email|unique:users,email,'.$id,
            //     'password' => 'same:confirm-password',
            //     'roles' => 'required'
            // ]);
        
            // $input = $request->all();
            // if(!empty($input['password'])){ 
            //     $input['password'] = Hash::make($input['password']);
            // }else{
            //     $input = Arr::except($input,array('password'));    
            // }
        
            // $user = User::find($id);
            // $user->update($input);
            // DB::table('model_has_roles')->where('model_id',$id)->delete();
        
            // $user->assignRole($request->input('roles'));
        
            // return redirect()->route('users.index')
            //                 ->with('success','User updated successfully');
    }


    public function destroy($id)
    {
        $response=array();
        $response["status"]=false;
        $response["data"] = User::find($id);
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
        