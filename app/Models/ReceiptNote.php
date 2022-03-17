<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReceiptNote extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;
    use HasFactory;

    public const PRINT_SELECT = [
        'pdf' => 'PDF',
    ];

    public const SHIFT_SELECT = [
        '1' => 'Prva',
        '2' => 'Druga',
        '3' => 'Treća',
    ];

    public const QC_SELECT = [
        'ispravno'   => 'ispravno',
        'neispravno' => 'neispravno',
    ];

    public const CONDITIONS_SELECT = [
        'Čuvati na suvom i tamnom mestu.'                        => 'Čuvati na suvom i tamnom mestu.',
        'Čuvati u frižideru.'                                    => 'Čuvati u frižideru.',
        'Čuvati na suvom i hladnom mestu.'                       => 'Čuvati na suvom i hladnom mestu.',
        'Čuvati na suvom i tamnom mestu, na sobnoj temperaturi.' => 'Čuvati na suvom i tamnom mestu, na sobnoj temperaturi.',
    ];

    public $table = 'receipt_notes';

    public static $searchable = [
        'lot',
        'int_lot',
    ];

    protected $dates = [
        'expiry_date',
        'date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'client_id',
        'quantity',
        'lot',
        'int_lot',
        'expiry_date',
        'warehouse_id',
        'sector_id',
        'shelf',
        'qc',
        'conditions',
        'shift',
        'date',
        'place',
        'driver',
        'id_driver',
        'registration',
        'created_at',
        'print',
        'issuer_id',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    public function client()
    {
        return $this->belongsTo(CrmCustomer::class, 'client_id');
    }

    public function products()
    {
        return $this->belongsToMany(ProductsList::class);
    }

    public function getExpiryDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setExpiryDateAttribute($value)
    {
        $this->attributes['expiry_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function warehouse()
    {
        return $this->belongsTo(WarehousesList::class, 'warehouse_id');
    }

    public function sector()
    {
        return $this->belongsTo(WarehouseSector::class, 'sector_id');
    }

    public function getDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function issuer()
    {
        return $this->belongsTo(User::class, 'issuer_id');
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
