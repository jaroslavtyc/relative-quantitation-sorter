<?php
namespace RqData\Process\Exceptions;
use RqData\Debugging\Exceptions\External;

class CalibratorMaximumCtValueOverflow extends \OverflowException implements External {}