<?php
namespace RqData\Core;

abstract class Object {
	public function __get($name) {
		throw new Exceptions\ReadingAccess(sprintf('Reading of property [%s->%s] fails. Does not exists or has restricted access.', \get_class($this), $name));
	}

	public function __set($name, $value) {
		throw new Exceptions\WrittingAccess(sprintf('Writting to property [%s->%s] fails. Does not exists or has restricted access.', \get_class($this), $name));
	}

	public function __isset($name) {
		throw new Exceptions\ReadingAccess(sprintf('Checking property [%s->%s] if is set fails. Does not exists or has restricted access.', \get_class($this), $name));
	}

	public function __call($name, $parameters) {
		throw new Exceptions\ExecutingAccess(sprintf('Executing method [%s->%s] fails. Does not exists or has restricted access.', \get_class($this), $name));
	}

	public static function __callStatic($name, $parameters) {
		throw new Exceptions\ExecutingAccess(sprintf('Executing static method [%s->%s] fails. Does not exists or has restricted access.', \get_called_class(), $name));
	}
}
