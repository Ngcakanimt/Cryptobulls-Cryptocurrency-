<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your trades</title>

    <!--This is for the icon to appear on the tab-->
    <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon">

    <!--This is for the icons in boxicons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <!--CSS stylesheet-->
    <link rel="stylesheet" href="css/trade.css">

</head>
<body>

<!--This is the header-->
<Header class="header" id="header">
        <a href="" class="nav_logo">
            <img src="assets/CryptoBulls logo.svg" alt="Cryptobulls logo">
        </a>
        <nav class="nav_container">
            <div class="nav_menu" id="nav-menu">
                <ul class="nav_list">
                    <li class="nav_item">
                        <a href="#cryptocurrencies" class="nav_link">Cryptocurrencies</a>
                    </li>
                    <li class="nav_item">
                        <a href="#trades" class="nav_link">Trades</a>
                    </li>
                    <li class="nav_item">
                        <a href="#wallet" class="nav_link">Wallet</a>
                    </li>
                    <li class="nav_item">
                        <a href="#watchlist" class="nav_link">Watchlist</a>
                    </li>
                </ul>
            </div> 
        </nav>

        <div class="buttons">
            <a href="#" class="log_in" id="log_in">
                <button type="button" class="button_login">Log in</button>
            </a>
            <a href="#" class="sign_in" id="sign_in">
                <button type="button" class="button_sign">Sign in</button>
            </a>
        </div>

        <div class="moon">
            <i class='bx bx-moon bx-md'></i>
            <button class="darkmode">
                <i class='bx bxs-moon bx-md' style='color:#f9e000'></i>
            </button>
        </div> 
        
    </Header>
    <hr>

    <h1>Your trades</h1>
    <form method="get">
        <button type="submit" value="Active" name="submit" class="btn">Active</button>
        <button type="submit" value="Pending" name="submit" class="btn">Pending</button>
        <button type="submit" value="History" name="submit" class="btn">Trading History</button>
    </form>
    <?php
        require_once("config.php");

        $conn = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE)
            or die("Could not connect to database");

        // Different queries for the statuses
        $query = "";

        if($_REQUEST['submit'] == "Active") {
            $query = "SELECT amount, tradeFrom, tradeTo, orderType, timeDate FROM orders WHERE orderStatus = 'Active'";
            // This is where the results of those queries are stored
            $result = mysqli_query($conn, $query) or die("ERROR: unable to load data");
            $num_trades = mysqli_num_rows($result);

            //fetch currenct price of cryptocurrency
            $price_query = "SELECT price FROM Cryptobulls.cryptocurrency";
            $price_result = mysqli_query($conn, $price_query) or die("couldn't get price");
            $row_price = mysqli_fetch_assoc($price_result);
        

            // Print table headers
            echo "<br>";
            echo "<table style=\"width: 80%;\">
            <tr style=\"background-color: #43b0f1;\">
                <td>Amount</td>
                <td>Trade From</td>
                <td>Trade To</td>
                <td>Ordered Price</td>
                <td>Order Type</td>
                <td>Data & Time</td>
                <td>Actions</td>

            </tr>";

            if($num_trades > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['amount'] . "</td>";
                    echo "<td>" . $row['tradeFrom'] . "</td>";
                    echo "<td>" . $row['tradeTo'] . "</td>";
                    echo "<td>" . "$ " . $row_price['price'] . "</td>";
                    echo "<td>" . $row['orderType'] . "</td>";
                    echo "<td>" . $row['timeDate'] . "</td>";
                    echo "<td>" . "<button type='submit' value='Closed' name='submit' id='cancel' onClick=\"return confirm('Are you sure you want to cancel this order?')\">"  . "<i class='bx bx-x bx-sm'></i>" . "</button>" . "</td>";
                }
            }
            else {
                echo '<img src="assets/undraw_void_3ggu.svg" alt="empty">';
                echo '<br>';
                echo '<p>You haven\'t placed any orders yet</p>';
            }
            echo "</table>";
        }
        else if($_REQUEST['submit'] == "Pending") {
            $query = "SELECT amount, tradeFrom, tradeTo, orderType, pendingPrice, timeDate FROM orders WHERE orderStatus = 'Pending'";
            // This is where the results of those queries are stored
            $result = mysqli_query($conn, $query) or die("ERROR: unable to load data");

            echo "<br>";
            echo "<table style=\"width: 80%;\">
            <tr style=\"background-color: #43b0f1;\">
                <td>Amount</td>
                <td>Trade from</td>
                <td>Trade to</td>
                <td>Limit/Order Price</td>
                <td>Order Type</td>
                <td>Data & Time</td>
                <td>Actions</td>

            </tr>";

            if($result->num_rows > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['amount'] . "</td>";
                    echo "<td>" . $row['tradeFrom'] . "</td>";
                    echo "<td>" . $row['tradeTo'] . "</td>";
                    echo "<td>" . "$" . $row['pendingPrice'] . "</td>";
                    echo "<td>" . $row['orderType'] . "</td>";
                    echo "<td>" . $row['timeDate'] . "</td>";
                    echo "<td>" . "<button type='submit' value='Closed' name='submit' id='cancel' onclick=>"  . "<i class='bx bx-x bx-sm'></i>" . "</button>" . "</td>";
    
                }
            }
            else {
                echo '<img src="assets/undraw_void_3ggu.svg" alt="empty">';
                echo '<br>';
                echo '<p>You haven\'t placed any orders yet</p>';
            }
           
        }
        else if($_REQUEST['submit'] == "History") {
            $query = "SELECT amount, tradeFrom, tradeTo, orderType, profitLoss, timeDate FROM orders WHERE orderStatus = 'Closed'";
            // This is where the results of those queries are stored
            $result = mysqli_query($conn, $query) or die("ERROR: unable to load data");

            echo "<br>";
            echo "<table style=\"width: 80%;\">
            <tr style=\"background-color: #43b0f1;\">
                <td>Amount</td>
                <td>Trade from</td>
                <td>Trade to</td>
                <td>Order Type</td>
                <td>Profit/Loss</td>
                <td>Data & Time</td>
            </tr>";

            if($result->num_rows > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['amount'] . "</td>";
                    echo "<td>" . $row['tradeFrom'] . "</td>";
                    echo "<td>" . $row['tradeTo'] . "</td>";
                    echo "<td>" . $row['orderType'] . "</td>";
                    echo "<td>" . $row['profitLoss'] . "</td>";
                    echo "<td>" . $row['timeDate'] . "</td>";
    
                }
            }
            else {
                echo '<img src="assets/undraw_void_3ggu.svg" alt="empty">';
                echo '<br>';
                echo '<p>You haven\'t placed any orders yet</p>';
            }

        }
        else if($_REQUEST['submit'] == "Closed") {
            $query = "UPDATE Cryptobulls.orders SET orderStatus = 'Closed' WHERE order_id = order_id";
            // This is where the results of those queries are stored
            $result = mysqli_query($conn, $query) or die("ERROR: unable to load data");
        }
        

        echo "</table>";

        

        mysqli_close($conn);
    
    ?>
    

</body>
</html>