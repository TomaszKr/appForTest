<?php

namespace Tests\AppBundle\Controller;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Client;

class UnitMeasureControllerTest extends WebTestCase
{
    /** @var  Client $client */
    protected $client;
    
    /** @var  ContainerInterface $container */
    protected $container;

    /** @var  EntityManager $entityManager */
    protected $entityManager;
    
    /**
     * {@inheritDoc}
     */
    public function setUp()
    {
        $this->client = static::createClient();
        $this->container = $this->client->getContainer();
        $this->entityManager = $this->container->get('doctrine.orm.entity_manager');

        parent::setUp();
    }
    
    protected function tearDown()
    {
        parent::tearDown();
        
        $this->entityManager->close();
        $this->entityManager = null;
    }

    /**
     * @dataProvider elements
     */
    public function testAdd($name, $shortName)
    {
        $crawler = $this->client->request(
            'PUT', 
            '/unitMeasure',
            array(
                'name' => $name,
                'shortName' => $shortName
            )
        );
        
        $json = $this->client->getResponse()->getContent();

        $this->assertEquals(201, $this->client->getResponse()->getStatusCode());
        $this->assertJson($json);
        
        $object = json_decode($json,true);
        
        $this->assertEquals('created', $object['action']);
    }
    
    /**
     * @dataProvider elements
     */
    public function testEdit($name, $shortName)
    {
        $cloth = $this->entityManager->getRepository(\AppBundle\Entity\UnitMeasure::class)->findOneBy(['shortName'=>$shortName]);
        
        $newName = $name.'2';
        
        $crawler = $this->client->request(
            'POST', 
            '/unitMeasure',
            array(
                'id'=>$cloth->getId(),
                'name' => $newName,
                'shortName' => $shortName
            )
        );
        
        $json = $this->client->getResponse()->getContent();

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertJson($json);
        
        $object = json_decode($json,true);
        
        $this->assertEquals('update', $object['action']);

        
        $this->assertEquals($newName,$cloth->getName());
    }
    
    public function elements()
    {
        return [
          ['name'=>'Material1', 'shortName' => 'M1'],  
          ['name'=>'Material2', 'shortName' => 'M2'],  
          ['name'=>'Material3', 'shortName' => 'M3'],  
        ];
    }
    
    /**
     * @dataProvider elements
     */
    public function testClear($name, $shortName)
    {
        $cloth = $this->entityManager->getRepository(\AppBundle\Entity\UnitMeasure::class)->findOneBy(['shortName'=>$shortName]);

        $this->entityManager->remove($cloth);
        $this->entityManager->flush();
    }
}
