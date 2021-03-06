<?php
// Strategy Interface
interface PaymentGateway
{
    public function pay($amount);
}
// Concrete Strategy
class PayByDcCc implements PaymentGateway
{
    public function pay($amount)
    {
        echo "Paid $amount via Debit/Credit Card \n";
    }
}
// Concrete Strategy
class PayByPaypal implements PaymentGateway
{
    public function pay($amount)
    {
        echo "Paid $amount via PayPal \n";
    }
}
// Context
class Order
{
    private $paymentGateway;
    public function setPaymentGateway(PaymentGateway $paymentGateway)
    {
        $this->paymentGateway = $paymentGateway;
    }
    public function pay($amount)
    {
        $this->paymentGateway->pay($amount);
    }
}
// Client code
$order = new Order();
$order->setPaymentGateway(new PayByDcCc());
$order->pay(189);
// Client code
$order = new Order();
$order->setPaymentGateway(new PayByPaypal());
$order->pay(199);
