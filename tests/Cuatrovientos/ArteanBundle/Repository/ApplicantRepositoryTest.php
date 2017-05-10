<?php
/**
 * Created by PhpStorm.
 * User: PELLO_ALTADILL
 * Date: 09/05/2017
 * Time: 17:34
 */
namespace Tests\AppBundle\Repository;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ApplicantRepositoryTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        self::bootKernel();

        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testSearchByCategoryName()
    {
        $applicant = $this->em
            ->getRepository('CuatrovientosArteanBundle:Applicant')
            ->findApplicant('pello@pello.io');

        $this->assertCount(1, $applicant);
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();
        $this->em->close();
        $this->em = null; // avoid memory leaks
    }
}