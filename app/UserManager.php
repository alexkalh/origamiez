<?php

namespace Origamiez;

class UserManager {
	private $mailer;

	public function __construct( Mailer $mailer ) {
		$this->mailer = $mailer;
	}

	public function register( $email, $password ) {
		$this->mailer->mail( $email, 'Hello and welcome!' );
	}
}