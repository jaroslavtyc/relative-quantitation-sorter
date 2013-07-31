<?php<?php
namespace RqData\Process\Exceptions;
use RqData\Debugging\Exceptions\External;

class NoOperationIsChoosen extends \InvalidArgumentException implements External {}