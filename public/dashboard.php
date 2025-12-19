<?php

session_start();


include_once '../config/db.php';

$db = new Database();
$conn = $db->getConnection();

// Fetch products
$query = "SELECT id, name, price, stock, image FROM products ORDER BY id DESC";
$result = $conn->query($query);

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Dashboard - Product Listing</title>
<link rel="stylesheet" href="assets/css/style2.css">

</head>

<body>
<nav class="top-nav">
    <div class="nav-left">
        <h3 class="logo">ShopAdmin</h3>

        <ul class="nav-links">
            <li><a href="dashboard.php" class="active">📦 Products</a></li>
            <li><a href="add_product.php">➕ Add Product</a></li>
            <li><a href="orders.php">🛒 Cart</a></li>
            <li><a href="settings.php">⚙️ Settings</a></li>
        </ul>
    </div>

    <div class="nav-right">
        <span>Welcome, <strong><?php echo $_SESSION['username']; ?></strong></span>
        <a href="logout.php" class="logout-btn" action="index.php">Logout</a>
    </div>
</nav>

<main class="content">
    <div class="container">
        <h1>Product Listing</h1>

<div class="product-grid">
    <?php /*while($row = $result->fetch_assoc()): */ ?> 
    <div class="product-wrapper">
        <div class="product-card">
            <div class="product-image">
                    <div><img src='assets/uploads/dressq.jpg' alt="Product"></div> 
                     
            </div>
            
            <div class="product-info">
                <h3><?php /*echo htmlspecialchars($row['name']);*/ ?></h3>
                <p class="price">RM<?php /*echo number_format($row['price'], 2); */?></p>
                <p class="stock">Stock: <?php /*echo $row['stock']; */ ?></p>
                
                <div class="card-actions">
                    <a href="cart.php" class="add-link">Add</a>
                    
                </div>
            </div>
        </div>
        <div class="product-card">
            <div class="product-image">
                    <div><img src='assets/uploads/dressq.jpg' alt="Product"></div> 
                     
            </div>
            
            <div class="product-info">
                <h3><?php /*echo htmlspecialchars($row['name']);*/ ?></h3>
                <p class="price">RM<?php /*echo number_format($row['price'], 2); */?></p>
                <p class="stock">Stock: <?php /*echo $row['stock']; */ ?></p>
                
                <div class="card-actions">
                    <a href=add class="add-link">Add</a>
                </div>
            </div>
        </div>

        <div class="product-card">
            <div class="product-image">
                    <div><img src='assets/uploads/dressq.jpg' alt="Product"></div> 
                     
            </div>
            
            <div class="product-info">
                <h3><?php /*echo htmlspecialchars($row['name']);*/ ?></h3>
                <p class="price">RM<?php /*echo number_format($row['price'], 2); */?></p>
                <p class="stock">Stock: <?php /*echo $row['stock']; */ ?></p>
                
                <div class="card-actions">
                    <a href=add class="add-link">Add</a>
                </div>
            </div>
        </div>

        <div class="product-card">
            <div class="product-image">
                    <div><img src='assets/uploads/dressq.jpg' alt="Product"></div> 
                     
            </div>
            
            <div class="product-info">
                <h3><?php /*echo htmlspecialchars($row['name']);*/ ?></h3>
                <p class="price">RM<?php /*echo number_format($row['price'], 2); */?></p>
                <p class="stock">Stock: <?php /*echo $row['stock']; */ ?></p>
                
                <div class="card-actions">
                    <a href=add class="add-link">Add</a>
                </div>
            </div>
        </div>

        <div class="product-card">
            <div class="product-image">
                    <div><img src='assets/uploads/dressq.jpg' alt="Product"></div> 
                     
            </div>
            
            <div class="product-info">
                <h3><?php /*echo htmlspecialchars($row['name']);*/ ?></h3>
                <p class="price">RM<?php /*echo number_format($row['price'], 2); */?></p>
                <p class="stock">Stock: <?php /*echo $row['stock']; */ ?></p>
                
                <div class="card-actions">
                   <a href=add class="add-link">Add</a>
                </div>
            </div>
        </div>
</div>
    <?php /* endwhile; */?>
</div>

    </div>
</main>


</body>
</html>
