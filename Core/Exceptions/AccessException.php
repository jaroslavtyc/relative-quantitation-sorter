<?php
namespace RqData\Core\Exceptions;

use RqData\Debugging\SystemException;

class AccessException extends \OutOfBoundsException implements SystemException {}