<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My wallet</title>

    <!--This is for the icon to appear on the tab-->
    <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon">

    <!--This is for the icons in boxicons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <!--CSS stylesheet-->
    <link rel="stylesheet" href="css/wallet.css">

    <script src="jquery-3.6.0.js"></script>
</head>
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

    <h1>Your wallet</h1>
    <br>
    
    <?php
        require_once "config.php";

        $conn = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE)
        or die("Could not connect to database");
        $query = "SELECT * FROM wallet";
        $result = mysqli_query($conn, $query) or die("Could not get price");
        $row = mysqli_fetch_assoc($result);

        echo "<h2 id=\"balance\">Your Balance: $" . $row['balance'] . "</h2>";

        mysqli_close($conn);
    ?>

    <?php
        require_once "config.php";

        $conn = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE)
            or die("Could not connect to database");
        $query = "SELECT * FROM wallet";
        $result = mysqli_query($conn, $query) or die("Could not get price");
        $row = mysqli_fetch_assoc($result);

        


        //Convert coins to BTC value
        $ethBTC = $row['ETH_amount'] * 0.06027995;
        $bnbBTC = $row['BNB_amount'] * 0.00762134;
        $adaBTC = $row['ADA_amount'] * 0.00003298;
        $usdtBTC = $row['USDT_amount'] * 0.00001564;
        //convert each crypto to usd value
        $btcUSD = round($row['BTC_amount'] * 63816.66, 2);
        $ethUSD = $row['ETH_amount'] * 3842.81 ;
        $bnbUSD = $row['BNB_amount'] * 486.76;
        $adaUSD = $row['ADA_amount'] * 2.11;
        $usdtUSD = $row['USDT_amount'] * 1.00;

        //Getting the total balance from the coin user holds
        $totalBalance = $row['balance'] + $btcUSD + $ethUSD + $bnbUSD + $adaUSD + $usdtUSD;

        $query_balance = "UPDATE Cryptobulls.wallet SET balance = '$totalBalance' WHERE wallet_id = '1'";
        $result_balance = mysqli_query($conn, $query_balance);

        // Print table headers
        echo '<div style="overflow-x:auto;">';
        echo "<br>";
        echo "<table style=\"width: 80%;\">
        <tr style=\"background-color: #43b0f1;\">
            <th>Coin</th>
            <th>Holdings</th>
            <th>BTC Value</th>
            <th>USD Value</th>

        </tr>";

        echo "<tr>";
        echo "<td>";
        echo "<div class=coins>";
        echo '<img src="assets/bitcoin-btc-logo.svg" alt="bitcoin" class="coins" width="30px" height="30px">';
        echo "</td>";
        echo "</div>";
        echo "<td>" . $row['BTC_amount'] . " BTC" . "</td>";
        echo "<td>" . $row['BTC_amount'] . " BTC" . "</td>";
        echo "<td>" . "$" . $btcUSD . "</td>";

        echo "<tr>";
        echo "<td>";
        echo "<div class=coins>";
        echo '<img src="assets/ethereum-eth-logo.svg" alt="ethereum" class="coins" width="30px" height="30px">';
        echo "</td>";
        echo "</div>";
        echo "<td>" . $row['ETH_amount'] . " ETH" . "</td>";
        echo "<td>" . $ethBTC . " BTC" . "</td>";
        echo "<td>" . "$" . $ethUSD . "</td>";

        echo "<tr>";
        echo "<td>";
        echo "<div class=coins>";
        echo '<img src="assets/binance-coin-bnb-logo.svg" alt="bitcoin" class="coins" width="30px" height="30px">';
        echo "</td>";
        echo "</div>";
        echo "<td>" . $row['BNB_amount'] . " ETH" . "</td>";
        echo "<td>" . $bnbBTC . " BTC" . "</td>";
        echo "<td>" . "$" . $bnbUSD . "</td>";

        echo "<tr>";
        echo "<td>";
        echo "<div class=coins>";
        echo '<img src="assets/cardano-ada-logo.svg" alt="bitcoin" class="coins" width="30px" height="30px">';
        echo "</td>";
        echo "</div>";
        echo "<td>" . $row['ADA_amount'] . " ADA" . "</td>";
        echo "<td>" . $adaBTC . " BTC" . "</td>";
        echo "<td>" . "$" . $adaUSD . "</td>";

        echo "<tr>";
        echo "<td>";
        echo "<div class=coins>";
        echo '<img src="assets/tether-usdt-logo.svg" alt="bitcoin" class="coins" width="30px" height="30px">';
        echo "</td>";
        echo "</div>";
        echo "<td>" . $row['USDT_amount'] . " USDT" . "</td>";
        echo "<td>" . $usdtBTC . " BTC" . "</td>";
        echo "<td>" . "$" . $usdtUSD . "</td>";
          
        echo "</table>";
        echo '</div>';

        mysqli_close($conn);
    ?>

     <!--This is the footer-->
     <footer class="footer_section">
            <hr>
            <h3>©2021 CryptoBulls</h3>
        </footer>
</body>
</html>