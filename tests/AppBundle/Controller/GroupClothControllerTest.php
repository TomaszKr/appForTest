<?php
namespace Tests\AppBundle\Controller;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Client;

class GroupClothControllerTest extends WebTestCase
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
    public function testAdd($name, $parents)
    {
        $parent = $this->entityManager->getRepository(\AppBundle\Entity\GroupCloth::class)->findOneBy(['name' => $parents]);

        if ($parent) {
            $data = array(
                'name' => $name,
                'parent' => $parent->getId()
            );
        } else {
            $data = array(
                'name' => $name
            );
        }

        $crawler = $this->client->request(
            'PUT', '/groupCloth', $data
        );

        $json = $this->client->getResponse()->getContent();

        $this->assertEquals(201, $this->client->getResponse()->getStatusCode());
        $this->assertJson($json);

        $object = json_decode($json, true);

        $this->assertEquals('created', $object['action']);
    }

    /**
     * @dataProvider elementsEditChangeParent
     */
    public function testEditChangeParent($name, $parent)
    {
        $groupCloth = $this->entityManager->getRepository(\AppBundle\Entity\GroupCloth::class)->findOneBy(['name' => $name]);

        $parents = $this->entityManager->getRepository(\AppBundle\Entity\GroupCloth::class)->findOneBy(['name' => $parent]);

        if ($parents) {
            $data = array(
                'id' => $groupCloth->getId(),
                'name' => $name,
                'parent' => $parents->getId()
            );
        } else {
            $data = array(
                'id' => $groupCloth->getId(),
                'name' => $name
            );
        }

        $crawler = $this->client->request(
            'POST', '/groupCloth', $data
        );

        $json = $this->client->getResponse()->getContent();

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertJson($json);

        $object = json_decode($json, true);

        $this->assertEquals('update', $object['action']);


        $this->assertEquals($parents, $groupCloth->getParent());
    }

    public function testTree()
    {
        $groupCloth = $this->entityManager->getRepository(\AppBundle\Entity\GroupCloth::class)->findOneBy(['name' => 'GrupaMaterialu1']);

        $crawler = $this->client->request(
            'GET', "/groupCloth/{$groupCloth->getId()}/tree/get"
        );

        $json = $this->client->getResponse()->getContent();

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertJson($json);

        $object = json_decode($json, true);

        $this->assertEquals('tree', $object['action']);


        return $object['data'];
    }

    /**
     * @depends testTree
     */
    public function testLeaves(array $object)
    {
        $groupCloth = $this->entityManager->getRepository(\AppBundle\Entity\GroupCloth::class)->find($object['id']);

        $crawler = $this->client->request(
            'GET', "/groupCloth/{$object['id']}/tree/show"
        );

        $json = $this->client->getResponse()->getContent();

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertJson($json);

        $newObject = json_decode($json, true);

        $this->assertEquals('tree', $newObject['action']);

        $this->assertEquals($newObject['data']['id'], $groupCloth->getId());
    }

    public function elements()
    {
        return [
            ['name' => 'GrupaMaterialu1', 'parent' => null],
            ['name' => 'GrupaMaterialu2', 'parent' => 'GrupaMaterialu1'],
            ['name' => 'GrupaMaterialu3', 'parent' => 'GrupaMaterialu2'],
            ['name' => 'GrupaMaterialu4', 'parent' => 'GrupaMaterialu3'],
        ];
    }

    public function elementsEditChangeParent()
    {
        return [
            ['name' => 'GrupaMaterialu3', 'parent' => 'GrupaMaterialu1'],
            ['name' => 'GrupaMaterialu2', 'parent' => 'GrupaMaterialu4'],
        ];
    }

    public function elementsTree()
    {
        return [
            ['name' => 'GrupaMaterialu1'],
            ['name' => 'GrupaMaterialu3'],
            ['name' => 'GrupaMaterialu4'],
            ['name' => 'GrupaMaterialu2'],
        ];
    }

    public function elementsDelete()
    {
        return [
            ['name' => 'GrupaMaterialu2'],
            ['name' => 'GrupaMaterialu4'],
            ['name' => 'GrupaMaterialu3'],
            ['name' => 'GrupaMaterialu1'],
        ];
    }

    /**
     * @dataProvider elementsDelete
     */
    public function testClear($name)
    {
        $groupCloth = $this->entityManager->getRepository(\AppBundle\Entity\GroupCloth::class)->findOneBy(['name' => $name]);

        $this->entityManager->remove($groupCloth);
        $this->entityManager->flush();
    }
}
