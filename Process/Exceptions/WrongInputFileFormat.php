<?php
namespace RqData\Process\Exceptions;
use RqData\Debugging\Exceptions\External;

class WrongInputFileFormat extends \UnexpectedValueException implements External {}