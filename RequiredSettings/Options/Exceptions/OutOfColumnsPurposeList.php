<?php
namespace RqData\RequiredSettings\Options\Exceptions;

use RqData\Debugging\SystemException;

class OutOfColumnsPurposeList extends \OutOfBoundsException implements SystemException {}