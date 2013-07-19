<?php<?php
namespace RqData\Process\Exceptions;
use RqData\Debugging\Exceptions\User;

class UnknownEffectOfGivenExtendingSetting extends \UnexpectedValueException implements User {}