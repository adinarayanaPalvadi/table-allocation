<?php  
	//code for database connection//
	$servername = "localhost";
	$username = "root";
	$password = "";
	$db= "booking";
	$connect = mysqli_connect($servername,$username,$password,$db);
	if ($connect) {
		// echo "database connected";
	}
	else
	{
		echo "database not connected";
	}

	//******COde for form submitting ******//


	if (isset($_POST['submit'])) {
		$name= mysqli_real_escape_string($connect,$_POST['fullname']);
		$mobile = mysqli_real_escape_string($connect, $_POST['mobile']);
		$no_of_persons = mysqli_real_escape_string($connect,$_POST['persons']);
		$form_query = "INSERT INTO user_info (name,mobile,no_of_persons,waiting_time) VALUES('$name', '$mobile','$no_of_persons', NOW() )";
		$form_status = mysqli_query($connect,$form_query);

		if($form_status)
		{
			echo "<script>alert('succesfully submited the details');
			window.location.href='index1.php';</script>";
		}
		
	}

	//*****Code for checking the booking of a table if available  table is there*****//
	if(isset($_POST['bookNow']))
	{
		$booking = "SELECT * FROM alltables WHERE Id = '".$_POST['bookNow']."' ";
		$booking_status= mysqli_query($connect,$booking);
		$users = "SELECT * FROM user_info";
		$users_status = mysqli_query($connect,$users);
		if(mysqli_num_rows($booking_status))
		{
			$row = mysqli_fetch_array($booking_status);
			$row1 = mysqli_fetch_array($users_status);
			$insertBooking= "INSERT INTO booking(Id,table_name,table_capacity,status) VALUES(
						". $row['Id']. ",
						'". $row['table_name']. "',
						". $row['table_capacity']. ",
						". $row['status']. "
					)";
			
			$insertBooking_status = mysqli_query($connect,$insertBooking);
			$update = "UPDATE booking SET status = 1 WHERE Id = '".$_POST['bookNow']."' ";
			$update1 = "UPDATE alltables SET status = 1 WHERE Id = '".$_POST['bookNow']."' ";
			$update_status2 = mysqli_query($connect,$update);
			$update_status1 = mysqli_query($connect,$update1);
		}
	}

	//****code for check out of the customer  ****////


	if (isset($_POST['checkout'])) {
		
			$booking = "SELECT * FROM booking WHERE Id =".$_POST['checkout']." ";
			$booking_status = mysqli_query($connect,$booking);
			$rows5 = mysqli_fetch_array($booking_status);
			
			// $vacancy = "INSERT INTO vacancy (s_no,table_name,table_capacity,status,out_time) VALUES(
			// 			". $rows5['Id']. ",
			// 			'". $rows5['table_name']. "',
			// 			". $rows5['table_capacity']. ",
			// 			". $rows5['status']. ",
			// 			NOW()	
			// 			)";
			$vacancy = "UPDATE alltables SET status = 0 WHERE Id = ".$_POST['checkout']." ";
			
			$vacancy_status = mysqli_query($connect,$vacancy);
		
		if($vacancy)
		{
			$checkOut= "DELETE FROM booking WHERE Id =".$_POST['checkout']." ";
			
		$checkOut_status = mysqli_query($connect,$checkOut);
		}
		// $update = "UPDATE alltables SET status=0 WHERE Id = ".$_POST['checkout']." ";
		
		// $update_status = mysqli_query($connect,$update);
	}

	//***code for if there is no avalilbility of a table is there and insering into waiting list ***//
	if (isset($_POST['alloc'])) {
		echo'<script>alert("Click ok to check the availabilty of a table")
				  </script>';
		$persons = waiting_list_no($_POST['alloc']);
		$details = "SELECT * FROM user_info WHERE no_of_persons = '".$persons."'  ";
		
		$details_status = mysqli_query($connect,$details);
		$row = mysqli_fetch_array($details_status);
		$alltables1= "SELECT * FROM alltables WHERE table_capacity >= ". $persons."   AND table_capacity <= ".$persons." + 1 AND status = 0 " ;
		
		 $alltables_status =mysqli_query($connect,$alltables1);
		 if(mysqli_num_rows($alltables_status))
			 {
			 	while($rows = mysqli_fetch_array($alltables_status))
			 	{
			 		$id = $rows['Id'];
					$tname = $rows['table_name'];
					$capacity = $rows['table_capacity'];
			 		$name = $row['status'];
			 	}

			 }
			 else
		{
			$waiting = "SELECT * FROM user_info WHERE name ='".waiting_list_name($_POST['alloc'])."'  ";
			
			$waiting_status = mysqli_query($connect, $waiting);
			$waiting_row = mysqli_fetch_array($waiting_status);
			if($waiting_status)
			{
				$waiting_insert = "INSERT INTO waiting_list (s_no, name, no_of_persons, in_time ) 
									VALUES(
											'".$waiting_row['s_no']."',
											'".$waiting_row['name']."',
											".$waiting_row['no_of_persons'].",
											NOW()
										)";
				
				$waiting_insert_status = mysqli_query($connect,$waiting_insert);
			}
			echo'<script>alert("please wait for some time")
				  </script>';
		}
		if($alltables_status)
		{
			$insert = "SELECT * FROM alltables WHERE table_capacity= '".waiting_list_no($_POST['alloc'])."' ";
				$insert_status = mysqli_query($connect,$insert);
				$user="SELECT * FROM user_info";
				$user_info = mysqli_query($connect,$user);
				$rows4 = mysqli_fetch_array($user_info);
				if(mysqli_num_rows($insert_status))
				{
					while($rows3 = mysqli_fetch_array($insert_status))
					{
						$id = $rows3['Id'];
						$name = $rows3['table_name'];
						$capacity = $rows3['table_capacity'];
						$status = $rows3['status'];

						}
				}
				if($insert_status)
				{	
				$result = "INSERT INTO booking (Id, table_name, table_capacity,  status) VALUES(
								". $rows4['s_no']. ",
						 		'$name',
						 		$capacity,
						 		'". $rows4['status']. "'
							)";		
				}

		}	
	}
	
	//***code for availabilty of tables in waiting list of the customers to  book  the tables***//
	if (isset($_POST['waitalloc'])) {
		
		$waiting = waiting_list_no($_POST['waitalloc']);	
		$wait = "SELECT * FROM user_info WHERE s_no =  ".$_POST['waitalloc']."";
		$wait_status = mysqli_query($connect, $wait);	
		$alltable = "SELECT * FROM alltables WHERE table_capacity >= ".$waiting." AND table_capacity <= ".$waiting." + 1 AND status = 0";
		$alltable_status = mysqli_query($connect, $alltable);
		if(mysqli_num_rows($alltable_status))
		{
			
			$insert = "SELECT * FROM alltables WHERE table_capacity >= '".waiting_list_no($_POST['waitalloc'])."' AND table_capacity <= ".$waiting." + 1 AND status = 0 ";
				$insert_status = mysqli_query($connect,$insert);
				if(mysqli_num_rows($insert_status))
				{	
					while($rows3 = mysqli_fetch_array($insert_status))
					{
						$id = $rows3['Id'];
						$name = $rows3['table_name'];
						$capacity = $rows3['table_capacity'];
						$status = $rows3['status'];
						}
						$result = "INSERT INTO booking (Id, table_name, table_capacity, status) VALUES(
									'$id',
							 		'$name',
							 		$capacity,
							 		'$status'
								)";
					
					$result_status= mysqli_query($connect, $result);
					$update = "UPDATE alltables SET status = 1 WHERE table_capacity >= '".waiting_list_no($_POST['waitalloc'])."' AND table_capacity <= ".$waiting." + 1";
					
					$update_status = mysqli_query($connect,$update);
					$delete = "DELETE FROM waiting_list WHERE s_no = ".$_POST['waitalloc']."";

					$delete_status = mysqli_query($connect,$delete);
					
					echo "<script>alert('You have allocate to ".$name." ')</script>";

				}
		}	
		else
		{
			echo "<script>alert('PLease wait for some time')</script>";
		}
}
function waiting_list_name($id)
{
	global $connect;
	$query_status = "SELECT name FROM user_info WHERE s_no = '$id' ";
	$query_status = mysqli_query($connect,$query_status);
	$result = mysqli_fetch_assoc($query_status);
	
	return $result['name'];
}
function waiting_list_no($id)
{
	global $connect;
	$query_status = "SELECT no_of_persons FROM user_info WHERE s_no = '$id' ";
	
	$query_status = mysqli_query($connect,$query_status);
	$result = mysqli_fetch_assoc($query_status);

	return $result['no_of_persons'];
}
// function table_capacity($id)
// {
// 	global $connect;
// 	$query_status = "SELECT table_capacity FROM alltable WHERE Id = '$id' ";
	
// 	$query_status = mysqli_query($connect,$query_status);
// 	$result = mysqli_fetch_assoc($query_status);
// 	return $result['table_capacity'];
// }
	
?>