<?php
$IDClient = 'Your Customer ID';
$APIKey = 'Your API Key'; #On demand
$Message = '<html><head></head><body>Send from API</body></html>';
$Subject = 'Send from API with PHP';
$email = 'example@mailpro.com,,,,,,,,,,,,,,,,,,,,,,,,,';
$CarnetName = 'Name of the AddressBook';
$AddressBookId = addAddressBook($IDClient,$APIKey,$CarnetName ,'1');
addEmail($APIKey,$AddressBookId,$IDClient,$email);
$MessageId = addMessage($IDClient,$APIKey,$Subject,$Message,'EN','center','1');
$IDEmailExp = getListOfEmailSenders ($APIKey,$IDClient);
addSend ($IDClient,$APIKey,$AddressBookId,$MessageId,$IDEmailExp,'1');
function addAddressBook($IDClient,$APIKey,$Title,$Type) {
$urlAdd = 'https://api.mailpro.com/v2/addressbook/add.xml';
$post = array(
'APIKey' => $APIKey,
'Title' => $Title,
'IDClient' => $IDClient,
'Type' => $Type );
$tagName = 'AddressBookId';
return sendPostData($urlAdd, $post,$tagName);
}
function addEmail($APIKey,$AddressBookId,$IDClient,$EmailList) {
$urlAdd = 'https://api.mailpro.com/v2/email/add.xml';
$post = array(
'APIKey' => $APIKey,
'AddressBookId' => $AddressBookId,
'IDClient' => $IDClient,
'emailList' => $EmailList );
$tagName ='NumberEmail';
return sendPostData($urlAdd, $post,$tagName);
}
function addMessage($IDClient,
$APIKey,$Subject,$BodyHTML,$Language,$linkAlign,$LinkUp){
$urlAdd = 'https://api.mailpro.com/v2/message/add.xml';
$post = array(
'IDClient' => $IDClient,
'APIKey' => $APIKey,
'Subject' => $Subject,
'BodyHTML' => $BodyHTML,
'Language' => $Language,
'linkAlign' => $linkAlign,
'LinkUp' => $LinkUp );
$tagName = 'MessageId';
return sendPostData($urlAdd, $post,$tagName);
}
function getListOfEmailSenders($APIKey,$IDClient) {
62
$urlAdd = 'https://api.mailpro.com/v2/senderEmail/list.xml';
$post = array(
'APIKey' => $APIKey,
'IDClient' => $IDClient );
$tagName = 'ExpEmailId';
return sendPostData($urlAdd, $post,$tagName);
}
function addSend($IDClient,$APIKey,$AddressBookId,$IDMessage,$IDEmailExp,$Campaign)
{
$urlAdd = 'https://api.mailpro.com/v2/send/add.xml';
$post = array(
'IDClient' => $IDClient,
'APIKey' => $APIKey,
'IDAddressBook' => $AddressBookId,
'IDMessage' => $IDMessage,
'IDEmailExp'=> $IDEmailExp,
'Campaign' => $Campaign );
$tagName = 'IDSend';
return sendPostData($urlAdd, $post,$tagName);
}
function sendPostData($urlAdd, $post,$tagName){
$ch = curl_init($urlAdd);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$resultat = curl_exec($ch);
$xml = new DomDocument('1.0');
$xml->loadXML($resultat);
$element = $xml->getElementsByTagName($tagName);
return $element ->item(0)->nodeValue;
}
?>
