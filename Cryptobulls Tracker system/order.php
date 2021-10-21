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

    if ($orderType == "Market(Buy)" || $orderType == "Market(Sell)") {
        $orderStatus = "Active";
        $query = "INSERT INTO Cryptobulls.orders (amount, tradeFrom, tradeTo, orderType, orderStatus) VALUES ('$amount', '$tradeFrom', '$tradeTo', '$orderType', '$orderStatus')";

    } 
    else if($orderType == "Buy_Limit" || $orderType == "Sell_Limit" || $orderType == "Buy_Stop" || $orderType == "Sell_Stop") {
        $orderStatus = "Pending";
        $query = "INSERT INTO Cryptobulls.orders (amount, tradeFrom, tradeTo, pendingPrice, orderType, orderStatus) VALUES ('$amount', '$tradeFrom', '$tradeTo', '$pendingPrice', '$orderType', '$orderStatus')";
 
    }

    $result = mysqli_query($conn, $query)

    ?>
</body>

</html>