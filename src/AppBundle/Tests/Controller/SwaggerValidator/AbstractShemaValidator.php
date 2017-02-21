<?php

namespace AppBundle\Tests\Controller\SwaggerValidator;

class AbstractShemaValidator extends \PHPUnit_Framework_Assert
{
    /**
     * @var SchemaValidatorFactory
     */
    protected $factory;

    /**
     * @param SchemaValidatorFactory $factory
     */
    public function __construct(SchemaValidatorFactory $factory)
    {
        $this->factory = $factory;
    }
}
