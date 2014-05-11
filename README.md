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
This is a fully runnable example on receiving a payment that can be embedded within a workflow using iFrame and Moolah's API.  

Download the 3 pages and don't forget to drop in your Moolah API Key on line 55 of payment.php

If your web server is anything except localhost on port 80, you will also have to change line 111 of payment.php and line 6 of index.html to reflect the location of your web server.  Read up on post message protocol for more info.

Select your coin of choice from the drop down and enter in the amount.  This info is sent to the payment frame, which creates a transaction using Moolah API.  Send the correct amount of coins to the address provided in the frame through your favorite method, and then click the confirm transaction button to check Moolah servers for transaction (and page checks every 20 seconds on its own).  When payment is successful, text will change on parent frame.  
