<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HalfProduct extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;
    use HasFactory;

    public $table = 'half_products';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'created_at',
        'name',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    public function halfProductMakes()
    {
        return $this->hasMany(HalfProductMake::class);
    }

    public function productionSpents()
    {
        return $this->belongsToMany(ProductionSpent::class)->withPivot('int_lot', 'quantity');
    }

    public function finishedProducts()
    {
        return $this->belongsToMany(CreateFinishedProduct::class, 'create_finished_product_half_product', 'half_product_id', 'finished_product_id')
            ->withPivot('int_lot', 'quantity');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
