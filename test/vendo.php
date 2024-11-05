<?php 

$sizePrices = [
    'regular' => 0,
    'upSize' => 10,
    'jambo' => 15
];

$sizeOptions = [
    'regular' => 'Regular ',
    'upSize' => 'Up Size + 5',
    'jambo' => 'Jambo + 10 '
];

?>

<!DOCTYPE html>
<html>
<head>
  <title>Vendo Machine</title>
</head>
<body>

<h1>Vendo Machine</h1>

<form method="post">
  <h2>Products:</h2>
  <input type="checkbox" name="products[]" value="coke"> Coke - P15<br>
  <input type="checkbox" name="products[]" value="sprite"> Sprite - P20<br>
  <input type="checkbox" name="products[]" value="royal"> Royal - P20<br>
  <input type="checkbox" name="products[]" value="pepsi"> Pepsi - P15<br>
  <input type="checkbox" name="products[]" value="mountain_dew"> Mountain Dew - P20<br>

  <h2>Options:</h2>
  <label for="size">Size:</label>
  <select name="size">
    <option value="">Select Size</option>
    <?php foreach ($sizeOptions as $value => $displayName): ?>
        <option value="<?php echo $value; ?>"><?php echo $displayName; ?></option>
    <?php endforeach; ?>
  </select>

  <label for="quantity">Quantity:</label>
  <input type="number" name="quantity" id="quantity" value="0" min="0">

  <input type="submit" name="submit" value="Check Out">
</form>

<?php

if (isset($_POST['submit'])) {
    $products = isset($_POST['products']) ? $_POST['products'] : [];
    $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 0;
    $size = isset($_POST['size']) ? $_POST['size'] : '';

    // Validate inputs
    if (empty($products) || $quantity <= 0 || empty($size)) {
        echo "<h2>Please select at least one product, choose a size, and enter a quantity greater than zero.</h2>";
    } else {
        $total_amount = 0;
        $total_items = 0;
        $purchase_summary = "";

        foreach ($products as $product) {
            $price = 0;

            switch ($product) {
                case 'coke':
                    $price = 15;
                    break;
                case 'sprite':
                    $price = 20;
                    break;
                case 'royal':
                    $price = 20;
                    break;
                case 'pepsi':
                    $price = 15;
                    break;
                case 'mountain_dew':
                    $price = 20;
                    break;
            }

          
            $price += $sizePrices[$size];

            $total_amount += $price * $quantity;
            $total_items += $quantity;
            $purchase_summary .= "You purchased $quantity $product(s) for P$price each.<br>";
        }

        echo "<h2>Purchase Summary:</h2>";
        echo $purchase_summary;
        echo "<p>Total Items: $total_items</p>";
        echo "<p>Total Amount: P$total_amount</p>";
    }
}

?>
</body>
</html>
