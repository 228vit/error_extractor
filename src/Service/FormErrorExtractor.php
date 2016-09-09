<?php

namespace ErrorExtractor\Service;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormError;

class FormErrorExtractor
{

    /**
     * Return current forms errors as simple array ['field' => 'error']
     * @param Form $form
     * @return array
     */
    public function extract(Form $form)
    {
        return array_reduce(
            iterator_to_array($form->getErrors(true, true)),
            function (array $carry, FormError $error) {
                return array_merge($carry, [$error->getOrigin()->getName() => $error->getMessageTemplate()]);
            },
            []
        );
    }

}