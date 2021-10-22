<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place your order</title>

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
            <img src="assets/CryptoBulls logo.svg" alt="Cryptobulls logo" class="logo">
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
        // Get the current balance for the user's wallet
        require_once "config.php";

        $conn = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE)
        or die("Could not connect to database");
        $query = "SELECT * FROM wallet";
        $result = mysqli_query($conn, $query) or die("Could not get price");
        $row = mysqli_fetch_assoc($result);

        mysqli_close($conn);
        ?>

    <h1>Place your order</h1>
    <form action="order.php" method="post">
        <div class="container">
        <?php echo "<h5 id=\"balance\" style=\"margin-left:10px\">Your Balance: $" . $row['balance'] . "</h5>"; ?>
            <div class="inputs">
                <label for="amount">Amount</label><br>
                <input type="text" name="amount" id="amount" class="input"><br>
            
            </div>
            
            <div class="coin_choice">
            <div class="inputs">
                <label for="tradeFrom">Trade from:</label><br>
                <select name="tradeFrom" id="tradeFrom">
                    <option value="BTC">BTC</option>
                    <option value="ETH">ETH</option>
                    <option value="BNB">BNB</option>
                    <option value="ADA">ADA</option>
                    <option value="USDT">USDT</option>
                </select><br><br>
            </div>
           

            <div class="inputs">
                <label for="tradeTo">Trade to:</label><br>
                <select name="tradeTo" id="tradeFrom">
                    <option value="BTC">BTC</option>
                    <option value="ETH">ETH</option>
                    <option value="BNB">BNB</option>
                    <option value="ADA">ADA</option>
                    <option value="USDT">USDT</option>
                </select><br><br>
            </div>
        </div>

            <div class="inputs">
                <label for="orderType">Order type</label><br>
            <select name="orderType" id="orderType" onchange="isPendingCheck(this);">
                <option value="Market(Buy)" id="Market(Buy)">Market(Buy)</option>
                <option value="Market(Sell)" id="Market(sell)">Market(Sell)</option>
                <option value="Buy_Limit" id="Buy_Limit">Buy Limit</option>
                <option value="Sell_Limit" id="Sell_Limit">Sell Limit</option>
                <option value="Buy_Stop" id="Buy_Stop">Buy Stop</option>
                <option value="Sell_Stop" id="Sell_Stop">Sell Stop</option>
            </select><br>
            </div>
            
        
            <div id="pendingPrice" style="display: none; margin-left:10px;">
                <label for="price">Set pending order price:</label><br>
                <input type="text" name="pendingPrice" id="price" class="input"><br>
            </div>
            <br> 
            <div class="btn_options">
                <input type="submit" value="Place order" name="Place_order" class = "btn" id="order">
                <button class="btn" style="padding-bottom: 33px; margin-top: 18px">
                    <a href="deposit_withdraw.php" style="margin-top: 20px; color:white; background-color: #43b0f1; padding-top: 0;" >Deposit funds</a>
                </button>
            </div>
            
        </div>

    </form>
    
    <script type="text/javascript">
        function isPendingCheck(that) {
            
            if(that) {
                orderTypeOption1 = document.getElementById("Sell_Stop").value;
                orderTypeOption2 = document.getElementById("Buy_Stop").value;
                orderTypeOption3 = document.getElementById("Sell_Limit").value;
                orderTypeOption4 = document.getElementById("Buy_Limit").value;
                if(orderTypeOption1 == that.value || orderTypeOption2 == that.value || orderTypeOption3 == that.value || orderTypeOption4 == that.value) {
                    document.getElementById("pendingPrice").style.display = "block";
                }
                else {
                    document.getElementById("pendingPrice").style.display = "none";
                }
                
            }
            else {
                document.getElementById("pendingPrice").style.display = "none";
            }
        }
    </script>
</body>
</html>