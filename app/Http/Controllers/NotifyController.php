<?php

namespace OrionMedical\Http\Controllers;

use Illuminate\Http\Request;
use OrionMedical\Models\Event;
use OrionMedical\Models\SMS;
use OrionMedical\Http\Requests;
use Smsgh;
use BasicAuth;
use ApiHost;
use MessagingApi;
use Message;
use Response;

require 'Smsgh/Api.php';


 //require_once dirname(__FILE__) . '/../../smsghapi-php/Smsgh/Api.php';



class NotifyController extends Controller
{
    public function SendSMS()
    {

    $messages = SMS::where('status_sms','Unsent')->get();

    //dd($messages);

    // Here we assume the user is using the combination of his clientId and clientSecret as credentials
    $auth = new BasicAuth("ciiihqvu", "vjhfjgrv");

    // instance of ApiHost
    $apiHost = new ApiHost($auth);
    $enableConsoleLog = TRUE;
    $messagingApi = new MessagingApi($apiHost, $enableConsoleLog);

    foreach($messages as $message)
    {
    
    try 
    {
        // Default Approach
        $mesg = new Message();
        $mesg->setContent($message->content_2);
        $mesg->setTo($message->mobile);
        $mesg->setFrom("Gilead");
        $mesg->setRegisteredDelivery(true);

        $messageResponse = $messagingApi->sendMessage($mesg);

        $response_code = SMS::where('id', '=', $message->id)->update(array('status_sms' => 'Sent'));

    
    } 
    catch (Exception $ex) 
    {
        echo $ex->getTraceAsString();
    }

   

    
}


}
}
