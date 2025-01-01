<?php
namespace App\Form;
use App\Entity\Patient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;

class PatientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomPatient', TextType::class)
            ->add('prenomPatient', TextType::class)
            ->add('dateNaissance', DateType::class)
            ->add('cni', TextType::class)
            ->add('genre', ChoiceType::class,[
                'choices'  => [
                    'Male' => "Homme",
                    'Female' => "Femme",
                ]])
            ->add('adresse', TextType::class)
            ->add('Telephone', TextType::class)
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Patient::class,
        ]);
    }
}