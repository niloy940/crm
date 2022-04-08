<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HalfProductMake extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'half_product_makes';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'halfproduct_id',
        'quantity',
        'processing_quantity',
        'finished_quantity',
        'int_lot',
        'made_by_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function halfproduct()
    {
        return $this->belongsTo(HalfProduct::class, 'halfproduct_id');
    }

    public function ingridients()
    {
        return $this->belongsToMany(ProductsList::class);
    }

    // public function int_lots()
    // {
    //     return $this->belongsToMany(ReceiptNote::class);
    // }

    public function internalLots()
    {
        return $this->belongsToMany(InternalLot::class)->withPivot('quantity');
    }

    public function made_by()
    {
        return $this->belongsTo(User::class, 'made_by_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
