<?php
namespace RqData\RequiredSettings\Options\Exceptions;

use RqData\Debugging\CoreException;

class OptionMaskIsNotNumeric extends \InvalidArgumentException implements CoreException {}