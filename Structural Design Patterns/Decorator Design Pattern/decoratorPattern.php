<?php
// Target/client
interface Share
{
    // Request
    public function shareData();
}
// Adaptee/Service
class WhatsAppShare
{
    // Special Request
    public function wappShare(String $string)
    {
        echo "Share data via WhatsApp: ' $string ' \n";
    }
}

//another adaptee
class FacebookShare
{
    public function facebookShare($string)
    {
        echo "Share data via Facebook: ' $string ' \n";
    }
}
// Adapter
class WhatsAppShareAdapter implements Share
{
    private $whatsapp;
    private $data;
    public function __construct(WhatsAppShare $whatsapp, String $data)
    {
        $this->whatsapp = $whatsapp;
        $this->data = $data;
    }
    public function shareData()
    {
        $this->whatsapp->wappShare($this->data);
    }
}
function clientCode(Share $share)
{
    $share->shareData();
}

class FacebookShareAdapter implements Share
{
    private $facebook;
    private $data;

    public function __construct(FacebookShare $facebook, $data)
    {
        $this->facebook = $facebook;
        $this->data = $data;
    }

    public function shareData()
    {
        $this->facebook->facebookShare($this->data);
    }
}


$wa = new WhatsAppShare();
$waShare = new WhatsAppShareAdapter($wa, "Hello Whatsapp");
clientCode($waShare);

echo "\n";

$fb = new FacebookShare();
$fbShare = new FacebookShareAdapter($fb, "Hello Facebook");
clientCode($fbShare);
