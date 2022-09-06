<?php
defined('BASEPATH') or exit('No direct script access alloewed');

class Voicemail extends CI_Controller{

    public function voice(){
       $sessionId = $_POST['sessionId'];

		// Check to see whether this call is active
		$isActive  = $_POST['isActive'];

		if ($isActive == 1)  {
			$phone = $_POST['callerNumber'];
			$text = 'Welcome to Patazone, please wait on the line as you call is transferred to the next available agent. Thank you';
			$audiourl = 'https://patazone.co.ke/assets/audio/voice.mp3';//replace with url to your call waiting audio
			// Compose the response
			$response  = '<?xml version="1.0" encoding="UTF-8"?>';
			$response .= '<Response>';
			//$response .= '<Say>'.$text.'</Say>';//you can replace this with play if you have an audio
			//$response .='<Play url="https://patazone.co.ke/assets/audio/voice.mp3"/>';
			$response .= '<Dial record="true" maxDuration="60" sequential="false" phoneNumbers="254700588885,254794079728,254729747250" ringbackTone="https://patazone.co.ke/assets/audio/voice.mp3" />';//remove ringback tone attribute if you have no audio, remove sequential if using one number
			// $response .= '<Redirect>https://domain/voice2.php</Redirect>'; 
			$response .= '</Response>';
			header('Content-type: text/plain');
			echo $response;
			// Print the response onto the page so that our gateway can read it


		} else {
			// Read in call details (duration, cost). This flag is set once the call is completed.
			// Note that the gateway does not expect a response in this case

			$duration     = $_POST['durationInSeconds'];
			$currencyCode = $_POST['currencyCode'];
			$amount       = $_POST['amount'];

			// You can then store this information in the database for your records
		} 
    }

}