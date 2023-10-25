<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Capsule\Manager as Capsule;
use Carbon\Carbon;

class Product extends Model
{
    public function genPaginate($limit)
    {
        $categories = [];
        $table = $this->getTable();
        $cats = Capsule::select("SELECT * FROM $table ORDER BY id DESC" . $limit);
        foreach ($cats as $cat) {
            $date = new Carbon($cat->created_at);
            array_push($categories, [
                "id" => $cat->id,
                "name" => $cat->name,
                "price" => $cat->price,
                "cat_id" => $cat->cat_id,
                "sub_cat_id" => $cat->sub_cat_id,
                "image" => $cat->image,
                "description" => $cat->description,
                "created_at" => $date->toFormattedDateString()
            ]);
        }
        return $categories;
    }
}
