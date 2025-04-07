<?php include('constant.php')?>
<!DOCTYPE html>
<html>

<head>
    <title>Restaurant 1</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">




    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="styleSheet" href="css/bootstrap.min.css">
    <style>
        body {
            min-height: 80vh;
            display: flex;
            flex-direction: column;
            justify-content: center;


        }


        .box {
            max-height: 300px;
            overflow-y: auto;
            margin-top: 10px;

        }

        .top {
            height: 30px;

        }


        .box {
            max-height: 300px;
            overflow-y: auto;
            margin-top: 10px;
            padding: 15px;
            background: #fff;
            border-radius: 10px;
            border: 1px solid #ddd;
        }

        .card {
            position: relative;
            width: 600px;
            height: 370px;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            border-radius: 20px;
            overflow: visible;
            flex-direction: row;
        }
        h1{
            text-align: center;
            color: #706d6d;
        }

        .card1 {
            background: linear-gradient(135deg, #4a6f28, #80bfff);
        }

        .card2 {
            background: linear-gradient(135deg, #404622, #C2CFA1);
        }

        .card3 {
            background: linear-gradient(135deg, #ff48c4, #2bd1fc);
        }

        .card4 {
            background: linear-gradient(135deg, #5a3d2b, #ffecb4);
        }
        .card5{
            background:linear-gradient(135deg, #151515, #706d6d )
        }
        .card6{
            background:linear-gradient(135deg, #f09001, #d1c406)
        }


        .card img {
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translate(-50%);
            height: 350px;
            width: 300px;
            transition: all 0.5s;
        }

        .card:hover img {
            left: 80%;
            opacity: 1;
            height: 400px;
            width:350px;
            visibility: visible;
        }
        .card:hover .content {
            left: 50%;
            opacity: 1;
            width:50%;
            
            visibility: visible;
        }
        .card .content {
            opacity:0;
            visibility: hidden;
            left:70%;

            width:50%;
            padding:20px 20px 20px 40px;
            transition:0.5s;
         

        }

        .content h2 {
            color: #000000;
            text-transform: uppercase;
            font-size: 2.2em;
            line-height: 1em;
        }

        .content p {
            color: #000000;
        }

        .content a {
            position: relative;
            display: inline-block;
            color: #111;
            padding: 7px 15px;
            border-radius: 5px;
            background: #fff;
            margin-top: 5px;
            text-decoration: none;
        }

        .cards-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 50px;
            margin:auto;
            margin-top: 70px;
            margin-bottom: 70px;
        }
        .cards-container .h1{
            justify-content: center; 
            position: relative;

        }
    </style>
</head>

<body style="background-color:#003366;">
<nav class="navbar navbar-expand-lg bg-body-tertiary " data-bs-theme="dark">
			<div class="container-fluid">
				<a class="navbar-brand" href=#>Main Menu</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="nav nav-pills nav-fill">
					<a class="nav-link" href="Restaurant1.html">Restaurant</a>
					
					<a class="nav-link" href=restaurantMenu.html>See Menu</a>
					
					<a class="nav-link" href=drinks.html>Order the Drinks</a>
					
					<a class="nav-link" href=room.html>Book a Room</a>
					
					<a class="nav-link" href=Profile.php>Your Profile</a>
					
					<a class="nav-link" href=index.html>Login</a>
					
					<a class="nav-link" href=song.html>Karaoke</a>

					<a class="nav-link" href=apply.html>Apply</a>
					
				</ul>

				</div>
			</div>
		</nav>
    <div class="cards-container">
    <?php
     $sql2 ="SELECT * FROM rooms WHERE is_available = 1";

     $res2 = mysqli_query($conn, $sql2);

     $count2 = mysqli_num_rows($res2);

     if ($count2 > 0) {
        while($row=mysqli_fetch_assoc($res2)) {
        $id =$row['room_id'];
        $title =$row['type'];
        $price =$row['price'];
        $name =$row['name'];
        $desc = $row['description'];
        $img = $row['img_src'];
            ?>
            <div class="card card1">
            <div class="content">
                <h2><?php echo $name ?></h2>
                <p><?php echo $desc ?>
                </p>
                <a href="<?php echo SITEURL; ?>checkoutR.php?room_no=<?php echo $id ?>" class="btn btn-primary">Order</a>


            </div>
            <img src="<?php echo $img?>">
        </div>
            <?php

        }
     }
     else {
        echo"<div class='error'>No rooms available</div>";
     }
     ?>
     </div>


    
    
    



</body>

</html>