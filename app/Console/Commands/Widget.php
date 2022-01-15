<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class Widget extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:widget {name} {--path=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new advance CMS architecture widget';

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
        $widgetClass = app_path("Widgets/{$name}.php");
        if(file_exists($widgetClass))
        {
            $this->info("{$name} Widget class exists");
        }else{
            $this->createWidgetClass($name, $widgetClass);
        }

        $nameF = $name;
        $bladeName = strtolower($this->getWidgetBladeName($name));
        if(!empty($this->option("path")))
        {
            $nameF = $this->option("path")."/".$bladeName;
        }
        $widgetBlade = base_path("resources/views/{$nameF}.blade.php");
        if(file_exists($widgetBlade))
        {
            $this->info("{$name} Widget blade exists");
        }else{
            $this->createWidgetBlade($name, $widgetBlade);
        }

        $this->info("..");
        $this->info("..");
        $this->info("Advance widget architecture created successfully (By MM)");

        return 0;
    }

    private function createWidgetClass($name, $path)
    {
        $php = '<?php
namespace App\Widgets;

        
class '.$name.'
{
    private $widget;
        
    public function __construct($widget)
    {
        $this->widget = $widget;
    }
    
    public function register()
    {
        return ["no-cache" => false, "tags" => ["'.$name.'"]];
    }

    public function process()
    {
        //return data
        return ["data" => "data"];
    }

}
        ';
        File::put($path, $php);
        $this->info("{$name} Widget class created successfully (By MM)");
    
}


    private function createWidgetBlade($name, $path)
    {
        $html = 'New Widget Created (By MM)';
        File::put($path, $html);
        $this->info("{$name} Widget blade created successfully (By MM)");
    
    }

    public function getWidgetBladeName($name)
    {
        $output = preg_split('/(?=[A-Z])/', $name, -1, PREG_SPLIT_NO_EMPTY);
        return join("-", $output);
    }


}
