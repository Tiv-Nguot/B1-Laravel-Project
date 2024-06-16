<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'image_url',
        'description',
        'user_id',
    ];

    public static function list(){
        return Post::where('user_id',auth()->user()->id)->get();
    }
    
    public static function userDelete(string $id)
    {
        return Post::where('user_id', auth()->user()->id)->delete($id);
    }

    public static function userUpdate(string $id)
    {
        return Post::where('user_id', auth()->user()->id)->put($id);
    }

}
