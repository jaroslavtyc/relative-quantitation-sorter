<?php<?php
namespace RqData\Process\Exceptions;
use RqData\Debugging\Exceptions\User;

class CountingConsquencesOfCtMaximumFails extends \UnexpectedValueException implements User {}