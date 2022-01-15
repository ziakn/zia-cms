<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class Scope extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:scope {scopeName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new scope';

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
        $scope = $this->argument("scopeName");
        $scopePath = app_path("Scopes/{$scope}Scope.php");
        $php = '<?php        
namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
        
class '.$scope.'Scope implements Scope{
           
    public function apply(Builder $builder, Model $model)
    {
        $builder->whereStatus(1);
    }
}

        ';
        File::put($scopePath, $php);
        $this->info("{$scope} Scope created successfully (By MM)");
        return 0;
    }
}
