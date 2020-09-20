<?php
$t_from="";
$t_to="";
$amount=0;
$msg=0;
$sql="";
if(isset($_POST['t_from']) ){
    if($_POST['t_from']!=$_POST['t_to'])
    {
  $t_from = $_POST['t_from'];
  $t_to = $_POST['t_to'];
  $amount = $_POST['amount'];
  $val="";
$conn = mysqli_connect("localhost", "id14879105_root", "Sr0fd2080993171@#", "id14879105_credit_management");
            if($conn-> connect_error){
                die("Connection failed:".$conn-> connect_error);
            }
  
            $sql = "select user_id,Credit from user where user_id=".$t_from;
            $result = $conn-> query($sql);

            if ($result->num_rows > 0){
                while($row = $result-> fetch_assoc()){
                    $val = $row['Credit']."--".$row['user_id'];
                   
                        if($amount<=$row['Credit'])
                    {
                      $sql = "INSERT into make_transaction(transfer_from, transfer_to, credit, date_time) values(".$t_from.",".$t_to.",".$amount.", now())";
                      $conn->query($sql);
                      $sql = "update user set Credit=(Credit-".$amount.") Where user_id=".$t_from; 
                      $conn->query($sql);
                      $sql = "update user set Credit=(Credit+".$amount.") Where user_id=".$t_to;

                      if($conn->query($sql) === TRUE)
                      {
                          $msg = 1;// right

                      }
                      else{
                        $msg = 2;// error
                      }

                    }
                    
                    else{
                      $msg = 3; // Insufficient Amount
                    }

                    
                }

              }
            

}
else{
     $msg = 4; // Same User
    
}
}

?>

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
          <nav class="navbar navbar-expand-md  navbar-light bg-light stickey-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="images/4.png"></a>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link font-weight-bold" href="index.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view.php">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="transaction.php">View Transaction</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
   
<div id="search" class="container-fluid bg-grey">
<?php
//echo $val."<br>";
if($msg==1)
{
   // echo $sql;
  ?>



<div class="alert alert-success" role="alert">
  Transaction Successfull!!
</div>
<?php
$msg = 0;
}
if($msg==2){

echo $sql;
?>
<div class="alert alert-danger" role="alert">
Transaction Error!!
</div>
<?php

$msg=0;
}
if($msg==3)
{
    echo $sql;
?>
<div class="alert alert-warning" role="alert">
Insufficient Amount!!
</div>

<?php
$msg=0;
}
if($msg==4)
{
?>
<div class="alert alert-warning" role="alert">
Select Diffrent User!!!!
</div>

<?php

$msg=0;
}
?>
<br><br><br>
<div class="row">
        <div class="container bg-light">
  <h2 class="text-center display-2">Make Transaction</h2><hr>
  <div class="row">
    <div class="col-sm-12 slideanim">
        <form action="form.php" name="search" method="post">
      <div class="row">
          
        <div class="col-sm-6 form-group">
           <h2><label for="t_from">Transaction from</label><h2>
			  <select class="form-control form-control-lg" id="t_from" name="t_from" required>
				<option value="1">Naveen Singh</option>
				<option value="2">Shubham Kumar</option>
				<option value="3">Niraj</option>
        <option value="4">Animesh Ranjan</option>
        <option value="5">Alok Kumar</option>
			  </select>
        </div>

        <div class="col-sm-6 form-group">
		      <h2><label for="t_to">Transaction to</label></h2>
        <select class="form-control form-control-lg" id="t_to" name="t_to" required>
				<option value="1">Naveen Singh</option>
				<option value="2">Shubham Kumar</option>
				<option value="3">Niraj</option>
        <option value="4">Animesh Ranjan</option>
        <option value="5">Alok Kumar</option>
			  </select> 
        </div>
		<div class="col-sm-12 form-group">
       <h2><label for="amount">Credit</label></h2>
       <input class="form-control" id="amount" name="amount" required>	
    </div>   
    </div>
      <div class="row">
        <div class="col-sm-12 form-group">
          <button class="btn btn-primary btn-lg " type="submit">Transfer</button>
        </div>
      </div>
        </form>    
    </div>
  </div> 
  </div>
  </div>
</div>
</form>
</body>
</html>