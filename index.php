<?php
session_start();
$error = NULL;
$succ = NULL;
if(isset($_POST['submitlog']))
{
	if(empty($_POST['username']) || empty($_POST['password']))
	{
		$error = "Please enter username and password";
	}
	else
	{
		include_once('manageuser.php');
		$user = new ManageUsers();
		$auth_uzr = $user->LoginUsers($_POST['username'],$_POST['password']);
		if($auth_uzr == 1)
		{
			    $userdata = $users->GetUserInfo($_POST['username']);
				$_SESSION['uzr'] = $userdata; 
				$succ = "Inserted user successfully";
				header('location:dashboard.php');
		}
		else
		{
			$error = "Invalid username and/or password.";
		}
	}
}

if (isset($_POST['submitf']))
{

	include_once('manageuser.php');
	$users = new ManageUsers();

	//$users->PdoTransaction();

	//exit;

	if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email']) )
	{
		$error = "Please fill in the required fields";
	}
	else if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
	{
		$error = "Please enter a valid email";
	}
	else if(!filter_var($_POST['mobile'],FILTER_VALIDATE_INT))
	{
		$error = "Please enter a valid mobile number";
	}
	else
	{
		$check_availability = $users->GetUserInfo($_POST['username']);
		if($check_availability == 0)
		{
			$reg_count = $users->RegisterUsers($_POST['username'],$_POST['password'],$_POST['email'],$_POST['mobile'],$_SERVER['REMOTE_ADDR'],date("Y-m-d"),date("H:i:s"));
			if($reg_count == 1)
			{
				$userdata = $users->GetUserInfo($_POST['username']);
				$_SESSION['uzr'] = $userdata; 
				$succ = "Inserted user successfully";
				header('location:dashboard.php');
			}
			

	    }
	    else
	    {
	    	$error = "Username already exists";
	    }
	}
     
}
echo $error." ".$succ;
?>

<div style="padding: 25px;">
<div style="padding: 20px; float:left">
<form method='post' action="">
	<table>
		<tr>
			<th colspan="2"></th>
			
		</tr>
		<tr>
			<td>Username</td>
			<td><input type="text" value="<?php echo $_POST['username'] ?? ""; ?>" name="username" placeholder="Enter Username" required/></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input type="password" name="password" placeholder="Enter Password" required /></td>
		</tr>
		<tr>
			<td>Email</td>
			<td><input type="text" name="email" value="<?php echo $_POST['email']?? "" ; ?>" placeholder="Enter Email" required/></td>
		</tr>
		<tr>
			<td>Mobile</td>
			<td><input type="text" name="mobile" placeholder="Enter mobile" value = "<?php echo $_POST['mobile']?? ""; ?>" required /></td>
		</tr>
		<tr>
			<td><input type="submit" name="submitf" value="Register"  /></td>
			<td></td>
		</tr>
		
	</table>

</div>

</form>

<div style="padding: 20px;float: left;margin-left: 30px;">

<form method="post" action="" >
	<table>
		<tr>
			<td>Login Id</td>
			<td><input type="text" name="username" placeholder="Enter Username" value = "<?php echo $_POST['username']?? ""; ?>" required /></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input type="password" name="password" placeholder="Enter Password" value = "<?php echo $_POST['password']?? ""; ?>" required /></td>
		</tr>
		<tr>
			<td><input type="submit" name="submitlog" value="Login"  /></td>
			<td></td>
		</tr>
	</table>
		
</form>

</div>
	
</div>