<?php

namespace Origamiez;

interface IMailer {
	function mail($recipient, $content);
}