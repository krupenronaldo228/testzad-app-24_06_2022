<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $category
 * @property float $price
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Catalog extends Model
{
    protected $table = 'catalogs';

    protected $guarded = [];

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = round($value, 2);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucfirst($value);
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = ucfirst($value);
    }

    public function getPriceAttribute($value)
    {
        return strval($this->attributes['price']).'$';
    }

    public function getCreatedAtAttribute($value)
    {
        return $this->attributes['created_at']->format('d.m.Y H:i:s');
    }

    public function getUpdatedAtAttribute($value)
    {
        return $this->attributes['updated_at']->format('d.m.Y H:i:s');
    }
}
