<?php

namespace App\Form;

use App\Entity\Editor;
use App\Entity\VideoGame;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VideoGameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('support', TextareaType::class)
            ->add('description', TextareaType::class)
            ->add('releaseDate', DateType::class, [
                'years' => range(date('Y')-100, date('Y')),
                'label' => 'Sélectionner une date de sortie',
            ])
            ->add('editor', EntityType::class, [
                'class' =>Editor::class,
                'choice_label' =>function(Editor $editor) {
                return $editor->getId() . '-' . $editor->getName();
                }
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => VideoGame::class,
        ]);
    }
}
