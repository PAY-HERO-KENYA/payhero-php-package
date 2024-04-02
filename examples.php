<?php
require_once 'ph-class.php';
//Get this under API Keys section on https://app.payhero.co.ke/api_keys
$apiUsername = '';
$apiPassword = '';
$payHeroAPI = new PayHeroAPI($apiUsername, $apiPassword);

/*EXAMPLE USAGE:*/

// 1. Get service wallet balance
//$serviceWalletBalance = $payHeroAPI->getServiceWalletBalance();
//echo $serviceWalletBalance;

// 2. Get payment wallet balance
// $paymentWalletBalance = $payHeroAPI->getPaymentWalletBalance();
// echo $paymentWalletBalance;

// 3. Top up service wallet
// $topUpServiceWallet = $payHeroAPI->topUpServiceWallet(10, '0708344101');
// echo $topUpServiceWallet;

// 4. Send Customer Mpesa Stk Push
// $sendCustomerMpesaStkPush = $payHeroAPI->SendCustomerMpesaStkPush(10, '0708344101', '234', '1234567890', '#');
// echo $sendCustomerMpesaStkPush;

// 5. Get transaction status
// $transactionStatus = $payHeroAPI->getTransactionStatus('c253264d-44eb-4520-9d67-038cdde39a16');
// echo $transactionStatus;

// 6. Get account transactions
// $accountTransactions = $payHeroAPI->getAccountTransactions(1,5);
// echo $accountTransactions;

// 7. Sasa Pay payment
// $sasaPayPayment = $payHeroAPI->sasaPayPayment(120, '0708344101', '63902', '1234567890', '#');
// echo $sasaPayPayment;

// 8. Sasa pay withdraw to mobile
// $sasaPayWithdrawToMobile = $payHeroAPI->sasaPayWithdrawToMobile(10, '0708344101', '63902', '1234567890', '#');
// echo $sasaPayWithdrawToMobile;

// 9. Sasa pay withdraw to bank
// $sasaPayWithdrawToBank = $payHeroAPI->sasaPayWithdrawToBank(110, '440200003200', '07', '1234567890', '#');
// echo $sasaPayWithdrawToBank;
