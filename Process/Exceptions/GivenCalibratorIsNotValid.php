<?php
namespace RqData\Process\Exceptions;
use RqData\Debugging\Exceptions\External;

class GivenCalibratorIsNotValid extends \InvalidArgumentException implements External {}