<?php
namespace RqData\Core\Exceptions;

use RqData\Debugging\CoreException;

class AccessException extends \OutOfBoundsException implements CoreException {}