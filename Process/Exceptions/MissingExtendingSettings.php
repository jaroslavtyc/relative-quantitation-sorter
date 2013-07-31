<?php<?php
namespace RqData\Process\Exceptions;
use RqData\Debugging\Exceptions\External;

class MissingExtendingSettings extends \UnexpectedValueException implements External {}