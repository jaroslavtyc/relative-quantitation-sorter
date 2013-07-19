<?php<?php
namespace RqData\Process\Exceptions;
use RqData\Debugging\Exceptions\User;

class InputFileIsMissing extends \UnexpectedValueException implements User {}