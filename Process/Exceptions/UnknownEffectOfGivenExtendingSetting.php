<?php<?php
namespace RqData\Process\Exceptions;
use RqData\Debugging\Exceptions\External;

class UnknownEffectOfGivenExtendingSetting extends \UnexpectedValueException implements External {}