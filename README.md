# PayHeroAPI PHP Client

This PHP client library enables easy interaction with the PayHero API, allowing developers to integrate PayHero's payment processing capabilities into their PHP applications. With this client, you can perform operations like checking wallet balances, topping up service wallets, initiating payments, and querying transaction statuses.

## Features

- **Wallet Balance Inquiry:** Check the balance of service and payment wallets.
- **Wallet Top-Up:** Top up service wallets with a specified amount.
- **Payment Processing:** Send customer M-Pesa STK Push for payment collection.
- **Transaction Status:** Check the status of a specific transaction.
- **Account Transactions:** Retrieve a list of transactions for an account.
- **SasaPay Payments:** Process payments through SasaPay.
- **Withdrawals:** Withdraw funds to mobile or bank accounts via SasaPay.

## Installation

To use this PHP client in your project, simply include the `PayHeroAPI` class in your PHP script.

```php
require_once 'path/to/ph-class.php';
```

## Usage

### Initializing the Client

```php
$apiUsername = 'your_api_username';
$apiPassword = 'your_api_password';
$payHeroAPI = new PayHeroAPI($apiUsername, $apiPassword);
```

### Checking Wallet Balances

```php
$serviceWalletBalance = $payHeroAPI->getServiceWalletBalance();
$paymentWalletBalance = $payHeroAPI->getPaymentWalletBalance();
```

### Topping Up Service Wallet

```php
$topUpResponse = $payHeroAPI->topUpServiceWallet($amount, $phone);
```

### Sending Customer M-Pesa STK Push

```php
$stkPushResponse = $payHeroAPI->SendCustomerMpesaStkPush($amount, $phone, $channel_id, $external_reference, $callback_url);
```

### Checking Transaction Status

```php
$transactionStatus = $payHeroAPI->getTransactionStatus($reference);
```

## Requirements

- PHP 5.6 or newer
- cURL support enabled in PHP

## Contributing

Contributions to the PayHeroAPI PHP client are welcome. Please ensure that your code adheres to the existing style and that all tests pass.

## License

This project is licensed under the MIT License - see the LICENSE file for details.
```
