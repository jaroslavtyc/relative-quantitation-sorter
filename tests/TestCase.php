<?php
class TestCase extends \PHPUnit_Framework_TestCase {

	/**
	 * @return \Mockery\MockInterface
	 */
	protected function mock() {
		return call_user_func_array(array('\Mockery', 'mock'), func_get_args());
	}
}