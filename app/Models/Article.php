<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    
    protected $fillable = ['title', 'content', 'type_id', 'shop', 'pref_id', 'address', 'image'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function getPrefNameAttribute() {
        return config('pref.'.$this->pref_id);
    }
    
    public function getTypeNameAttribute() {
        return config('pudding_types.'.$this->type_id);
    }
    
}
