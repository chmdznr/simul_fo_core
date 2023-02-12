<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SitePoint extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'site_points';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'sid',
        'site_name',
        'latitude',
        'longitude',
        'address',
        'kode_pos',
        'kelurahan',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'region',
        'area',
        'cluster',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function siteAssets()
    {
        return $this->hasMany(Asset::class, 'site_id', 'id');
    }

    public function sitePoint1SegmentConnecteds()
    {
        return $this->hasMany(SegmentConnected::class, 'site_point_1_id', 'id');
    }

    public function sitePoint2SegmentConnecteds()
    {
        return $this->hasMany(SegmentConnected::class, 'site_point_2_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
