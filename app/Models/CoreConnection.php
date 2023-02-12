<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CoreConnection extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'core_connections';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'core_config_id',
        'core_number_1',
        'core_number_2',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function core_config()
    {
        return $this->belongsTo(CoreConfig::class, 'core_config_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
