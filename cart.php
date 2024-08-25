<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Shopping Cart</title>
   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php 
include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:user_login.php');
};

if(isset($_POST['delete'])){
   $cart_id = $_POST['cart_id'];
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
   $delete_cart_item->execute([$cart_id]);
}

if(isset($_GET['delete_all'])){
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
   $delete_cart_item->execute([$user_id]);
   header('location:cart.php');
}

include 'components/user_header.php'; 
?>

<section class="products shopping-cart">

   <h3 class="heading">Shopping Cart</h3>

   <div class="box-container">

      <!-- Example Cart Item -->
      <form action="" method="post" class="box">
         <input type="hidden" name="cart_id" value="1">
         <a href="quick_view.php?pid=1" class="fas fa-eye"></a>
         <img src="uploaded_img/example.jpg" alt="">
         <div class="name">Product Name</div>
         <div class="flex">
            <div class="price">$20.00/-</div>
            <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
            <button type="submit" class="fas fa-edit" name="update_qty"></button>
         </div>
         <div class="sub-total"> Sub total : <span>$20.00/-</span> </div>
         <input type="submit" value="Delete Item" onclick="return confirm('Delete this from cart?');" class="delete-btn" name="delete">
      </form>
      <!-- End of Example Cart Item -->
   </div>

   <div class="cart-total">
      <p>Grand total : <span>$40.00/-</span></p>
      <a href="shop.php" class="option-btn">Continue Shopping</a>
      <a href="cart.php?delete_all" class="delete-btn" onclick="return confirm('Delete all from cart?');">Delete All Items</a>
      <a href="checkout.php" class="btn">Proceed to Checkout</a>
   </div>

</section>

<!-- Include footer -->
<footer>

</footer>

<script src="js/script.js"></script>

</body>
</html>
