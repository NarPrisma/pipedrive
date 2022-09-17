<?php

namespace Pipedrive\Http;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PipeDrive
 * @package App/Models
 * @property  string lead_label
 * @property-read  string label
 *
 */
class PipeDriveLead extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * @return mixed
     */
    public function getLabelAttribute()
    {
       return json_decode($this->lead_label);
    }

}
