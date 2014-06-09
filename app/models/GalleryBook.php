<?php

class GalleryBook extends Eloquent
{
 
    public function author()
    {
        return $this->belongsTo('User', 'author_id');
    }
    
    public function galleryItems()
    {
        return $this->hasMany('GalleryItem');
    }
    
    protected $fillable = array('title', 'description');
    
    protected $guarded = array('id', 'author_id');
    
}
