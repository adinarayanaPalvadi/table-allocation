<?php 
	include ('dbConnect.php') ;
?>
<!DOCTYPE html>	
<html>
    <head>
        <title>Table status</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.40/css/uikit.min.css" />
		<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.40/js/uikit.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.40/js/uikit-icons.min.js"></script>
		<style type="text/css">
			.space
			{
				height: 30px;
			}
			.space1
			{
				height: 20px;
			}
			.heading
			{
				font-weight: 800;
			}
			.sub
			{
				color: red;
				font-weight: 500;
			}
		</style>
	</head>
	<body>
		<section>
		<div class="uk-container">
			<div class="uk-text-center" style="font-size: 35px;color: red;font-weight: bold;">

    			<div class="space"></div>
    				Table allocation status
    		</div>
    			<div class="space"></div>
    			<div class="uk-text-center uk-h3">Enter Your details</div>
    			<form action="index1.php" method="POST">
    				<div class="uk-text-center" uk-grid>
    					<div class="uk-width-1-1 uk-inline uk-text-center">
    						
						        <input class="uk-input uk-form-width-medium uk-margin-right" type="text" placeholder="Enter name" name="fullname" required="">
						    
						        <input class="uk-input uk-form-width-medium uk-margin-right" type="text" placeholder="Enter mobile number" name="mobile">
						    
						        <input class="uk-input uk-form-width-medium uk-margin-right" type="number" placeholder="" name="persons" required="">
						    	<button type="submit" class="uk-margin-large-left uk-button uk-button-primary uk-button-small" name="submit">Submit</button>
    					</div>
    				</div>
    			</form>
		</div>
		<div class="space1"></div>
		</section>
		<section style="background-color: #b4c8e8;">
			<div class="space1"></div>
			<div class="uk-text-center uk-h3">
				Users List
			</div>
			<div class="uk-text-center">
			<?php  
				
					$fetch = "SELECT * FROM user_info ";
					$fetch_status = mysqli_query($connect,$fetch);
					if(mysqli_num_rows($fetch_status))
					{

						echo '<table class="uk-table" >
                                        <tr class="heading">
                                            <td>S.no</td>
                                            <td>Name</td>
                                            <td>Mobile number</td>
                                            <td>No of persons</td>
                                            <td>In time</td>
                                            <td></td>
                                            </tr>';
						while($row = mysqli_fetch_array($fetch_status))
						{
							$s_no = $row['s_no'];
							$name = $row['name'];
							$mobile = $row['mobile'];
							$no_of_persons = $row['no_of_persons'];
							$time = $row['waiting_time'];
							echo '<tr class="sub">
							<td>'; echo$s_no; echo'</td>
							<td>'; echo$name; echo'</td>
							<td>'; echo $mobile; echo '</td>
							<td>'; echo $no_of_persons; echo'</td>
							<td>'; echo $time; echo'</td>
							<form action="index1.php" method="POST">
							<td> <button type="submit" name="alloc" value='.$s_no.' class="uk-button uk-button-danger uk-button-small">Check Availability</button>
							</td>
							</form>
							</tr>';

						}
						echo'</table>';
					}
				
			?>
			</div>
		</section>
		<section style="background-color: #cef4b2;">
			<div class="uk-text-center" uk-grid>
				<div class="uk-width-1-2@s" style="background-color: #f4df42">
					<div class="uk-text-center uk-h3">
						List of tables
					</div>
					<div>
						 <?php

                            $table_query = "SELECT * FROM alltables ";
                            $table_status = mysqli_query($connect,$table_query);
                                
                                if (mysqli_num_rows($table_status)) {
                                
                                    echo '
                                	<center>
                                    <table class="uk-table" style="width: 30%;">
                                        <tr class="heading">
                                            <td>Table Id</td>
                                            <td>Table name</td>
                                            <td>table capacity</td>
                                            
                                        </tr>';
                                while ($row = mysqli_fetch_array($table_status)) {
                                    $name = $row['table_name'];
                                    $id = $row['Id'];
                                    $capacity = $row['table_capacity'];
                                    $status  = $row['status'];
                                    
                                    echo'<tr class="sub">
                                        <td>'; echo $id; echo'  </td>
                                        <td>'; echo $name;  echo '</td>
                                        <td>'; echo $capacity;  echo'</td>
                                       
                                    </tr>'; 
                                                        
                                }
                                echo'</table>
                                </center>
                                   ';
                               }
                            ?>
					</div>
				</div>
				<div class="uk-width-1-2@s">
					<?php 
				if (isset($_POST['alloc'])) {
				$details = "SELECT * form user_info WHERE  WHERE no_of_persons = '".$persons."'  ";
				$details_status = mysqli_query($connect,$details);
				
				$row = mysqli_fetch_array($details_status);
				$alltables1= "SELECT * FROM alltables WHERE table_capacity >= ".$persons."  AND table_capacity <= ".$persons." + 1 AND status = 0";
				 $alltables_status =mysqli_query($connect,$alltables1);
				 if(mysqli_num_rows($alltables_status))
					 {
					 	echo '<table class="uk-table" >
                                        <tr class="heading">
                                            <td>Table Id</td>
                                            <td>Name name</td>
                                            <td>table_capacity</td>
                                            <td>Status</td>
                                            <td></td>
                                            </tr>';
					 	while($rows = mysqli_fetch_array($alltables_status))
					 	{
					 		$id = $rows['Id'];
							$tname = $rows['table_name'];
							$capacity = $rows['table_capacity'];
					 		$status = $rows['status'];
					 		echo '<tr class="sub">
							<td>'; echo$id; echo'</td>
							<td>'; echo$tname; echo'</td>
							<td>'; echo $capacity; echo '</td>
							<td>'; echo $status; echo'</td>
							
							<form action="index1.php" method="POST">
							<td> <button type="submit" value='.$id.'  class="uk-button uk-button-danger uk-button-small" name="bookNow">Book now</button>
							</td>
							</form>
							</tr>';
					 	
					 	}
					 	echo'</table>';
					 }
					}
				?>
				</div>
				
			</div>
		</section>
		
		<section>

			<div class="uk-text-center" uk-grid>
				<div class="uk-width-1-2@s" style="background-color:#60f768; ">
					<div class="uk-text-center uk-h2">
						Booked tables
					</div>
					<div class="uk-text-center">
						<?php
							$booking ="SELECT * FROM booking";
							$book_status = mysqli_query($connect,$booking);
							if (mysqli_num_rows($book_status)) {
								echo '<table class="uk-table" >
                                        <tr class="heading">
                                            <td>Table Id</td>
                                            <td>table name</td>
                                            <td>table_capacity</td>
                                            <td>Status</td>
                                            <td>Action</td>
                                            </tr>';
                                while($rows= mysqli_fetch_array($book_status))
                                {
                                	$id = $rows['Id'];
                                	$tname= $rows['table_name'];
                                	$capacity = $rows['table_capacity'];
                                	$status = $rows['status'];
                                	echo '<tr class="sub">
									<td>'; echo$id; echo'</td>
									<td>'; echo$tname; echo'</td>
									<td>'; echo $capacity; echo '</td>
									<td>'; echo $status; echo'</td>
									
									<form action="index1.php" method="POST">
									<td> <button type="submit" value='.$rows['Id'].'  class="uk-button uk-button-danger uk-button-small" name="checkout">Checkout</button>
									</td>
									</form>
									</tr>';
                                }
                                echo'</table>';
							}
						?>
					</div>
				</div>
				<div class="uk-width-1-2@s" style="background-color: #f977c5;">
					<div class="uk-text-center uk-h2">
						Waiting Customers
					</div>
					<div class="uk-text-center">
						<?php
						  $waiting = "SELECT * FROM waiting_list";
						  $waiting_status = mysqli_query($connect,$waiting);
						  if(mysqli_num_rows($waiting_status))
						  {
						  	echo '<table class="uk-table" >
                                        <tr class="heading">
                                            <td>S.no</td>
                                            <td>name</td>
                                            <td>No Of Persons</td>
                                            <td>Waiting in time</td>
                                            <td>Action</td>
                                            </tr>';
                            while($row =mysqli_fetch_array($waiting_status))
                            {
                            	$s_no = $row['s_no'];
                            	$name = $row['name'];
                            	$persons = $row['no_of_persons'];
                            	$time = $row['in_time'];
                            	echo '<tr class="sub">
									<td>'; echo$s_no; echo'</td>
									<td>'; echo $name; echo'</td>
									<td>'; echo $persons; echo '</td>
									<td>'; echo $time; echo'</td>
									<td><form action = "index1.php" method="POST">
									 <button type="submit" name="waitalloc" value='.$s_no.' class="uk-button uk-button-danger uk-button-small">Check Availability</button>
									 </form>
							</td>
									';
                            }
                            echo '</table>';
						  }	
						?>
					</div>
				</div>
			</div>
		</section>
		
	</body>
</html>