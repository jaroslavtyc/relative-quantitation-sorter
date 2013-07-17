<?php
namespace RqData\View;

interface Fetcher {

	public function assign($name, $value);

	public function fetch();
}