<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>

     <!--This is for the icon to appear on the tab-->
     <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon">

     <!--This is for the icons in boxicons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <!--CSS stylesheet-->
    <link rel="stylesheet" href="css/order.css">
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
                        <a href="cryptocurrency.php" class="nav_link">Cryptocurrencies</a>
                    </li>
                    <li class="nav_item">
                        <a href="trades.php" class="nav_link">Trades</a>
                    </li>
                    <li class="nav_item">
                        <a href="wallet.php" class="nav_link">Wallet</a>
                    </li>
                    <li class="nav_item">
                        <a href="watchlist.php" class="nav_link">Watchlist</a>
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

    <?php
    require_once "config.php";

    $amount = $_REQUEST['amount'];
    $tradeFrom = $_REQUEST['tradeFrom'];
    $tradeTo = $_REQUEST['tradeTo'];
    $orderType = $_REQUEST['orderType'];
    $pendingPrice = $_REQUEST['pendingPrice'];
    $orderStatus = "";
    $query= "";



    $conn = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) or die("Could not connect to database");

    $query_row = "SELECT * FROM wallet";
    $result_row = mysqli_query($conn, $query_row) or die("Could not get price");
    $row = mysqli_fetch_assoc($result_row);
    $balance = $row['balance'];

    if($amount > $balance) {
        echo "<div class=\"error\">";
        echo "<img src=\"assets/undraw_access_denied_re_awnf.svg\" alt=\"denied\" style=\"width: 590px; height:590px;\">";
        echo "<h4>Sorry, you cannot trade more than your balance</h4>";
        echo "<br>";
        echo "<a href=\"place_order.php\">";
        echo "<button class=\"btn\">Go back</button>";
        echo "</a>";
    }
    elseif(empty($amount)) {
        echo "<div class=\"error\">";
        echo "<img src=\"assets/undraw_access_denied_re_awnf.svg\" alt=\"denied\" style=\"width: 590px; height:590px;\">";
        echo "<h4>Sorry, you cannot leave the amount field empty</h4>";
        echo "<br>";
        echo "<a href=\"place_order.php\">";
        echo "<button class=\"btn\" style=\"padding-bottom: 30px;\">Go back</button>";
        echo "</a>";
    }
    else if ($orderType == "Market(Buy)" || $orderType == "Market(Sell)") {
        $orderStatus = "Active";
        $query = "INSERT INTO Cryptobulls.orders (amount, tradeFrom, tradeTo, orderType, orderStatus) VALUES ('$amount', '$tradeFrom', '$tradeTo', '$orderType', '$orderStatus')";
        $result = mysqli_query($conn, $query) or die("Could not query");
    } 
    else if($orderType == "Buy_Limit" || $orderType == "Sell_Limit" || $orderType == "Buy_Stop" || $orderType == "Sell_Stop") {
        $orderStatus = "Pending";
        $query = "INSERT INTO Cryptobulls.orders (amount, tradeFrom, tradeTo, pendingPrice, orderType, orderStatus) VALUES ('$amount', '$tradeFrom', '$tradeTo', '$pendingPrice', '$orderType', '$orderStatus')";
        $result = mysqli_query($conn, $query) or die("Could not query");
    }

    mysqli_close($conn);

    ?>
    
</body>

</html>