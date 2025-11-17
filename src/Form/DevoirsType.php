<?php

namespace App\Form;

use App\Entity\Cours;
use App\Entity\Devoirs;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;

class DevoirsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('devoir_nom', TextType::class, [
                'label' => 'Nom du devoir',
                'attr' => array('class' => 'form-control'),
                'required' => true,
                // 'constraints' => [
                //     new NotBlank([
                //         'message' => 'Veuillez saisir un nom de devoir',
                //     ]),
                //     new Length([
                //         'min' => 3,
                //         'minMessage' => 'Le nom du devoir doit contenir au moins {{ limit }} caractères',
                //         'max' => 32,
                //         'maxMessage' => 'Le nom du devoir doit contenir au plus {{ limit }} caractères',
                //     ]),
                //     new Regex([
                //         'patern' => '/^[a-zA-Z0-9][a-zA-Z0-9 -]*[a-zA-Z0-9]?$/',
                //         'message' => 'Le nom du devoir ne doit contenir que des lettres, des chiffres, des espaces ou des tirets',
                //     ])
                // ]
            ])
            ->add('devoir_desc', TextareaType::class, [
                'label' => 'Description du devoir',
                'attr' => array(
                    'class' => 'form-control',
                    'rows' => '10',
                    'cols' => '50',
                ),
                'required' => false,
            ])
            ->add('cour', EntityType::class, [
                'class' => Cours::class,
                'choice_label' => 'cours_nom',
                'label' => 'Sélectionnez un cours ',
                'attr' => array('class' => 'form-control'),
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('c')->orderBy('c.cours_nom', 'ASC');
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Devoirs::class,
        ]);
    }
}
