<?php
namespace app\utility;

class PasswordManager
{
	// function to create password hash
	public static function hashPassword ($password) {
		return md5 ($password);
	}
}