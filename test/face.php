<?php
$photoSize = 50;
$borderColor = '#000000'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $photoSize = isset($_POST['photo-size']) ? intval($_POST['photo-size']) : 50;
    $borderColor = isset($_POST['border-color']) ? htmlspecialchars($_POST['border-color']) : '#000000';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Peys App</title>
</head>
<body>
<div>
    <h1>Peys App</h1>
    <form method="post">
        <div>
            <label for="photo-size">Select Photo Size (1-100):</label>
            <input type="range" id="photo-size" name="photo-size" min="1" max="100" value="<?php echo $photoSize; ?>">
        </div>
        <div>
            <label for="border-color">Select Border Color:</label>
            <input type="color" id="border-color" name="border-color" value="<?php echo $borderColor; ?>">
        </div>
        <div>
            <button type="submit">Process</button>
        </div>
        <div>
            <img src="./hans.jpg" alt="Profile Picture" style="width: <?php echo $photoSize; ?>%; border: 5px solid <?php echo $borderColor; ?>;">
        </div>
    </form>
</div>
</body>
</html>
