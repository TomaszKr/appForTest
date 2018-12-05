<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Errors;

use Symfony\Component\Form\FormInterface;

/**
 * Zarządanie błędami na formularzu
 *
 * @author tomasz
 */
class ErrorForms
{

    /**
     * Metoda zwraca listę błędów z formularzu
     * 
     * @param FormInterface $form
     * @return array
     */
    public function showError(FormInterface $form)
    {
        $errors = array();
        foreach ($form->getErrors() as $error) {
            $errors[] = $error->getMessage();
        }
        foreach ($form->all() as $childForm) {
            if ($childForm instanceof FormInterface) {
                if ($childErrors = $this->showError($childForm)) {
                    $errors[$childForm->getName()] = $childErrors;
                }
            }
        }
        return $errors;
    }
}
