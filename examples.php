<?php
require_once 'ph-class.php';
//Get this under API Keys section on https://app.payhero.co.ke/api_keys
$apiUsername = '';
$apiPassword = '';
$payHeroAPI = new PayHeroAPI($apiUsername, $apiPassword);

/*EXAMPLE USAGE:*/

// 1. Get service wallet balance
$serviceWalletBalance = $payHeroAPI->getServiceWalletBalance();
echo $serviceWalletBalance;

// 2. Get payment wallet balance
$paymentWalletBalance = $payHeroAPI->getPaymentWalletBalance();
echo $paymentWalletBalance;

// 3. Top up service wallet: pass in amount and phone number
$topUpServiceWallet = $payHeroAPI->topUpServiceWallet(10, '0708344101');
echo $topUpServiceWallet;

// 4. Send Customer Mpesa Stk Push: pass in amount, phone number, channel_id, your_reference and callback_url
$sendCustomerMpesaStkPush = $payHeroAPI->SendCustomerMpesaStkPush(10, '0708344101', '234', '1234567890', '#');
echo $sendCustomerMpesaStkPush;

// 5. Get transaction status: pass in reference
$transactionStatus = $payHeroAPI->getTransactionStatus('c253264d-44eb-4520-9d67-038cdde39a16');
echo $transactionStatus;

// 6. Get account transactions: pass in page number and records per page
$accountTransactions = $payHeroAPI->getAccountTransactions(1,5);
echo $accountTransactions;

// 7. Sasa Pay payment: pass in amount, phone number, channel_id, your_reference and callback_url
$sasaPayPayment = $payHeroAPI->sasaPayPayment(120, '0708344101', '63902', '1234567890', '#');
echo $sasaPayPayment;

// 8. Sasa pay withdraw to mobile: pass in amount, phone number, network code, your_reference and callback_url
$sasaPayWithdrawToMobile = $payHeroAPI->sasaPayWithdrawToMobile(10, '0708344101', '63902', '1234567890', '#');
echo $sasaPayWithdrawToMobile;

// 9. Sasa pay withdraw to bank: pass in amount, account number, network code, your_reference and callback_url
$sasaPayWithdrawToBank = $payHeroAPI->sasaPayWithdrawToBank(110, '440200003200', '07', '1234567890', '#');
echo $sasaPayWithdrawToBank;
