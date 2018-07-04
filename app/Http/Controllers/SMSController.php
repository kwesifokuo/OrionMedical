<?php

namespace OrionMedical\Http\Controllers;

use Illuminate\Http\Request;
use OrionMedical\Models\Event;
use OrionMedical\Http\Requests;
use Smsgh;
use BasicAuth;
use ApiHost;
use MessagingApi;
use Message;
use Response;

require 'Smsgh/Api.php';

class SMSController extends Controller
{
   

    public function SendSMS()
    {

    $messages = Event::where('notify',0)->get();

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
        $mesg->setContent($message->title);
        $mesg->setTo($message->mobile_number);
        $mesg->setFrom("Gilead");
        $mesg->setRegisteredDelivery(true);

        $messageResponse = $messagingApi->sendMessage($mesg);

        $response_code = Event::where('id', '=', $message->id)->update(array('notify' => 1));

    
    } 
    catch (Exception $ex) 
    {
        echo $ex->getTraceAsString();
    }

   

    
}


}
}
