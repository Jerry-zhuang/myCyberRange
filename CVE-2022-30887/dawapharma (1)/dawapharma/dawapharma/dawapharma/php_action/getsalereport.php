<?php 

require_once 'core.php';

if($_POST) {

	$startDate = $_POST['startDate'];
//echo $startDate;exit;
	//$date = DateTime::createFromFormat('m/d/Y',$startDate);

	//$start_date = $date->format("m/d/Y");

//echo $date;exit;

	$endDate = $_POST['endDate'];
	//$format = DateTime::createFromFormat('m/d/Y',$endDate);
	//$end_date = $format->format("Y-m-d");

	$sql = "SELECT * FROM order_item WHERE 	added_date>= '$startDate' AND added_date<= '$endDate'";
	//echo $sql;exit;
	$query = $connect->query($sql);

	$table = '
	<table border="1" cellspacing="0" cellpadding="0" style="width:80%;">
		<tr>
			<th>Medicine Name</th>
			
			
			<th>quantity</th>
			<th>Rate</th>
			<th>Total</th>
			<th>OrderId</th>
			<th>added_date</th>
		</tr>

		<tr>';
		$totalAmount = 0;
		while ($result = $query->fetch_assoc()) {
			$stmt1 = "SELECT * FROM product WHERE product_id='".$result['productName']."'";
                     $result2 = $connect->query($stmt1);
//print_r($stmt1);exit;
                     foreach($result2 as $key1){//
			$table .= '<tr>
				<td><center>'.$key1['product_name'].'</center></td>
				
				
				<td><center>'.$result['quantity'].'</center></td>
				<td><center>'.$result['rate'].'</center></td>
				<td><center>'.$result['total'].'</center></td>
				<td><center>'.$result['lastid'].'</center></td>
					<td><center>'.$result['added_date'].'</center></td>
			</tr>';	
			$totalAmount += $result['rate'];
		}}
		$table .= '
		</tr>

		<tr>
			<td colspan="3"><center>Total Amount</center></td>
			<td><center>'.$totalAmount.'</center></td>
		</tr>
	</table>
	';	
	echo $table;

}
//header('location:../report.php');
?>