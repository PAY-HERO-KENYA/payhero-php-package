<?php
class PayHeroAPI {
    private $apiUsername;
    private $apiPassword;
    private $baseUrl = 'https://backend.payhero.co.ke/api/v2/';

   
    public function __construct($apiUsername, $apiPassword) {
        $this->apiUsername = $apiUsername;
        $this->apiPassword = $apiPassword;
    }

    /**
     * Generates an authentication token for the API.
     *
     * This function takes the API username and password stored in the class instance variables,
     * combines them into a string, encodes the string using base64 encoding, and returns the
     * resulting authentication token in the format 'Basic {encoded_credentials}'.
     *
     * @return string The generated authentication token.
     */
    private function generateAuthToken() {
        $credentials = $this->apiUsername . ':' . $this->apiPassword;
        $encodedCredentials = base64_encode($credentials);
        return 'Basic ' . $encodedCredentials;
    }

    /**
     * Makes a request to the specified URL using the specified HTTP method and data.
     *
     * @param string $url The URL to make the request to.
     * @param string $method The HTTP method to use for the request. Default is 'GET'.
     * @param mixed $data The data to send with the request (for 'POST' requests only). Default is null.
     * @return string The response from the request.
     */
    private function makeRequest($url, $method = 'GET', $data = null) {
        $curl = curl_init();
        $headers = array(
            'Authorization: ' . $this->generateAuthToken()
        );

        if ($method === 'POST' && $data !== null) {
            $headers[] = 'Content-Type: application/json';
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        }

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->baseUrl . $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_HTTPHEADER => $headers,
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    /**
     * Get the service wallet balance.
     *
     * @return mixed
     */
    public function getServiceWalletBalance() {
        return $this->makeRequest('wallets?wallet_type=service_wallet');
    }

    /**
     * Retrieves the payment wallet balance.
     *
     * @return mixed The payment wallet balance.
     */
    public function getPaymentWalletBalance() {
        return $this->makeRequest('wallets?wallet_type=payment_wallet');
    }

    /**
     * Top up the service wallet with the given amount and phone number.
     *
     * @param int $amount The amount to be top uped.
     * @param string $phone The phone number associated with the top up.
     */
    public function topUpServiceWallet($amount,$phone) {
        return $this->makeRequest('topup','POST',['amount'=>$amount,'phone_number'=>$phone]);
    }

    /**
     * SendCustomerMpesaStkPush function sends a customer Mpesa STK push request.
     *
     * @param int $amount amount to be paid
     * @param string $phone Mpesa registered phone number
     * @param int $channel_id Your registered payment channel id on Pay hero
     * @param string $external_reference Your reference for the transaction
     * @param string $callback_url (Optional) Your callback url
     */
    public function SendCustomerMpesaStkPush($amount,$phone,$channel_id,$external_reference,$callback_url='') {
        return $this->makeRequest('payments','POST',['amount'=>$amount,'phone_number'=>$phone,'channel_id'=>$channel_id,'external_reference'=>$external_reference,'callback_url'=>$callback_url,'provider'=>'m-pesa']);
    }

    /**
     * Retrieves the status of a transaction using its reference.
     *
     * @param string $reference The reference of the transaction.
     * @return mixed The response from the request.
     */
    public function getTransactionStatus($reference) {
        return $this->makeRequest('transaction-status?reference='.$reference);
    }

    /**
     * Retrieves the account transactions for a specific page and number of transactions per page.
     *
     * @param int $page The page number of the transactions to retrieve.
     * @param int $per The number of transactions to retrieve per page.
     * @return mixed The response from the makeRequest method.
     */
    public function getAccountTransactions($page,$per){
        return $this->makeRequest('transactions?page='.$page.'&per_page='.$per);
    }

    /**
     * Sends a payment request to the SasaPay API.
     *
     * @param float $amount The amount of the payment.
     * @param string $phone The phone number of the payer.
     * @param string $network_code The network code of the payer's phone number.
     * @param string $external_reference The external reference for the payment.
     * @param string $callback_url (optional) The URL to which the API should send a callback after the payment is processed.
     * @return mixed The response from the API.
     */
    public function sasaPayPayment($amount,$phone,$network_code,$external_reference,$callback_url='') {
        return $this->makeRequest('payments','POST',['amount'=>$amount,'phone_number'=>$phone,'network_code'=>$network_code,'external_reference'=>$external_reference,'callback_url'=>$callback_url,'provider'=>'sasapay']);
    }

    /**
     * Sends a withdrawal request to a mobile phone number using SasaPay API.
     *
     * @param float $amount The amount to be withdrawn.
     * @param string $phone The phone number to which the withdrawal will be sent.
     * @param string $network_code The network code of the phone number's network.
     * @param string $external_reference An external reference for the withdrawal.
     * @param string $callback_url (optional) The URL to which SasaPay will send a callback after the withdrawal is processed.
     * @return mixed The response from the makeRequest method.
     */
    public function sasaPayWithdrawToMobile($amount,$phone,$network_code,$external_reference,$callback_url='') {
        return $this->makeRequest('withdraw','POST',['amount'=>$amount,'phone_number'=>$phone,'network_code'=>$network_code,'external_reference'=>$external_reference,'callback_url'=>$callback_url,'channel'=>'mobile']);
    }

    /**
     * Sends a withdrawal payment to a bank account.
     *
     * @param float $amount The amount to be withdrawn.
     * @param string $account_number The account number to which the payment will be withdrawn.
     * @param string $network_code The network code of the bank.
     * @param string $external_reference An external reference for the withdrawal.
     * @param string $callback_url (optional) The URL to which the callback will be sent.
     */
    public function sasaPayWithdrawToBank($amount,$account_number,$network_code,$external_reference,$callback_url='') {
        return $this->makeRequest('withdraw','POST',['amount'=>$amount,'account_number'=>$account_number,'network_code'=>$network_code,'external_reference'=>$external_reference,'callback_url'=>$callback_url,'channel'=>'bank']);
    }
}