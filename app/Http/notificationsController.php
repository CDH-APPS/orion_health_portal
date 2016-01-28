<?php

class notificationsController
{



    public function sendNewUserEmail($job, $data)
    {
		File::append('docs/emaillogs.txt','New user account : '.$data['Name'].' => '.$data['Email'].PHP_EOL);
	

    	Mail::send('Notifications.newUserMail',['name'=>$data['Name'],'username'=>$data['Email'],'password'=>$data['Password']], function($message) use($data)
        {
            $message->to($data['Email'])->subject('User Credentials');
		});

        
        $job->delete();
    }

    public function sendUserPasswordResetEmail($job, $data)
    {
		File::append('docs/emaillogs.txt','Password Reset : '.$data['Name'].' => '.$data['Email'].PHP_EOL);
	

    	Mail::send('Notifications.userPasswordResetMail',['name'=>$data['Name'],'username'=>$data['Email'],'password'=>$data['Password']], function($message) use($data)
        {
            $message->to($data['Email'])->subject('Password Reset');
		});

        
        $job->delete();
    }

    public function registerNewUserEmail($data)
    {
        File::append('docs/emaillogs.txt','New user account queue request : '.$data['Name'].' => '.$data['Email'].PHP_EOL);
    	Queue::push("notificationsController@sendNewUserEmail",$data);
		File::append('docs/emaillogs.txt','New user account queue registered : '.$data['Name'].' => '.$data['Email'].PHP_EOL);
    
    }


    public function registerUserPasswordResetEmail($data)
    {
        File::append('docs/emaillogs.txt','Reset password queue request : '.$data['Name'].' => '.$data['Email'].PHP_EOL);
    	Queue::push("notificationsController@sendUserPasswordResetEmail",$data);
    	File::append('docs/emaillogs.txt','Reset password queue registered: '.$data['Name'].' => '.$data['Email'].PHP_EOL);
    
		
    }
}