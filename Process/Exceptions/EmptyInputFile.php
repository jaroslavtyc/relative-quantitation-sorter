<?php
namespace RqData\Process\Exceptions;
use RqData\Debugging\Exceptions\User;

class EmptyInputFile extends \UnexpectedValueException implements User {}