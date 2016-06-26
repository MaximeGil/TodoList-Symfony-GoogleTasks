<?php
namespace TodoListBundle\Form;

use Symfony\Component\Form\Forms;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ListForm {

    public function createAddForm() {
        $formFactory = Forms::createFormFactory();
        
        $form = $formFactory->createBuilder()
                ->add('name', TextType::class)
                ->getForm();
        
        return $form; 
    }

}
