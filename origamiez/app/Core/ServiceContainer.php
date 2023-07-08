<?php

namespace Origamiez\Core;
class ServiceContainer {
	/**
	 * @var \DI\Container
	 */
	private $_container;

	public function __construct() {
		$builder = new \DI\ContainerBuilder();
		$builder->addDefinitions( [] );
		$builder->useAutowiring( true );
		$builder->useAnnotations( false );
		$this->_container = $builder->build();
	}
}