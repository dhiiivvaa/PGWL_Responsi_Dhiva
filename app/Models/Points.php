<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Points extends Model
{
    use HasFactory;

    protected $table = 'table_points';

    // protected $fillable = [
    //     'name',
    //     'description',
    //     'geom',
    //     'image'
    // ];
    protected $guarded = ['id'];

    public function points()
    {
        return $this->select(DB::raw('id, name, description, ST_AsGeoJSON(geom) as geom, created_at, updated_at, image'))->get();
    }
    public function point($id)
    {
        return $this->select(DB::raw('id, name, description, ST_AsGeoJSON(geom) as geom, created_at, updated_at, image'))->where('id', $id)->get();
    }
}
