<?php

use Doctrine\ORM\Tools\SchemaValidator;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class MappingTest.
 *
 * @author Edwin ten Brinke <edwin.ten.brinke@extendas.com>
 *
 * @method assertCount(int $int, array $mapping_errors, string $string)
 */
class MappingTest extends KernelTestCase
{
    /**
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException
     */
    public function testMapping()
    {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $container = static::$kernel->getContainer();

        // prepare data
        $em = $container->get('doctrine')->getManager();

        // For reference check vendor/doctrine/orm/lib/Doctrine/ORM/Tools/Console/Command/ValidateSchemaCommand.php
        $validator = new SchemaValidator($em);
        $mapping_errors = $validator->validateMapping();
        $this->assertCount(0, $mapping_errors, 'Mapping errors detected! Run the doctrine:schema:validate command to check for mapping errors');
    }
}
