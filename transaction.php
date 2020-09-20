<!DOCTYPE html>
<html>
    <head>
        <title>Credit Management</title>
        <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" href="bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </head>
    <body>
        <!--Navbar-->
        <nav class="navbar navbar-expand-md fixed-top navbar-light bg-light stickey-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="images/4.png"></a>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link font-weight-bold" href="index.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="form.php">Transaction</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view.php">View Users</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <br><br><br><br><br><br>
<div class="row">
        <div class="container bg-light">
    <h2 class="display-3 text-center">Transaction</h2><hr>
        <table class="table table-striped" border=5>
            <tr style="background:#555555; color:#fff">
                <th>From</th>
                <th>To</th>
                <th>Transfer Credit</th>
                <th>Date & Time</th>
            </tr>
            <?php
            $conn = mysqli_connect("localhost", "id14879105_root", "Sr0fd2080993171@#", "id14879105_credit_management");
            if($conn-> connect_error){
                die("Connection failed:".$conn-> connect_error);
            }

           $sql = "SELECT (SELECT NAME FROM user WHERE user_id=transfer_from) From_user, (SELECT NAME FROM user WHERE user_id=transfer_to) AS To_user, credit, date_time FROM make_transaction  order by date_time DESC";
            
           
            $result = $conn-> query($sql);

            if ($result->num_rows > 0){
                while($row = $result-> fetch_assoc()){
                  
                    echo "<tr><td>".$row['From_user']."</td><td>".$row['To_user']."</td><td>".$row['credit']."</td><td>".$row['date_time']."</td></tr>";
                }
            }
            ?>
            </div>
          </div>
    </body>
</html>

   
