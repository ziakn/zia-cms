<?php
namespace App\Http\Controllers\CMS;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CMS\RoleService;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    private $roleService;
    public function __construct(RoleService $roleService)
    {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
         $this->middleware('permission:role-create', ['only' => ['create','store']]);
         $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:role-delete', ['only' => ['destroy']]);
        $this->roleService = $roleService;
    }
    public function index(Request $request)
    {
        $data =   Role::orderBy('id','DESC');
        if(isset($request->show) && !empty($request->show))
        {
            $show=$request->show;
            $data=$data->paginate($show);
        }
        else
        {
            $data=$data->get();
        }
        return $data;
    }
    public function getpermission()
    {
        $data = Permission::get();
        return $data;
    }
    public function store(Request $request)
    {
        $response=array();
        $response["status"]=false;
        $response["data"] ="";
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $response["data"] = Role::create(['name' => $request->input('name')]);
            $response["data"]->syncPermissions($request->input('permission'));
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
        $response['role'] = Role::find($id);
        $response['rolePermissions'] = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();
    
        // return view('roles.show',compact('role','rolePermissions'));
        return $response;
    }
    public function edit($id)
    {
        $response['role'] = Role::find($id);
        $response['permission'] = Permission::get();
        $response['rolePermissions'] = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
    
        // return view('roles.edit',compact('role','permission','rolePermissions'));
        return $response;
    }
    public function update(Request $request, $id)
    {

        $response=array();
        $response["status"]=false;
        $response["data"] ="";
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);
        DB::beginTransaction();
        try
        {
            $response["data"] = Role::find($id);
            $response["data"]->name = $request->input('name');
            $response["data"]->save();
    
            $response["data"]->syncPermissions($request->input('permission'));
    
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
        $response["data"]=DB::table("roles")->where('id',$id)->delete();
        $response["status"]=true;
        return response()->json($response);
    }
}
        