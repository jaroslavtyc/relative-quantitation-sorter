<?php<?php
namespace RqData\Process\Exceptions;
use RqData\Debugging\Exceptions\External;

class CountingConsquencesOfCtMaximumFails extends \UnexpectedValueException implements External {}