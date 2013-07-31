<?php
namespace RqData\Process\Exceptions;
use RqData\Debugging\Exceptions\External;

class EmptyInputFile extends \UnexpectedValueException implements External {}