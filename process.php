<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Process Transaction</title>
</head>
<body>
    <?php

    if(isset($_POST['submit'])) {
        $amount = $_REQUEST['amount'];
        $transMethod = $_REQUEST['transaction'];
        $coin = $_REQUEST['coin'];

        require_once("config.php");

        $conn = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE)
        or die("Could not connect to database");
        // Get current information on the wallet
        $query_wallet = "SELECT * FROM wallet";
        $result_wallet = mysqli_query($conn, $query_wallet) or die("Could not get price");
        $row = mysqli_fetch_assoc($result_wallet);
        $walletID = $row['wallet_id'];

        $query = "";
        $result = "";
        
        // Deposit and withdraw funds from user's wallet
        if($transMethod == "Deposit") {
            if($transMethod == "BTC") {
                $new_BTC = $row['BTC_amount'] + $amount;
                $query = "UPDATE Cryptobulls.wallet SET `BTC_amount` = '12.0000' WHERE Cryptobulls.wallet = '$walletID' ";
                
            }
            else if($transMethod == "ETH") {
                $new_ETH = $row['ETH_amount'] + $amount;
                $query = "UPDATE Cryptobulls.wallet SET `ETH_amount` = '$new_ETH' WHERE Cryptobulls.wallet = '$walletID' ";
                
            }
            else if($transMethod == "BNB") {
                $new_BNB = $row['ETH_amount'] + $amount;
                $query = "UPDATE Cryptobulls.wallet SET `BNB_amount` = '$new_BNB' WHERE Cryptobulls.wallet = '$walletID' ";
                
            }
            else if($transMethod == "ADA") {
                $new_ADA = $row['ETH_amount'] + $amount;
                $query = "UPDATE Cryptobulls.wallet SET `ADA_amount` = '$new_ADA' WHERE Cryptobulls.wallet = '$walletID' ";
                
            }
            else if($transMethod == "USDT") {
                $new_USDT = $row['USDT_amount'] + $amount;
                $query = "UPDATE Cryptobulls.wallet SET `USDT_amount` = '$new_USDT' WHERE Cryptobulls.wallet = '$walletID' ";
                
            }
        }
        else if($transMethod == "Withdraw") {
            if($transMethod == "BTC") {
                $new_BTC = $row['BTC_amount'] - $amount;
                $query = "UPDATE Cryptobulls.wallet SET `BTC_amount` = '$new_BTC' WHERE Cryptobulls.wallet = '$walletID' ";
                
            }
            else if($transMethod == "ETH") {
                $new_ETH = $row['ETH_amount'] - $amount;
                $query = "UPDATE Cryptobulls.wallet SET `ETH_amount` = '$new_ETH' WHERE Cryptobulls.wallet = '$walletID' ";
                
            }
            else if($transMethod == "BNB") {
                $new_BNB = $row['BNB_amount'] - $amount;
                $query = "UPDATE Cryptobulls.wallet SET `BNB_amount` = '$new_BNB' WHERE Cryptobulls.wallet = '$walletID' ";
                
            }
            else if($transMethod == "ADA") {
                $new_ADA = $row['ADA_amount'] - $amount;
                $query = "UPDATE Cryptobulls.wallet SET `ADA_amount` = '$new_ADA' WHERE Cryptobulls.wallet = '$walletID' ";
                
            }
            else if($transMethod == "USDT") {
                $new_USDT = $row['USDT_amount'] - $amount;
                $query = "UPDATE Cryptobulls.wallet SET `USDT_amount` = '$new_USDT' WHERE Cryptobulls.wallet = '$walletID' ";
                
            }
            
        }
        $result = mysqli_query($conn, $query) or die("couldn't execute command");
        
    } 

    ?>
</body>
</html>