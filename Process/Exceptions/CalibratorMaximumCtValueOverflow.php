<?php
namespace RqData\Process\Exceptions;
use RqData\Debugging\Exceptions\User;

class CalibratorMaximumCtValueOverflow extends \OverflowException implements User {}