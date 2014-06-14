<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::model('user', 'User');
Route::model('gallerybook', 'GalleryBook');
Route::model('galleryitem', 'GalleryItem');


/**
 * User
 */
Route::group(array("before" => "guest"), function()
{
//    Route::any("/", array(
//        "as"   => "user/login",
//        "uses" => "UserController@loginAction"
//    ));
//    Route::any("/request", array(
//        "as"   => "user/request",
//        "uses" => "UserController@requestAction"
//    ));
//    Route::any("/reset", array(
//        "as"   => "user/reset",
//        "uses" => "UserController@resetAction"
//    ));

	Route::any("/", array(
		"as"   => "home",
		"uses" => "homeController@indexAction"
	));
});
Route::group(array("before" => "auth"), function()
{

    //user
    Route::any("/profile", array(
        "as"   => "user/profile",
        "uses" => "UserController@profileAction"
    ));
    Route::any("/logout", array(
        "as"   => "user/logout",
        "uses" => "UserController@logoutAction"
    ));
    
    
});
Route::get("/home", function(){
    return Redirect::to('/');
    
});
/**
 * Image
 */
Route::get('/photo/{type}/{w}X{h}/{name}',array(
        'as' => '_image',
        'uses' => 'PhotoController@showAction'));
        
        
   //     '');

/**
 * Blog module
 */
Route::get("/blog", array(
   "as"     => "blog",
   "uses"   => "BlogController@indexAction"
));

Route::get("/blog/show/{num}", array(
    "as"     => "blog/post",
    "uses"  => "BlogController@blogAction"
    
));
Route::any("blog/new", array(
   "as"     => "blog/new",
   "uses"   => "BlogController@newAction"
));

Route::post('blog/uploadfile', array(
   "as"     => "blog/uploadfile",
   "uses"   => "BlogController@uploadfileAction"
    
));

Route::any('blog/edit/{id}', array(
   "as"     => "blog/edit",
    "uses"  => "BlogController@editAction"
));


/**
 * Contact
 */

Route::any("contact", array(
	"as"     => "contact",
	"uses"   => "ContactController@indexAction"
));


Route::any("contact/add", array(
	"as"     => "contact/add",
	"uses"   => "ContactController@addAction"
));


/**
 * Event
 */

Route::any("evenementen", array(
	"as"     => "evenementen",
	"uses"   => "EventController@indexAction"
));
/**
 * Report
 */

Route::any("portfolio", array(
	"as"     => "portfolio",
	"uses"   => "ReportController@indexAction"
));



/**
 * Gallery
 */
Route::get('media/list/{user}', array(
        'as' => 'media/list',
        'uses' => 'MediaController@indexAction'));

Route::get('media/album/{gallerybook}', 'MediaController@showAction');

Route::get('media/showitem/{galleryitem}', 'MediaController@showItemAction');

Route::any('album/new/{user}', array(
    'as' => 'album/new',
    'uses' => 'MediaController@newAlbumAction'));

Route::any('album/item/new/{gallerybook}', array(
    'as' => 'album/item/new',
    'uses' => 'MediaController@newItemAction'));



route::post('auth/login', 'AuthController@loginAction');
route::get('auth/logout', 'AuthController@logoutAction');
