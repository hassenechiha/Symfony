<?php
/**
 * Created by PhpStorm.
 * User: Hasse
 * Date: 11/09/2018
 * Time: 11:26
 */

namespace MarsupilamiBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserForm extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options)
{
    $builder
    ->add('age')
    ->add('famille')
    ->add('nourriture')
    ->add('race')
    ->setMethod('GET')
    ->add('save',SubmitType::class);
}
public function configureOptions(OptionsResolver $resolver)
{

}
public function getName(){
    return 'Marsupilami_bundle_user_form';
}
}