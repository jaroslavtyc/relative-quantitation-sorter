<?php
namespace RqData\RequiredSettings\Options\Exceptions;

use RqData\Debugging\CoreException;

class OutOfColumnsPurposeList extends \OutOfBoundsException implements CoreException {}