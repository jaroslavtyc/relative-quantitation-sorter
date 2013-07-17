<?php
namespace RqData\RequiredSettings\Options\Exceptions;

use RqData\Debugging\SystemException;

class UnkownIntBinKey extends \InvalidArgumentException implements SystemException {}