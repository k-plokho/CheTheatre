<?php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Hautelook\AliceBundle\Alice\DataFixtureLoader;
use Nelmio\Alice\Fixtures;

class LoadData extends DataFixtureLoader
{
    protected function getFixtures()
    {
        return array(
            __DIR__ . '/fixturesRole.yml', __DIR__ . '/fixturesEmployee.yml', __DIR__ . '/fixturesPerfomanceEvent.yml', __DIR__ . '/fixturesPerformance.yml',
        );
    }
}