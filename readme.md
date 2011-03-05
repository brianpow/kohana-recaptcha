Recaptcha Module for Kohana v3
==============================

The original recaptcha library can be downloaded from [here](http://code.google.com/p/recaptcha/) 

Comments or suggestions: brianpow [AT] gmail [DOT] com

Usage
-----

First, register a [recaptcha account](http://www.google.com/recaptcha) to have the private key and public key.

Then, edit the config/recaptcha.php and add your keys.

To check the answer in Controller:

    $recaptcha=new Recaptcha(); 
    if($recaptcha->check($_POST))
        $message='Answer Correct!";
    else
        $message='Are you robot?";
 
You may also get the original error message by

    $error=$recaptcha->errors();
    
In case you want to use more than one key in your project, you may add your new key as parameter when creating a new object

    $another_recaptcha=new Recaptcha($my_other_keys_array); 
    
To show the input field in View:

    $body=View::factory('YOUR_VIEW_FILE')->set('recaptcha', $recaptcha->html());

