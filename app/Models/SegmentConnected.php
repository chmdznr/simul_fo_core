<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SegmentConnected extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'segment_connecteds';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'segid',
        'alias',
        'site_point_1_id',
        'site_point_2_id',
        'total_core',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function segment1CoreConfigs()
    {
        return $this->hasMany(CoreConfig::class, 'segment_1_id', 'id');
    }

    public function segment2CoreConfigs()
    {
        return $this->hasMany(CoreConfig::class, 'segment_2_id', 'id');
    }

    public function site_point_1()
    {
        return $this->belongsTo(SitePoint::class, 'site_point_1_id');
    }

    public function site_point_2()
    {
        return $this->belongsTo(SitePoint::class, 'site_point_2_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
