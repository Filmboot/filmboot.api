<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Myclapboard\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class ReviewType.
 *
 * @package Myclapboard\UserBundle\Form
 */
class ReviewType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')

            ->add('content')

            ->add('locale')

            ->add(
                'movie', 'entity', array(
                    'class' => 'MyclapboardMovieBundle:Movie'
                )
            );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return '';
    }
}
