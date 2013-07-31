<?php<?php
namespace RqData\Process\Exceptions;
use RqData\Debugging\Exceptions\External;

class InputFileIsMissing extends \UnexpectedValueException implements External {}