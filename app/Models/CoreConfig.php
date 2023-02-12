<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CoreConfig extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const SPLICE_TYPE_SELECT = [
        'nosplice' => 'No Splice',
        'splice'   => 'splice',
    ];

    public $table = 'core_configs';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'segment_1_id',
        'segment_2_id',
        'splice_type',
        'asset_connector_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function coreConfigCoreConnections()
    {
        return $this->hasMany(CoreConnection::class, 'core_config_id', 'id');
    }

    public function segment_1()
    {
        return $this->belongsTo(SegmentConnected::class, 'segment_1_id');
    }

    public function segment_2()
    {
        return $this->belongsTo(SegmentConnected::class, 'segment_2_id');
    }

    public function asset_connector()
    {
        return $this->belongsTo(Asset::class, 'asset_connector_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
