<?php
namespace RqData\Process\Exceptions;
use RqData\Debugging\Exceptions\User;

class UnfilledExtendingSettings extends \InvalidArgumentException implements User {}