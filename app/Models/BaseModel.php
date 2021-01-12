<?php
namespace App\Models;

use App\Models\QueryFilters\QueryFilter;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{

    public function scopeFilter($query, QueryFilter $filters)
    {
        return $filters->apply($query);
    }

    public static function findById($id, $field = null)
    {
        $item = self::where('id', '=', $id)->first();
        if (!$item) {
            return null;
        }
        if (!$field) {
            return $item;
        }
        return @$item->{$field};

    }
}
