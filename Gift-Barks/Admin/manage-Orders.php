<?php include('partial/menu.php')?>
<div class="main-content">
    <div class="wrapper text-center">
        <h1>Manage Orders</h1>
        <br />
                <!-- Display session messages -->
                <?php
        // Display session messages if they exist
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'] ;
            unset($_SESSION['add']); // Remove session message
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'] ;
            unset($_SESSION['delete']); // Remove session message
        }
    ?>
        <!-- Add Test Order Button -->
        <a href="test-order.php" class="btn-tertiary">Create Test Order</a>
        <br /><br />
      <br />
    <table class="tbl-full">
        <tr>
            <th>ID</th>
            <th>Drink Name</th>
            <th>Amount</th>
            <th>Name</th>
            <th>Email</th>
            <th>Room Number</th>
            <th>Total</th>
            <th>Actions</th>
</tr>
<?php

//orders from database
$sql = "SELECT * FROM orders"; // SQL query to select all orders
$res = mysqli_query($conn, $sql); // Execute the query
$sn=1; // Initialize serial number
//count rows to check if we have data in database
$count = mysqli_num_rows($res); // Get the number of rows in the result set

if($count >0){
    while($rows = mysqli_fetch_assoc($res)){
        // Using while loop to get all data from database
        // Using $rows['admin_id'] to get individual data
        $id = $rows['ID']; // Get order ID
        $drinks = $rows['Drinks']; // Get drink name
        $amount = $rows['Amount']; // Get amount
        $name = $rows['Name']; // Get customer name
        $email = $rows['Email']; // Get customer email
        $RoomNum = $rows['RoomNum']; // Get room number
        $total = $rows['Cost']; // Get total amount

        ?>
        <tr>
            <td><?php echo $sn++; ?></td><!-- Increment serial number for each order -->
            <td><?php echo $id; ?></td><!-- Display order ID -->                
            <td><?php echo $drinks; ?></td><!-- Display drink name -->
            <td><?php echo $amount; ?></td><!-- Display amount -->
            <td><?php echo $name; ?></td><!-- Display customer name -->
            <td><?php echo $email; ?></td><!-- Display customer email -->
            <td><?php echo $RoomNum; ?></td><!-- Display room number -->
            <td><?php echo $total; ?></td><!-- Display total amount -->
            <td> 
                <a href="update-Orders.php?id=<?php echo $id; ?>" class="btn-primary">Update Order</a>
                <a href="delete-orders.php?id=<?php echo $id; ?>" class="btn-secondary">Delete Order</a>
            </td>
        </tr>
        
        <?php
    }
}

else{
    //no data in database
    echo "<tr><td colspan='8' class='error'>No Orders Found</td></tr>";
}
?>

</table>
</div>
</div>
