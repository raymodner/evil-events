<?php

class MediaController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function indexAction( User $user)
	{
		//
        $data = array();
        $galleryBooks = GalleryBook::where('author_id', '=', $user->id)->get();
        $data['galleryBooks'] = $galleryBooks;
        $data['user'] = $user;
        return View::make('media/index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function newAlbumAction($user)
	{
		$album = new GalleryBook();
        $data = array(
            "requested" => Input::old("requested"),
            "action" => array("MediaController@newAlbumAction", Auth::user()->id),
            "user" => $user
        );
        if (Input::server("REQUEST_METHOD") == "POST")
        {
            $post = array('title' => Input::get('title'),
                          'description' => Input::get('description'));
            
            $validator = Validator::make($post, array(
                "title" => "required|min:3|max:128",
            ));
            if ($validator->passes())
            {
                $data["requested"] = true;
                $album->fill($post);
                $album->author()->associate(Auth::user());
                $album->save();
                return Redirect::to('media/album/'.$album->id);
            }
            $data['errors'] = $validator;
        }
        $data['album'] = $album;
        return View::make("media/albumform", $data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function showAction($galleryBook)
	{
		$data = array();
        $data['galleryBook'] = $galleryBook;
        return View::make('media/show', $data);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function newItemAction($galleryBook)
	{
		$galleryItem = new GalleryItem();
        $data = array(
            "requested" => Input::old("requested"),
            "action" => array("MediaController@newItemAction", $galleryBook->id),
            "galleryBook" => $galleryBook
        );
        if (Input::server("REQUEST_METHOD") == "POST")
        {
            $file = Input::file('file');
            $post = array('name' => Input::get('name'),
                          'description' => Input::get('description'),
                          'file' => $file);
            
            $validator = Validator::make($post, array(
                "name" => "required|min:3|max:128",
                'file' => 'image'
            ));
            if ($validator->passes())
            {
                $data["requested"] = true;
                $post['type'] = GalleryItem::IMAGE;
                $galleryItem->fill($post);
                $galleryItem->fileInfo($file);
                $galleryItem->author()->associate(Auth::user());
                $galleryItem->galleryBook()->associate($galleryBook);
                $galleryItem->save();
                $galleryItem->uploadFile($this->getDataDir(), GalleryItem::IMAGE, $file, $galleryItem);
                return Redirect::to('media/album/'.$galleryBook->id);
            }
            $data['errors'] = $validator;
        }
        $data['galleryItem'] = $galleryItem;
        return View::make("media/itemform", $data);
        
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
    
    

}