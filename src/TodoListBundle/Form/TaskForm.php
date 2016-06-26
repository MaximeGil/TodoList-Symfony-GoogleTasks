<?php

namespace TodoListBundle\Form;

use Symfony\Component\Form\Forms;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;


class TaskForm {

    public function createAddForm() {
        $formFactory = Forms::createFormFactory();

        $form = $formFactory->createBuilder()
                ->add('name', TextType::class)
                ->add('note', TextareaType::class)
                ->add('datedue', DateType::class, array(
                    // render as a single text box
                    'widget' => 'single_text',
                ))
                ->getForm();

        return $form;
    }

    public function createUpdateForm() {
        $formFactory = Forms::createFormFactory();

        $form = $formFactory->createBuilder()
                ->add('name', TextType::class)
                ->add('note', TextareaType::class)
                ->add('datedue', DateType::class, array(
                    // render as a single text box
                    'widget' => 'single_text',
                ))
                ->getForm();

        return $form;
    }

}
