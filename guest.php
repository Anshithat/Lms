

<html>
        <head>
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

        </head>
        <body>
        	
        <p>Login Success</p>
        <p>
            You can view and browse different pages<br>
            you cannot open any course content<br>
            You cannot download any content<br>
        </p>
        <br>
        <button name="btn" class="btn btn-sm btn-danger" onclick="logout()">log out</button>
        <script  type="text/javascript">
          

           var butt= document.getElementById("btn");
           butt.style.visibility= "hidden";
            function logout() {
                document.write("Logged out")
            }
        </script>
        </body>
</html>
