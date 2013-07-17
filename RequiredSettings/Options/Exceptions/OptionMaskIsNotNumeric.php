<?php
namespace RqData\RequiredSettings\Options\Exceptions;

use RqData\Debugging\SystemException;

class OptionMaskIsNotNumeric extends \InvalidArgumentException implements SystemException {}