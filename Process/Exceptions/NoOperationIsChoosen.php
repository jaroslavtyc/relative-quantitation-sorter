<?php<?php
namespace RqData\Process\Exceptions;
use RqData\Debugging\Exceptions\User;

class NoOperationIsChoosen extends \InvalidArgumentException implements User {}