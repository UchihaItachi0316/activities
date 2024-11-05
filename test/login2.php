<?php 
$email = '';
$password = '';
$job = '';
$errors = array();
$successMessage = '';

// Define static accounts
$staticAccounts = [
    [
        'username' => 'jimbo',
        'password' => 'jimbo123',
        'position' => 'admin'
    ],
    [
        'username' => 'hans',
        'password' => 'hans123',
        'position' => 'content manager'
    ],
    [
        'username' => 'benitez',
        'password' => 'ben123',
        'position' => 'system user'
    ]
];

// Job positions for the select box
$jobPositions = [
    'admin' => 'Admin',
    'content manager' => 'Content Manager',
    'system user' => 'System User'
];

if (isset($_POST['btn'])) {
    $email = htmlspecialchars(stripslashes(trim($_POST['gmail'])));
    $password = htmlspecialchars(stripslashes(trim($_POST['password']))); 
    $job = $_POST['job'];

    // Validate email
    if (empty($email)) {
        $errors[] = 'Email is required';
    } 

    // Validate password
    if (empty($password)) {
        $errors[] = 'Password is required';
    } 

    // Validate job position
    if (empty($job)) {
        $errors[] = 'Position is required'; 
    }

    // Check if there are no errors
    if (empty($errors)) {
        // Check against static account details
        $validCredentials = false;
        foreach ($staticAccounts as $account) {
            if ($email === $account['username'] && $password === $account['password'] && $job === $account['position']) {
                $validCredentials = true;
                break;
            }
        }

        if ($validCredentials) {
            $successMessage = "Login successful! Welcome, $email!";
        } else {
            $errors[] = 'Invalid credentials. Please try again.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body#LoginForm {
            background-image: url("https://hdwallsource.com/img/2014/9/blur-26347-27038-hd-wallpapers.jpg");
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            padding: 10px;
        }
        .main-div {
            background: #ffffff;
            border-radius: 2px;
            margin: 10px auto 30px;
            max-width: 38%;
            padding: 50px 70px 70px 71px;
        }
        .form-control {
            height: 50px;
            border-radius: 4px;
            margin-bottom: 10px;
        }
        .btn-primary {
            width: 100%;
            height: 50px;
            line-height: 50px;
            font-size: 14px;
        }
        .container {
            text-align: center;
        }
    </style>
</head>
<body id="LoginForm">
<div class="container">
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger mt-3" id="errorMessages">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php elseif ($successMessage): ?>
        <div class="alert alert-success mt-3">
            <?php echo $successMessage; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="login-form">
            <div class="main-div">
                <div class="panel">
                    <h2>Admin Login</h2>
                    <p>Please enter your email and password</p>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="gmail" placeholder="Username (Email )" value="<?php echo htmlspecialchars($email); ?>" onfocus="clearErrors()" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password" onfocus="clearErrors()" required>
                </div>
                <div class="form-group">
                    <select name="job" class="form-control" onfocus="clearErrors()" required>
                        <option value="">Select Job</option>
                        <?php foreach ($jobPositions as $value => $displayName): ?>
                            <option value="<?php echo $value; ?>" <?php echo ($job === $value) ? 'selected' : ''; ?>>
                                <?php echo $displayName; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" name="btn" value="login" onclick="clearErrors()">Login</button>
            </div>
        </div>
    </form>
</div>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script>
    function clearErrors() {
        document.getElementById('errorMessages').innerHTML = '';
        document.getElementById('errorMessages').style.display = 'none';
    }
</script>
</body>
</html>