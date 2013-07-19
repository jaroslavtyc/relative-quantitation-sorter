<?php<?php
namespace RqData\Process\Exceptions;
use RqData\Debugging\Exceptions\User;

class UnknownChoosenOperationCode extends \UnexpectedValueException implements User {}