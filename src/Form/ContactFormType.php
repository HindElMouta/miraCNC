<?php
namespace App\Form;
use App\Entity\Contact;
use PharIo\Manifest\Email;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom', TextType::class, [
                'label' => 'Votre Nom'])
            ->add('Prenom', TextType::class, [
                'label' => 'Votre Prénom'])
            ->add('email', EmailType::class, [
                'label' => 'Votre adresse e-mail'])
            ->add('message', TextareaType::class, [
                'label' => 'Votre message',
                'attr' => [
                    'rows' => 6,
                ],
            ]);
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
