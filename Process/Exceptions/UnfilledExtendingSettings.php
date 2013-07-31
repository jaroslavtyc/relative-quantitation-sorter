<?php
namespace RqData\Process\Exceptions;
use RqData\Debugging\Exceptions\External;

class UnfilledExtendingSettings extends \InvalidArgumentException implements External {}