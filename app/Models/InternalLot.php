<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternalLot extends Model
{
    use HasFactory;

    public $table = 'internal_lots';

    protected $fillable = ['int_lot', 'quantity', 'reserved_quantity', 'products_list_id'];

    public function product()
    {
        return $this->belongsTo(ProductsList::class, 'products_list_id');
    }

    public function warehouseTransfer()
    {
        return $this->belongsToMany(WarehouseTransfer::class)->withPivot('reserved_quantity');
    }

    public function halfProductMakes()
    {
        return $this->belongsToMany(HalfProductMake::class)->withPivot('quantity');
    }
}
