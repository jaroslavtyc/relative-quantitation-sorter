<?php<?php
namespace RqData\Process\Exceptions;
use RqData\Debugging\Exceptions\External;

class UnknownChoosenOperationCode extends \UnexpectedValueException implements External {}