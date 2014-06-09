<?php

use Illuminate\Support\MessageBag;

class UserController
extends BaseController
{
    public function loginAction()
    {
        $data = array();
        if (Input::server("REQUEST_METHOD") == "POST")
        {
            $validator = Validator::make(Input::all(), array(
                "username" => "required",
                "password" => "required"
            ));
            if ($validator->passes())
            {
                $credentials = array(
                    "username" => Input::get("username"),
                    "password" => Input::get("password")
                );
                if (Auth::attempt($credentials))
                {
                    return Redirect::route("user/profile");
                }
            }
            else
            {
                $data["errors"] = $validator->messages();
                $data["username"] = Input::get("username");
                return View::make("user/login",$data);
            }
        }
        return View::make("user/login", $data);
    }
    
    
    public function profileAction()
    {
        return View::make("user/profile");
    }
    
    
    public function requestAction()
    {
        $data = array(
            "requested" => Input::old("requested")
        );
        if (Input::server("REQUEST_METHOD") == "POST")
        {
            $validator = Validator::make(Input::all(), array(
                "email" => "required"
            ));
            if ($validator->passes())
            {
                $credentials = array(
                    "email" => Input::get("email")
                );
                Password::remind($credentials,
                    function($message, $user)
                    {
                        $message->from("raymond@oberon.nl");
                    }
                );
                $data["requested"] = true;
                return Redirect::route("user/request")
                    ->withInput($data);
            }
        }
        return View::make("user/request", $data);
    }
    
    
    
    public function resetAction()
    {
        $token = "?token=" . Input::get("token");
        $errors = new MessageBag();
        if ($old = Input::old("errors"))
        {
            $errors = $old;
        }
        $data = array(
            "token"  => $token,
            "errors" => $errors
        );
        if (Input::server("REQUEST_METHOD") == "POST")
        {
            $validator = Validator::make(Input::all(), array(
                "email"                 => "required|email",
                "password"              => "required|min:6",
                "password_confirmation" => "same:password",
                "token"                 => "exists:token,token"
            ));
            if ($validator->passes())
            {
                $credentials = array(
                    "email" => Input::get("email")
                );
                Password::reset($credentials,
                    function($user, $password)
                    {
                        $user->password = Hash::make($password);
                        $user->save();
                        Auth::login($user);
                        return Redirect::route("user/profile");
                    }
                );
            }
            $data["email"] = Input::get("email");
            $data["errors"] = $validator->errors();
            return Redirect::to(URL::route("user/reset") . $token)
                ->withInput($data);
        }
        return View::make("user/reset", $data);
    }
    
    
    public function logoutAction()
    {
        Auth::logout();
        return Redirect::route("user/login");
    }
}