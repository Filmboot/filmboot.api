<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Myclapboard\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class ReviewType.
 *
 * @package Myclapboard\UserBundle\Form\Type
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
