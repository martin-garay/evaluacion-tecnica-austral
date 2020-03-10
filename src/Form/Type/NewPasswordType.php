<?php

namespace App\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class NewPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('password', RepeatedType::class, [
            	'type' => PasswordType::class,
            	'invalid_message' => 'No coincide la contraseña con la confirmacion.',
                'options' => ['attr' => ['class' => 'password-field form-control']],
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'label' => 'Contraseña',
                'first_options'  => ['label' => 'Contraseña'],
                'second_options' => ['label' => 'Confirmación'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor ingrese la contraseña',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'La contraseña debe tener al menos {{ limit }} carácteres',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('Enviar', SubmitType::class,[
            	'attr' => ['class' => 'btn btn-primary']
            ]);
    }
}