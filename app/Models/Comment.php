<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = ['id', 'title', 'image', 'user_id', 'post_id', 'like_id' ];



    public static function list()
    {
        $data = self::all();
        return $data;
    }

    public static function store($request, $id = null)
    {
        $data = $request->only('id', 'title', 'image', 'user_id', 'post_id', 'like_id');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }
        $data = self::updateOrCreate(['id' => $id], $data);
        return $data;
    }
}
