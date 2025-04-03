<?php include('constant.php')?>
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
    

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="#" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <img src="" alt="" class="img-responsive img-curve">
                    </div>
    
                    <div class="">
                        <h3>Room price</h3>
                        <p class="">26</p>
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>

                    <div class="order-label">Full Name</div>

                    <input type="text" name="full-name" placeholder="" class="input-responsive" required>

                    <div class="order-label">Email</div>

                    <input type="email" name="email" placeholder="" class="input-responsive" required>

                    <div class="order-label">Address</div>

                    <textarea name="address" rows="10" placeholder="" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">

                </fieldset>

            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

</body>
</html>