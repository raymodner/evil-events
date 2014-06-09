<?php

class GalleryItem extends Eloquent
{
 
    const IMAGE = 1;
    const BLOG  = 2;
    const IMAGEFOLDER = 'image';
    const BLOGFOLDER = 'blog';
    
    private static $folders = array(
        SELF::IMAGE => SELF::IMAGEFOLDER,
        SELF::BLOG => SELF::BLOGFOLDER
    );
    
    
    public static function getFolder($key){
        return self::$folders[$key];
    }
    
    public function author()
    {
        return $this->belongsTo('User', 'author_id');
    }
    
    public function galleryBook()
    {
        return $this->belongsTo('GalleryBook', 'gallery_book_id');
    }
    
    protected $fillable = array('description', 'name', 'filename', 'originalname', 'type', 'description', 'mimetype', 'filesize', 'ext');
    
    protected $guarded = array('id', 'gallery_book_id', 'author_id');
    
    
    
    public function uploadFile($dataDir, $type, $file, $item = null)
    {
        if($item == null) $item = $this;
        if(!file_exists($dataDir. DIRECTORY_SEPARATOR . self::getFolder($type)))
        {
            mkdir($dataDir . DIRECTORY_SEPARATOR .self::getFolder($type), 0777);
        }
        $file->move($dataDir . DIRECTORY_SEPARATOR .self::getFolder($type), $item->id.'.'.$file->getClientOriginalExtension());
    }
    
    
    public function fileInfo($file)
    {
        $this->originalname = $file->getClientOriginalName();
        $this->mimetype = $file->getClientMimeType();
        $this->filesize = $file->getClientSize();
        $this->ext = $file->getClientOriginalExtension();
    }
}
