<?php

declare(strict_types=1);

namespace Service;

use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidationException
{
    /** @var ConstraintViolationListInterface */
    private $errors;

    /**
     * ValidationException constructor.
     * @param ConstraintViolationListInterface $errors
     */
    public function __construct(ConstraintViolationListInterface $errors)
    {
        $this->errors = $errors;
        parent::__construct('Validation Exception');
    }

    /**
     * @return ConstraintViolationListInterface
     */
    public function getErrors()
    {
        return $this->errors;
    }
}
