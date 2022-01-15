<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class Repository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repo {name} {--path=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new Repository,Service,Controller,Model';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->argument("name");

        $model = app_path("Models/{$name}.php");
        if(file_exists($model))
        {
            $this->info("{$name} Model exists");
        }else{
            $this->createModel($name, $model);
        }

        $nameF = $name;
        $optionalPath = $this->option("path") ?? '';
        if(!empty($this->option("path")))
        {
            $nameF = $this->option("path")."/".$name;
        }
        $controller = app_path("Http/Controllers/{$nameF}Controller.php");
        if(file_exists($controller))
        {
            $this->info("{$name} Controller exists");
        }else{
            $this->createController($name, $controller, $nameF, $optionalPath);
        }

        $services = app_path("Services/{$nameF}Service.php");
        if(file_exists($services))
        {
            $this->info("{$name} Service exists");
        }else{
            $this->createService($name, $services, $nameF, $optionalPath);
        }


        $repository = app_path("Repositories/{$nameF}Repository.php");
        if(file_exists($repository))
        {
            $this->info("{$name} Repository exists");
        }else{
            $this->createRepository($name, $repository, $nameF, $optionalPath);
        }


        $seeder = "database/seeders/{$nameF}Seeder.php";
        if(file_exists($seeder))
        {
            $this->info("{$name} Seeder exists");
        }else{
            $this->createSeeder($name, $seeder);
        }

        
        $this->createMigration($name);

        $this->info("Scaffolding Generated Successfully");
        return 0;
    }

    private function createModel($name, $path)
    {
        $php = '<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
class '.$name.' extends Model
{
    use HasFactory, SoftDeletes;
    protected $table ="'.lcfirst($name).'";
    protected $guarded = [];
}
        ';
        File::put($path, $php);
        $this->info("{$name} Model created successfully ");
    }
    private function createController($name, $path, $nameF, $optionalPath = '')
    {
        $php = '<?php
namespace App\Http\Controllers\\'.(str_replace("/", "\\", $optionalPath)).';
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\\'.(str_replace("/", "\\", $nameF)).'Service;
class '.$name.'Controller extends Controller
{
    private $'.lcfirst($name).'Service;
    public function __construct('.$name.'Service $'.lcfirst($name).'Service)
    {
        $this->'.lcfirst($name).'Service = $'.lcfirst($name).'Service;
    }
    public function index(Request $request)
    {
        $data = $this->'.lcfirst($name).'Service->index($request);
        return $data;
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $data = $this->'.lcfirst($name).'Service->store($request);
        return $data;
    }
    public function show($id)
    {
        $data = $this->'.lcfirst($name).'Service->show($id);
        return $data;
    }
    public function edit(Request $request, $id)
    {
        $data = $this->'.lcfirst($name).'Service->edit($request, $id);
        return $data;
    }
    public function update(Request $request, $id)
    {
        $data = $this->'.lcfirst($name).'Service->update($request, $id);
        return $data;
    }
    public function destroy($id)
    {
        $data = $this->'.lcfirst($name).'Service->destroy($id);
        return $data;
    }
}
        ';
        File::put($path, $php);
        $this->info("{$name} Controller created successfully ");
    }



    private function createService($name, $path, $nameF, $optionalPath = '')
    {
        $php = '<?php
namespace App\Services\\'.(str_replace("/", "\\", $optionalPath)).';
use App\Repositories\\'.(str_replace("/", "\\", $nameF)).'Repository;
class '.$name.'Service
{
    private $'.lcfirst($name).'Repository;
    public function __construct('.$name.'Repository $'.lcfirst($name).'Repository)
    {
        $this->'.lcfirst($name).'Repository = $'.lcfirst($name).'Repository;
    }
    public function index($request)
    {
        $data = $this->'.lcfirst($name).'Repository->index($request);
        return $data;
    }
    public function create()
    {
        //
    }
    public function store($request)
    {
        $data = $this->'.lcfirst($name).'Repository->store($request);
        return $data;
    }
    public function show($id)
    {
        $data = $this->'.lcfirst($name).'Repository->show($id);
        return $data;
    }
    public function edit($request, $id)
    {
        $data = $this->'.lcfirst($name).'Repository->edit($request, $id);
        return $data;
    }
    public function update($request, $id)
    {
        $data = $this->'.lcfirst($name).'Repository->update($request, $id);
        return $data;
    }
    public function destroy($id)
    {
        $data = $this->'.lcfirst($name).'Repository->destroy($id);
        return $data;
    }
}


        ';
        File::put($path, $php);
        $this->info("{$name} Service created successfully ");


       

}


private function createRepository($name, $path, $nameF, $optionalPath = '')
    {
        $php = '<?php
namespace App\Repositories\\'.(str_replace("/", "\\", $optionalPath)).';
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\\'.$name.';
class '.$name.'Repository
{
    private $'.lcfirst($name).';
    public function __construct()
    {
        $this->'.lcfirst($name).' = $this->'.lcfirst($name).';
    }
    public function index($request)
    {
       
        //$data='.$name.'::get();
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
        //     $response["data"]='.$name.'::create([
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
        //     $response["data"]='.$name.'::where("id",$id)
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
        //     $response["data"]='.$name.'::where("id",$id)
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
        // $response["data"] = '.$name.'::find($id);
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
        ';
        File::put($path, $php);
        $this->info("{$name} Repository created successfully ");
    }


    private function createMigration($name)
    {
        Artisan::call('make:migration create_'.lcfirst($name).'_table --create='.lcfirst($name));
        $this->info("{$name} Migration  created successfully ");
    }

    private function createSeeder($name,$path)
    {
        Artisan::call('make:seeder '.$name.'Seeder');
    $this->info("{$name} Repository created successfully ");
}

}