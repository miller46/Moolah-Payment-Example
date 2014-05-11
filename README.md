Moolah-Payment-Example
=================================
Runnable example for receiving payments in various cryptocurrencies using Moolah API and iFrame. Bitcoin, Litecoin, Dogecoin, Vertcoin, etc.

Prerequisites
---------------------------------
1) Moolah account.  Sign up for a free merchant account at <a href="https://moolah.io">Moolah.io</a> and get your API key under API Settings (https://moolah.io/merchant/api for logged in users).

2) You will need to enter in your Moolah API Key on line 55 of payment.php

3) Not Internet Explorer.  I don't think this works in IE although there is a workaround for that to be added later.

Usage
---------------------------------
This is a fully runnable example on receiving a payment that can be embedded within an existing workflow using iFrame and Moolah's API.  Edit line 55 of payment.php with your Moolah API key.  Edit line 111 of payment.php to reflect location of index.html.  You will need to change line 6 of index.html if your web server is not running on localhost (port 80) to reflect 'event origin' of iFrame.  See next section for more details on the points above.

Usage in More Detail
---------------------------------
Download the 3 pages and don't forget to drop in your Moolah API Key on line 55 of payment.php.  You will also need to declare the location of the index.html page in the URL in line 111 of payment.php to send a message using post messgae protocol. 

If your web server is anything except localhost on port 80, you will also have to change line 111 of payment.php and line 6 of index.html to reflect the location of your web server.  Read up on post message protocol for more info.

Select your coin of choice from the drop down and enter in the amount.  This info is sent to the payment frame, which creates a transaction using Moolah API.  Send the correct amount of coins to the address provided in the frame through your favorite method, and then click the confirm transaction button to check Moolah servers for transaction (and page checks every 20 seconds on its own).  When payment is successful, text will change on parent frame.  
