<?php
session_start();

// Sample products array
$products = [
    1 => ['name' => 'Product 1', 'price' => 10],
    2 => ['name' => 'Product 2', 'price' => 15],
    3 => ['name' => 'Product 3', 'price' => 20],
];

// Handle add to cart
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // If cart not set, create it
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // If product already in cart, update quantity
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] += $quantity;
    } else {
        $_SESSION['cart'][$product_id] = $quantity;
    }

    echo "<p>Added {$quantity} of Product {$product_id} to cart.</p>";
}
?>

<h2>Products</h2>
<ul>
<?php foreach ($products as $id => $product) : ?>
    <li>
        <?php echo $product['name']; ?> - $<?php echo $product['price']; ?>
        <form method="post" style="display:inline;">
            <input type="hidden" name="product_id" value="<?php echo $id; ?>">
            <input type="number" name="quantity" value="1" min="1" style="width:50px;">
            <button type="submit" name="add_to_cart">Add to Cart</button>
        </form>
    </li>
<?php endforeach; ?>
</ul>

<h3>Cart Contents:</h3>
<?php
if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $id => $qty) {
        echo "Product ID: $id | Quantity: $qty <br>";
    }
} else {
    echo "Cart is empty.";
}
?>
