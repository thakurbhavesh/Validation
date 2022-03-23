<?php
require_once('vendor/autoload.php');
$conn=mysqli_connect('localhost','root','','bhavesh');

$username=isset($_POST['username'])?$_POST['username']:'';
$email=isset($_POST['emailid'])?$_POST['emailid']:'';
$mobile=isset($_POST['mobileno'])?$_POST['mobileno']:'';
$password=isset($_POST['password'])?$_POST['password']:'';


$gump = new GUMP();

// set validation rules
$gump->validation_rules([
    'username'    => 'required|alpha_numeric|max_len,100|min_len,6',
    'password'    => 'required|max_len,100|min_len,6',
    'emailid'       => 'required|valid_email',
    
]);

// set field-rule specific error messages
// $gump->set_fields_error_messages([
//     'username'      => ['required' => 'Fill the Username field please, its required.'],
//     'password'   => ['required' => 'Please enter a valid password.']
// ]);

// set filter rules
$gump->filter_rules([
    'username' => 'trim|sanitize_string',
    'password' => 'trim',
    'emailid'    => 'trim|sanitize_email',
    
]);

// on success: returns array with same input structure, but after filters have run
// on error: returns false
$valid_data = $gump->run($_POST);

if ($gump->errors()) {
    var_dump($gump->get_readable_errors()); // ['Field <span class="gump-field">Somefield</span> is required.'] 
    // or
    var_dump($gump->get_errors_array()); // ['field' => 'Field Somefield is required']
} else {
    $sql="INSERT INTO `validation`( `name`, `email`, `mobile`, `password`) VALUES ('$username','$email','$mobile','$password')";

}

$run=mysqli_query($conn,$sql);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>validation</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
      .s{
          width: 500px;
          
          margin: 50px;
      }
  </style>
</head>
</head>
<body>
    <h1 class="text-center text-primary">Validation </h1>

    <div class="s">

    <form action="" method="post">


<label for="" class="my-2"> Name :</label><br>
<input type="text" name="username" id="" class="form-control" placeholder="enter your name">
<br>
<label for="" class="my-2"> Email Address :</label><br>
<input type="email" name="emailid" id="" class="form-control" placeholder="enter your email">
<br>

<label for="" class="my-2"> Mobile :</label><br>
<input type="Mobile" name="mobileno" id="" class="form-control" placeholder="enter your mobile number">
<br>

<label for="" class="my-2"> Password :</label><br>
<input type="password" name="password" id="" class="form-control" placeholder="enter your password">
<br>

<input type="submit" value="Submit" name="submit" class="btn btn-primary">
    </form>

    </div>
</body>
</html>