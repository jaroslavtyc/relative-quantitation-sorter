<?php
namespace RqData\Core;

abstract class Object {

	public function __get($name) {
		throw new \RqData\Core\Exceptions\ReadingAccess(sprintf('Reading of variable [%s->%s] fails. Does not exists or has restricted access.', \get_class($this), $name));
	}

	public function __set($name) {
		throw new \RqData\Core\Exceptions\WrittingAccess(sprintf('Writting to variable [%s->%s] fails. Does not exists or has restricted access.', \get_class($this), $name));
	}

	public function __isset($name) {
		throw new \RqData\Core\Exceptions\ReadingAccess(sprintf('Checking variable [%s->%s] if is set fails. Does not exists or has restricted access.', \get_class($this), $name));
	}

	public function __call($name) {
		throw new \RqData\Core\Exceptions\ExecutingAccess(sprintf('Executing function [%s->%s] fails. Does not exists or has restricted access.', \get_class($this), $name));
	}

	public function __callStatic($name) {
		throw new \RqData\Core\Exceptions\ExecutingAccess(sprintf('Executing static function [%s->%s] fails. Does not exists or has restricted access.', \get_class($this), $name));
	}
}