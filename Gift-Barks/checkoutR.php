<?php include('constant.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHECKOUT</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="main.css">
</head>

<body>
    <?php
    if (isset($_GET['room_no'])) {
        $room_no = $_GET['room_no'];
        $sql = "SELECT * FROM rooms WHERE room_id = '$room_no'";
        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);
        if ($count == 1) {
            $row = mysqli_fetch_assoc($res);
            $id = $row['room_id'];
            $title = $row['type'];
            $price = $row['price'];
            $name = $row['name'];
            $img = $row['img_src'];
        } else {
            header('location:' . SITEURL . 'room.php');
        }

    } else {
        header('location:' . SITEURL . 'room.php');
    }
    ?>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">

            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="#" class="order">
                <fieldset>
                    <legend>Selected Room</legend>

                    <div class="food-menu-img">
                        <?php
                        if ($img == "") {
                            echo "<div class='error'>Image not available</div>";
                        } else {

                            ?>
                            <img src="<?php echo $img?>" alt="<?php echo $type ?>" class="img-responsive img-curve">
                        <?php
                        }




                        ?>
                    </div>

                    <div class="title">
                        <h3><?php echo $name ?></h3>
                        <input type="hidden" name="room" value="<?php echo $name ?>">
                        <p class="price"><?php echo $price ?></p>
                        <input type="hidden" name="price" value="<?php echo $price ?>">
                    </div>

                </fieldset>

                <fieldset>
                    <legend>Delivery Details</legend>

                    <div class="order-label">Full Name</div>

                    <input type="text" name="full-name" placeholder="Joe Smith" class="input-responsive" required>

                    <div class="order-label">Email</div>

                    <input type="email" name="email" placeholder="JoeSmith@mail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>

                    

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">

                </fieldset>

            </form>
            <?php
            if(isset($_POST['submit']))
            {
                $room = $_POST['room'];
                $price = $_POST['price'];
                $name = $_POST['full-name'];
                $email = $_POST['email'];
                
                


            }
            
            
            ?>

        </div>
    </section>
   

</body>

</html>