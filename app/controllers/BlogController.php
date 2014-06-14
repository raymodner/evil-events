<?php

class BlogController extends BaseController {
    
    
    public function indexAction() {
        $data = array();
        $data['posts']= $blogPosts = Post::all();
        
        return View::make("blog/index", $data);
    }
    
    public function newAction()
    {
        $blog = new Post();
        $data = array(
            "requested" => Input::old("requested"),
            "action" => "BlogController@newAction"
        );
        if (Input::server("REQUEST_METHOD") == "POST")
        {
            $post = array('title' => Input::get('title'),
                          'body' => Input::get('body'));
            
            $validator = Validator::make($post, array(
                "title" => "required|min:3|max:128",
                "body"  => "required",
            ));
            if ($validator->passes())
            {
                $data["requested"] = true;
                $post['author_id'] = Auth::user()->id;
                $blog->fill($post);
                $blog->save();
                return Redirect::to('blog/show/'.$blog->id);
            }
            $data['errors'] = $validator;
        }
        $data['blog'] = $blog;
        return View::make("blog/new", $data);
    }
    
    public function blogAction($blogId)
    {
        $data = array();
        $blog = Post::find($blogId);
        $data ['blog'] =  $blog;
        return View::make("blog/blog", $data);
    }
    
    
    public function editAction( $blogId )
    {
         $data = array(
            "requested" => Input::old("requested"),
            "action"    => array('BlogController@editAction', $blogId)
        );
        $blog = Post::find($blogId);
        if (Input::server("REQUEST_METHOD") == "POST")
        {
            $post = array('title' => Input::get('title'),
                          'body' => Input::get('body'));
            $blog->fill($post);

            $validator = Validator::make($post, array(
                "title" => "required|min:3|max:128",
                "body"  => "required",
            ));
            if ($validator->passes())
            {
                $data["requested"] = true;
                $post['author_id'] = Auth::user()->id;
                $blog->fill($post);
                $blog->save();
                return Redirect::to('blog/show/'.$blog->id);
            }
            $data['errors'] = $validator->messages();
        }
        $data['blog'] = $blog;
        return View::make("blog/new", $data);
    }
    
    
    public function uploadfileAction()
    {
        $rules = array(
            'file' => 'image|max:10000'
         );

         $validation = Validator::make(Input::all(), $rules);
         $file = Input::file('file');
         if ($validation->fails())
         {
             return FALSE;
         }
        else
        {
             if (Input::file('file')->move('images/blog', $file->getClientOriginalName()))
             {
                return Response::json(array('filelink' => '/images/blog/' . $file->getClientOriginalName()));
             }
             return FALSE;
        }
    }
    
    
}