<?php
        include('../configs/constants.php'); // Include database connection
     $id=$_GET['id']; // Get the ID of the admin to be deleted

     $sql="DELETE FROM admin WHERE ID=$id"; // SQL query to delete admin
     $res=mysqli_query($conn,$sql); // Execute the query

     if($res==true){
         // Query executed successfully and admin deleted
         $_SESSION['delete']="<div class='success'>Admin Deleted Successfully.</div>"; // Set success message
         header('location:manage-admin.php'); // Redirect to manage admin page
     }else{
         // Failed to delete admin
         $_SESSION['delete']="<div class='error'>Failed to Delete Admin.</div>"; // Set error message
         header('location:manage-admin.php'); // Redirect to manage admin page
     }
     // Close the database connection
?>