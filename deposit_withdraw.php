<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deposit</title>

     <!--This is for the icon to appear on the tab-->
     <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon">

    <!--This is for the icons in boxicons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <!--CSS stylesheet-->
    <link rel="stylesheet" href="css/deposit_withdraw.css">
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

    <main>
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

        <h1 style="padding-left: 20px; margin-top: 20px;">Deposit/Withdraw</h1>
        
    <div class="container" style="margin-left: auto; margin-right:auto; margin-top:20px">
    <form action="process.php" method="post">
        <?php echo "<h5 id=\"balance\">Your Balance: $" . $row['balance'] . "</h5>"; ?>
        <label for="amount">Amount</label><br>
        <input type="text" name="amount" id="amount"><br><br>

        <label for="transaction">Transaction method</label><br>
        <select name="transaction" id="transaction">
            <option value="Deposit">Deposit</option>
            <option value="Withdraw">Withdraw</option>
        </select><br>
        <label for="Choose a coin"></label><br>
        <div class="inputs">
                <label for="Choose coin">Select coin:</label><br>
                <select name="coin" id="coin">
                    <option value="BTC">BTC</option>
                    <option value="ETH">ETH</option>
                    <option value="BNB">BNB</option>
                    <option value="ADA">ADA</option>
                    <option value="USDT">USDT</option>
                </select><br><br>
            </div>
        <div class="submit">
            <input type="submit" value="submit" name="submit" class="btn">
        </div>
        
    </form>
    </div>
    <div class="converter" style="padding-left: 400px; padding-right:400px; margin-top:20px;" >
            <crypto-converter-widget shadow symbol live background-color="#383a59" border-radius="0.57rem" fiat="united-states-dollar" crypto="bitcoin" amount="1" font-family="sans-serif" decimal-places="2"></crypto-converter-widget><a href="https://currencyrate.today/" target="_blank" rel="noopener"></a><script async src="https://cdn.jsdelivr.net/gh/dejurin/crypto-converter-widget@1.5.2/dist/latest.min.js"></script>
        </div>
    </main>

    <!--This is the footer-->
    <footer class="footer_section">
        <div class="footer_container">
        <h3 style="padding-top:13px;">©2021 CryptoBulls</h3>
        <div style="padding-top: 5px;">
            <a href="#aboutUs" class="links">About us</a>
            <a href="#contactUs" class="links">Contact us</a>
        </div>
        <div class="socials">
            <h4>Follow us</h4>
            <i class='bx bxl-facebook bx-md'></i>
            <i class='bx bxl-instagram bx-md'></i>
        </div>
    </footer>
</body>
</html>