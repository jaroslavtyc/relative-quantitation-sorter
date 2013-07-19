<?php<?php
namespace RqData\Process\Exceptions;
use RqData\Debugging\Exceptions\User;

class MissingConsequenceForCtMaximumValue extends \UnexpectedValueException implements User {}