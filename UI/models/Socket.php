<?php

namespace app\models;

use yii\base\Model;

class Socket extends Model
{
	public $socket;
	public $receiveBuffer;
	public $receiveMessageLength;
	
	public function __construct ()
	{
		if (!$this->socket = @socket_create (AF_INET, SOCK_STREAM, 0))
		{
			$errorcode = socket_last_error ();
			$errormsg = socket_strerror ($errorcode);
			
			$this->addError('Create', 'Could not create socket: [' . $errorcode . ']' . $errormsg);
		}
	}
	
	public function connect ()
	{
		if (!@socket_connect ($this->socket, '192.168.137.1' , 10011))
		{
			$errorcode = socket_last_error ();
			$errormsg = socket_strerror ($errorcode);
			
			$this->addError ('Connect', 'Could not connect: [' .  $errorcode . ']' . $errormsg);
		}
	}
	
	public function send ($message)
	{
		$message = chr(strlen($message)) . $message;
		if (!@socket_send ($this->socket , $message, strlen ($message) , 0))
		{
			$errorcode = socket_last_error ();
			$errormsg = socket_strerror ($errorcode);
			
			$this->addError ('Send', 'Could not send data: [' .$errorcode . ']' . $errormsg);
		}
	}
	
	public function receive ()
	{
		if (!@socket_recv ( $this->socket , $this->receiveMessageLength , 1, MSG_WAITALL ))
		{
			$errorcode = socket_last_error ();
			$errormsg = socket_strerror ($errorcode);
				
			$this->addError ('Receive', 'Could not receive data: [' .$errorcode. ']' . $errormsg);
		}

		if (!@socket_recv ( $this->socket , $this->receiveBuffer , ord ($this->receiveMessageLength), MSG_WAITALL ))
		{
			$errorcode = socket_last_error ();
			$errormsg = socket_strerror ($errorcode);
			
			$this->addError ('Receive', 'Could not receive data: [' .$errorcode. ']' . $errormsg);
		}
		
		return $this->receiveBuffer;
		
		if ($this->receiveBuffer[0] == 0)	//online users
		{
			$message = substr ($this->receiveBuffer,2);
			$users = explode (' ', $message);
		}
		else if ($this->receiveBuffer[0] == 1)	//login
		{
			$message = substr ($this->receiveBuffer,2);
		}
		else if ($this->receiveBuffer[0] == 2)	//logout
		{
			$message = substr ($this->receiveBuffer,2);
		}
		else if ($this->receiveBuffer[0] == 3)	//logout
		{
			$message = substr ($this->receiveBuffer,2);
			$user = explode (' ', $message, 1);
			$msg = substr ($message, strlen (user)+3);
		}
	}
}