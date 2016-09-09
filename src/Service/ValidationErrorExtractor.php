<?php

namespace ErrorExtractor\Service;

use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidationErrorExtractor
{
    /**
     * Return validation errors as array ['field' => 'error message',]
     *
     * @param ConstraintViolationListInterface $errors
     * @return array|null
     */
    public function extract(ConstraintViolationListInterface $errors)
    {
        return array_reduce(
            iterator_to_array($errors),
            function (array $carry, ConstraintViolationInterface $error) {
                return array_merge($carry, [$error->getPropertyPath() => $error->getMessage()]);
            },
            []
        );
    }
}