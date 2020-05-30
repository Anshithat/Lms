<?php

if(isset($_POST['submit_button']))
{
$uname = filter_input(INPUT_POST, 'uname');
$psw = filter_input(INPUT_POST, 'psw');
if (!empty($uname))
  {
  if (!empty($psw))
    {
    $servername = "localhost";
$username = "jvtbclmy_lms";
$password = "lms@123";
$dbname = "jvtbclmy_lms";
$conn = new mysqli($servername, $username, $password, $dbname);
    if (mysqli_connect_error())
      {
      die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
      }
    else
      {
      $uname=strtolower($uname);
      $sql= "SELECT * FROM login WHERE Username = '$uname' AND Password = '$psw'";
      $result = mysqli_query($conn,$sql);
      $check = mysqli_fetch_array($result);
      if(isset($check))
        {
        $diff=strtotime($check['End_date'])-strtotime($check['Start_date']);
        $diff=intval($diff);
        if($diff==86400)
          {
              if($check['Is_password_expired']==1)
          {
              
          }
          else
          {
          $update_query="update login set Is_password_expired =1 where Username = '$uname' AND Password = '$psw'";
          $update_result=mysqli_query($conn,$update_query);
          echo '<script>alert("guest login")</script>';
          echo '<script>document.location.href="guest.php"</script>';
          }} 
          else
            {
            echo '<script>alert("Student login") ;</script>';
            echo '<script>document.location.href="login.php"</script>';
            }
        }
        else
        {
        echo '<script>alert("username or password invalid")</script>'; 
        }              
        $conn->close();
      }
    }

        else
        {
        echo "Password should not be empty";
        die();
        }
      }
    else
    {
    echo "Username should not be empty";
    die();
    } 
}
 ?>
<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style type="text/css">
    body {font-family: Arial, Helvetica, sans-serif;}
    
    form {background-image: lap.jpg}
    
    input[type=text], input[type=password] {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }
    
    button {
      background-color: #4CAF50;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      cursor: pointer;
      width: 100%;
      text-align: center;
    }
    
    button:hover {
      opacity: 0.8;
    }
    
    
    
    .imgcontainer {
      text-align: center;
      margin: 24px 0 12px 0;
    }
    
    img.glass {
      width: 40%;
      border-style: 50%;
    }
    
    
    
    .container {
      padding: 16px;
    }
    
    span.psw {
      float: right;
      padding-top: 16px;
    }
    
    /* Change styles for span and cancel button on extra small screens */
    @media screen and (max-width: 300px) {
      span.psw {
         display: block;
         float: none;
      }
      .cancelbtn {
         width: 100%;
      }
    }
  </style>
</head>

<body style="background-image: url(glass.jpg);background-repeat: no-repeat;background-size: cover;">
  <h2 style="text-align: center; ">LMS Login</h2>
  <div class="container r">
    <img src="logo.png" style="padding-left: 510px">
  </div>
  <form action="" method="post">
    <div class="container" style="text-align: center;">
      <label for="uname"><b>Username</b>
      </label>
      <input type="text" placeholder="Enter Username" name="uname" style="width: 300px" required>
      <br>
      <label for="psw"><b>Password</b>
      </label>
      <input type="password" placeholder="Enter Password" name="psw" style="width: 300px" required>
      <br>
      <div>
        
        <button name="submit_button"type="submit" style="width: 80px; margin-right: 140px" >Login</button>
      </div>
      <div>
           <?php if($check['Is_password_expired']==1)
         echo "<p style='color:red'>Your password Expired <br></p>";
   ?> 
        <label style="color: floralwhite; margin-right: 100px">
          <input type="checkbox" checked="checked" name="remember">Remember me</label>
        <br> <span><a href="" style="color: floralwhite; margin-right: 60px"width: 50px>Forgot your password?</a></span>
      </div>
    </div>
  </form>
</body>

</html>