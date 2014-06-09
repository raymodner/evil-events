<?php

class AuthController extends BaseController{
    
    public function loginAction()
    {
       if(Auth::attempt(array('email' => Input::json('email'), 'password' => Input::json('password')))){
           return Response::json(Auth::user());
       }else{
           return Response::json(array('flash' => 'Invalid username or password'), 500);
       } 
        
    }
    
    public function logoutAction()
    {
        
    }
    
    
}