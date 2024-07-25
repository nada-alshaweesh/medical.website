<?php



require '../vendor/autoload.php';

use Infobip\Configuration;
use Infobip\Api\SmsApi;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Infobip\Model\SmsAdvancedTextualRequest;


// require __DIR__ . '\sms\vendor\autoload.php';
include_once("includes/dbconn.php");

$BASE_URL = "1v3dyd.api.infobip.com";
$API_KEY = "75acfcc24c18cefe97469960326ff64d-f1a78c76-dd90-42ab-bc26-31563cbcbd38";

$SENDER = "family medicine";
$RECIPIENT = "";
$MESSAGE_TEXT = "localhost/project/reset-password.php";

$configuration = new Configuration(host: $BASE_URL, apiKey: $API_KEY);

$sendSmsApi = new SmsApi(config: $configuration);

$destination = new SmsDestination(
    to: $RECIPIENT
);

$message = new SmsTextualMessage(destinations: [$destination], from: $SENDER, text: $MESSAGE_TEXT);

$request = new SmsAdvancedTextualRequest(messages: [$message]);

try {
    $smsResponse = $sendSmsApi->sendSmsMessage($request);

    echo $smsResponse->getBulkId() . PHP_EOL;

    foreach ($smsResponse->getMessages() ?? [] as $message) {
        echo sprintf('Message ID: %s, status: %s', $message->getMessageId(), $message->getStatus()?->getName()) . PHP_EOL;
    }
} catch (Throwable $apiException) {
    echo("HTTP Code: " . $apiException->getCode() . "\n");
}
