<?php
class UserSeeder
extends DatabaseSeeder
{
    public function run()
    {
        $users = array();
            $users[] = array(
                "username" => "raymond@oberon.nl",
                "password" => Hash::make("raymond"),
                "email"    => "raymond@oberon.nl"
            );
        foreach ($users as $user)
        {
            User::create($user);
        }
    }
}