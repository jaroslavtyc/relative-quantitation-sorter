<?php
namespace RqData\Process\Exceptions;
use RqData\Debugging\Exceptions\User;

class UndefinedReferenceGenes extends \OutOfBoundsException implements User {}