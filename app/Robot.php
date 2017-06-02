<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Robot extends Model
{
	protected $fillable = [
		'name', 'description', 'category_id', 'status', 'link'
	];

    public function category() {
    	// propriétaire car elle possède la clé secondaire category_id
    	return $this->belongsTo(Category::class);
    }
    
    public function tags() {
    	return $this->belongsToMany(Tag::class);
    }

    public function setNameAttribute($value) {
     
         $this->attributes['name']= ucfirst($value);
         $this->attributes['slug']= str_slug($value);
     
    }

    public function isTag(int $tagId){    
        
        foreach($this->tags as $tag){        
            if($tag->id == $tagId) return true;        
        }
        
        return false;    
    }

    public function users() {
        return $this->belongsTo(User::class);
    }

    public function scopePublished($query, $status = 'published'){
        
        return $query->where('status', $status)
                     ->orderBy('published_at', env('ORDER_ROBOT', 'DESC')); // .env à définir
    
    }

    public function scopeType(){

        
        
    }

  
}
