<?php
namespace App\Domains\Core\Exceptions;

use Exception;

class StepNotFoundException extends Exception {
    const EXCEPTION_TRANSLATION_CODE = "EXCEPTION_MESSAGES.STEP.NOT_FOUND";
    const CODE = 20002;

    public function __construct()
    {
        parent::__construct(self::EXCEPTION_TRANSLATION_CODE, self::CODE, null);
    }
}