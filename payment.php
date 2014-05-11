<html>
<head>
    <meta charset="utf-8">
        <style>
            span.address {
                border: 1px solid black;
                padding: 2px 10px;
                font-family: monospace;
                text-align: center;
                background-color: white;
            }

            body {
                text-align: center;
            }

            input#confirm {
                background-color: #cc3512;
                background: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(0%, #ee5e3d), color-stop(70%, #cc3512));
                background: -webkit-linear-gradient(#ee5e3d, #cc3512 70%);
                background: -moz-linear-gradient(#ee5e3d, #cc3512 70%);
                background: -o-linear-gradient(#ee5e3d, #cc3512 70%);
                background: -ms-linear-gradient(#ee5e3d, #cc3512 70%);
                background: linear-gradient(#ee5e3d, #cc3512 70%);
                -moz-box-shadow: #f49883 0 1px 0 inset;
                -webkit-box-shadow: #f49883 0 1px 0 inset;
                -o-box-shadow: #f49883 0 1px 0 inset;
                box-shadow: #f49883 0 1px 0 inset;
                border: 1px solid #b52f10;
                color: white;
                text-shadow: #96270d 0 -1px 0;
                padding: 11px 19px;
                font-size: 15.5px;
                -webkit-border-radius: 6px;
                -moz-border-radius: 6px;
                border-radius: 6px;
                cursor: pointer;
                text-align: center;
            }
            div#instructions {
                background-color: #ddd;
            }

        </style>
</head>

<body>
    <form id="frm" name="frm" method="POST">
 <?php 
    //arbitrarily set
    ini_set('max_execution_time', 3000);

    require_once 'lib/moolahapi.php';

    $apiKey = "INSERT_API_KEY_HERE";

    $amount = $_GET['amount'];
    $coin = $_GET['coin'];
    $productName = "my_product";
    $callbackUrl = "index.html";
    $moolah = new MoolahTransaction($amount, $apiKey, $callbackUrl, $coin, $productName);

    // check for form submission (either confirm payment or automatic server check)
    // if false then this is the first run, do initial setup
    if (!isset($_POST['tx'])) {
        $result = $moolah->create_tx();
        if ($result !== false) {
            $value      = $result->{'amount'};
            $address    = $result->{'address'};
            $currency   = $result->{'currency'};
            $tx         = $result->{'tx'};
            $url        = $result->{'url'};
        }
        else {
            ?>
            <p> An Error occurred, click <a href="javascript:void(0);" onclick="window.location.reload()">here</a> to refresh the page </p>
            <?php
        }

    }
    else {
        $result = $moolah->check_tx($_POST['tx']);
        if ($result !== false) {
            $received   = $result->{'received'};
            $status     = $result->{'status'};
            $address    = $result->{'address'};
            $tx         = $result->{'tx'};
        }
        else {
            ?>
            <p> An Error occurred, click <a href="javascript:void(0);" onclick="window.location.reload()">here</a> to refresh the page </p>
            <?php
        }

        if ($status == "pending") {
            echo "<p class='message'>Not yet received.  It may take a moment.</p>";
        }
        if ($status == "cancelled") {
            echo "<p class='message'>Automatically cancelled due to inactivity.  No payment received, please come back to this page and try again.</p>";
        }
        if ($status == "part_paid") {
            echo "<p class='message'>Amount partially paid.  Received $received $coin</p>";
        }
        
        if ($status == "complete") {
            //// backend implementation up to you
            // mysql_connect("HOST", "username", "password");
            // mysql_select_db("dbName");
            // $sql = mysql_query("INSERT INTO tableName (...) values ($amount, $coin, '$received', '$tx', '$address')");
            
            // send message to parent page that payment has been completed
            //IMPORTANT you will have to change the URL to match the URL of the parent frame
            echo "<script type='text/javascript'>top.postMessage('secreto','http://localhost/Moolah-Payment-Example/index.html');</script>";
        }
    }
?>
    <h1>Powered by <a href="https://moolah.io" target="_blank">Moolah</a> API</h1>
    <h1><?php echo isset($status) ? "Status: " . $status : ""?></h1>
    <input type="hidden" name="tx" id="tx" value="<?php echo $tx?>" />

    <div id="instructions">
        <p>Send exactly <?php echo $amount?> <?php echo $coin?> to: </p>
        <span class="address"><?php echo $address?></span>

        <p>After sending to the above address click 'Confirm Payment' below.</p>
        
        <input type="submit" id="confirm" value="'Confirm Payment'" data-tx="<?php echo $tx ?>" />
        <br>
    </div>
</form>
</body>
<script>
    if (document.getElementById("frm")) {
        setTimeout("submitForm()", 20000); // set timeout 
    }

    function submitForm() {
        document.frm.submit();
    }
</script>
</html>
