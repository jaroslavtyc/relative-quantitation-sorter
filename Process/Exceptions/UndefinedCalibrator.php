<?php
namespace RqData\Process\Exceptions;
use RqData\Debugging\Exceptions\External;

class UndefinedCalibrator extends \OutOfBoundsException implements External {}