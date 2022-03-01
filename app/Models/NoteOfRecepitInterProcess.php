<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NoteOfRecepitInterProcess extends Model
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

    public $table = 'note_of_recepit_inter_processes';

    protected $dates = [
        'date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'int_lot_id',
        'quantity',
        'warehouse_id',
        'qc',
        'conditions',
        'shift',
        'date',
        'issuer_id',
        'received_by_id',
        'print',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    public function products()
    {
        return $this->belongsToMany(ProductsList::class);
    }

    public function int_lot()
    {
        return $this->belongsTo(ReceiptNote::class, 'int_lot_id');
    }

    public function warehouse()
    {
        return $this->belongsTo(WarehousesList::class, 'warehouse_id');
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

    public function received_by()
    {
        return $this->belongsTo(User::class, 'received_by_id');
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
