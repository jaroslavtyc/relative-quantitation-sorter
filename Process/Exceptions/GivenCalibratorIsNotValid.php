<?php
namespace RqData\Process\Exceptions;
use RqData\Debugging\Exceptions\User;

class GivenCalibratorIsNotValid extends \InvalidArgumentException implements User {}