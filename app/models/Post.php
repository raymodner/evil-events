<?php

class Post extends Eloquent
{
 
    
    public function author()
    {
        return $this->belongsTo('User', 'author_id');
    }
    
    
    protected $fillable = array('title', 'body', 'author_id');
    
    protected $guarded = array('id');
    
}
