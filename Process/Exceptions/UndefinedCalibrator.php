<?php
namespace RqData\Process\Exceptions;
use RqData\Debugging\Exceptions\User;

class UndefinedCalibrator extends \OutOfBoundsException implements User {}