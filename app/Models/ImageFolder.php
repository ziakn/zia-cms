<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
class ImageFolder extends Model
{
    use HasFactory, SoftDeletes;
    protected $table ="imageFolder";
    protected $guarded = [];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    public function scopeNoRoot($query)
    {
        return $query->where('id','!=', 1);
    }
}
        