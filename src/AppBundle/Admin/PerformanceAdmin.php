<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class PerformanceAdmin extends Admin
{
    protected $baseRouteName = 'AppBundle\Entity\Performance';
    protected $baseRoutePattern = 'Performance';
    protected $datagridValues = [
        '_sort_order' => 'DESC',
        '_sort_by'    => 'premiere',
    ];

    /**
     * @param \Sonata\AdminBundle\Show\ShowMapper $showMapper
     *
     * @return void
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('title')
            ->add('type')
            ->add('description')
            ->add('premiere')
            ->add('performanceEvents')
            ->add('roles')
        ;
    }

    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     *
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $em = $this->modelManager->getEntityManager('AppBundle\Entity\History');

        $query = $em->createQueryBuilder('h')
            ->select('h')
            ->from('AppBundle:History', 'h')
            ->where('h.type = :type')
            ->orderBy('h.createdAt', 'ASC')
            ->setParameter('type', 'festival');

        $formMapper
            ->add('title')
            ->add('type')
            ->add('festival', 'sonata_type_model', [
                'required' => false,
                'query' => $query,
            ])
            ->add('description', null, ['attr' => ['class' => 'wysihtml5', 'style' => 'height: 200px']])
            ->add(
                'mainPicture',
                'sonata_type_model_list',
                ['required' => false],
                [
                    'link_parameters' => [
                        'context'  => 'performance',
                        'provider' => 'sonata.media.provider.image',
                    ],
                ]
            )
            ->add(
                'sliderImage',
                'sonata_type_model_list',
                ['required' => false],
                [
                    'link_parameters' => [
                        'context'  => 'slider',
                        'provider' => 'sonata.media.provider.image',
                    ],
                ]
            )
            ->add(
                'premiere',
                'sonata_type_datetime_picker',
                [
                    'dp_side_by_side'       => true,
                    'dp_use_current'        => false,
                    'dp_use_seconds'        => false,
                    'format' => "dd/MM/yyyy HH:mm",
                ]
            )
            ->add(
                'roles',
                'sonata_type_collection',
                [
                    'required' => false,
                    'by_reference' => false,
                ],
                [
                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable'  => 'position',
                ]
            )
            ->add(
                'galleryHasMedia',
                'sonata_type_collection',
                [
                    'required' => false,
                    'label' => 'Gallery',
                ],
                [
                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable'  => 'position',
                    'targetEntity' => 'Application\Sonata\MediaBundle\Entity\GalleryHasMedia',
                    'admin_code' => 'sonata.media.admin.gallery_has_media',
                    'link_parameters' => [
                        'context'  => 'performance',
                        'provider' => 'sonata.media.provider.image',
                    ],
                ]
            )
        ;
    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
     *
     * @return void
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('mainPicture', 'string', ['template' => '::SonataAdmin/thumbnail.html.twig'])
            ->addIdentifier('title')
            ->add('type')
            ->add('premiere')
            ->add('festival')
        ;
    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\DatagridMapper $datagridMapper
     *
     * @return void
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('type')
            ->add('festival')
        ;
    }
}
