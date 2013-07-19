<?php<?php
namespace RqData\Process\Exceptions;
use RqData\Debugging\Exceptions\User;

class MissingExtendingSettings extends \UnexpectedValueException implements User {}