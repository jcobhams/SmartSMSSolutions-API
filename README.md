# SmartSMSSolutions-API
This is an unofficial API wwarapper written in php 5 oop style for consuming services offered by Smart SMS Solutions. This was developed for a cliient but i feel it'd serve the community good too.

USAGE

Include the file in your project after downloading. 

include("path/to/smartsmssolutions.php");

then instatiate the class with your credentials.

$smartsms = new smartSMSSolutions('your Awesome Username','yourstr0ngpa$$word');

now the object is created! - There are only two public methods. Thats sendMSG() and queryBalance(). There are a couple other private helper methods within the class.


METHOD DETAILS
All Data passed to the API endpoint is URLEncoded. There is no need to urlencode your data again.

sendMSG();
send an sms to the provided recipients.
$smartsms->sendMSG($sender,$recpients,$message); 
  Type: Public
  Return Value: json
  Example: {"state":"error","code":"2904","Message":"SMS Sending Failed"} or {"state":"success","Message":"Total Sent: 178, Failed: 10"}
  Params: 
      $sender {string, Sender ID eg. Vyren Media}
      $recipients {string, comma-seperated list or phone numbers to send to eg. 07012345678,08012345678,08123456789}
      $message {string, the body of the message to send. eg. Hi There Buddy!}
  
  
queryBalance();
Checks sms balance..
$smartsms->queryBalance() 
  Type: Public
  Return Value: json
  Example: {"state":"error","code":"2911","Password is empty"} or {"state":"success","balance":"17580.00"}
  Params: 
      nothing expected


handleResponse();
handles and/or composes API Response from the server
$smartsms->handleResponse($response); 
  Type: Private
  Return Value: json
  Example: {"state":"error","code":"2905","Message":"Invalid username/password combination"} or {"state":"success","Message":"Total Sent: 178, Failed: 10"}
  Params: 
      $response {string, API Server Response}
  

errorMap();
Hold a map of the error codes and their corresponding meanings. 
$smartsms->errorMap($code); 
  Type: Private
  Return Value: string
  Example: Gateway unavailable
  Params: 
      $code {string, Error Code eg. 2912}


ISSUES?

Am sure there will be. I have checked as much as i can but if you find one i missed, please let me know. shoot me a mail about it. jcobhams@vyrenmedia.com


Enjoy!
