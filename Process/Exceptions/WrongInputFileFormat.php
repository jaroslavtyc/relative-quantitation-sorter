<?php
namespace RqData\Process\Exceptions;
use RqData\Debugging\Exceptions\User;

class WrongInputFileFormat extends \UnexpectedValueException implements User {}