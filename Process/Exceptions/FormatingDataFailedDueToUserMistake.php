<?php
namespace RqData\Process\Exceptions;
use RqData\Debugging\Exceptions\User;

class FormatingDataFailedDueToUserMistake extends \RuntimeException implements User {}