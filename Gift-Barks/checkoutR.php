<?php include('constant.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHECKOUT</title>
    <link rel="stylesheet" href="main.css">
    <style>
    body {
        
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: burlywood;
    }

    .food-search {
        padding: 3rem 0;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    .food-search h2 {
        color: #fff;
        margin-bottom: 2rem;
        text-align: center;
    }

    .order {
        background-color: rgba(255, 255, 255, 0.9);
        padding: 2rem;
        border-radius: 10px;
        max-width: 600px;
        width: 100%;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .food-menu-img {
        float: left;
        width: 50%;
        margin-right: 1rem;
    }

    .food-menu-img img {
        max-width: 100%;
        height: auto;
        border-radius: 10px;
    }

    .title {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .title h3 {
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
    }

    .title .price {
        font-size: 1.2rem;
        color: #333;
        margin-bottom: 1rem;
    }

    .order-label {
        font-weight: bold;
        margin-top: 1rem;
        display: block;
    }

    .input-responsive {
        width: 100%;
        padding: 0.8rem;
        margin-top: 0.5rem;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    textarea.input-responsive {
        resize: none;
    }

    .btn-primary {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 1rem 2rem;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 1rem;
        width: 100%;
        text-align: center;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    </style>
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

    <section class="food-search">
        <div class="container">
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="checkout.php" method="POST" class="order">
                <fieldset>
                    <legend>Selected Room</legend>

                    <div class="food-menu-img">
                        <?php if ($img == ""): ?>
                            <div class="error">Image not available</div>
                        <?php else: ?>
                            <img src="<?php echo $img ?>" alt="<?php echo $type ?>" class="img-responsive img-curve">
                        <?php endif; ?>
                    </div>

                    <div class="title">
                        <h3><?php echo $name ?></h3>
                        <input type="hidden" name="room" value="<?php echo $name ?>">
                        <p class="price">€<?php echo $price ?></p>
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
                    <textarea name="address" rows="5" placeholder="Enter your address" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>
            </form>
        </div>
    </section>
</body>

</html>