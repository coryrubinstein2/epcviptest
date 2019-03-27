<?php
/**
 * Created by PhpStorm.
 * User: Corballs
 * Date: 3/24/19
 * Time: 7:15 PM
 */

namespace AppBundle\DataFixtures;
use CoreBundle\Entity\Customers;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CustomerFixtures extends Fixture
{
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $customerArr =
        [
            ['first' => 'George', 'last' => 'Michael', 'dob' => 'April 12, 1979 04:15:12'],
            ['first' => 'Mary', 'last' => 'Swanson', 'dob' => 'January 31, 1999 08:36:10'],
            ['first' => 'Jimmy', 'last' => 'Jones', 'dob' => 'December 11, 1985 15:11:45'],
            ['first' => 'Geraldine', 'last' => 'Schwartz', 'dob' => 'June 08, 2001 19:21:34'],
            ['first' => 'Gordy', 'last' => 'Guzman', 'dob' => 'July 12, 1974 21:21:34'],
            ['first' => 'Michelle', 'last' => 'O\'Neill', 'dob' => 'September 14, 1989 09:15:34'],
            ['first' => 'Gretchen', 'last' => 'Mason', 'dob' => 'February 24, 1994 12:18:44'],
            ['first' => 'Martin', 'last' => 'Bishop', 'dob' => 'August 18, 1954 09:38:14'],
            ['first' => 'Sheila', 'last' => 'McGillicuddy', 'dob' => 'November 30, 1934 13:58:19']
        ];

        foreach ($customerArr as $customers)
        {
            $customer = new Customers();
            $customerData = $this->getCustomerData();
            $customer->setFirstName($customers['first']);
            $customer->setLastName($customers['last']);
            $customer->setPassword($this->encodePassword($customer));
            $customer->setDateOfBirth(new \DateTime($customers['dob']));
            $customer->setUsername(strtolower($customer->getFirstName()).$customer->getDateOfBirth()->format('md'));
            $customer->setEmail(strtolower($customer->getFirstName()).'_'.strtolower($customer->getLastName()).'@demo.com');
            $customer->setStatus($customerData['status']);
            $customer->setUpdatedAt($customerData['updated']);
            $customer->setDeletedAt($customerData['deleted']);
            $manager->persist($customer);
        }

        $manager->flush();
    }

    /**
     * @return array
     */
    private function getCustomerData()
    {
        $statuses = ['new', 'new', 'deleted', 'approved', 'approved'];
        $randomStatusIndex = array_rand($statuses);
        $randomStatus = $statuses[$randomStatusIndex];

        switch ($randomStatus)
        {
            case 'new':
                $updatedDate = new \DateTime('now', new \DateTimeZone('GMT'));
                $deletedDate = null;
                break;
            case 'approved':
                $updatedDate = new \DateTime('- 1 week', new \DateTimeZone('GMT'));
                $deletedDate = null;
                break;
            case 'pending':
                $updatedDate = $updatedDate = new \DateTime('- 2 week', new \DateTimeZone('GMT'));
                $deletedDate = null;
                break;
            case 'deleted':
                $updatedDate = new \DateTime('- 3 weeks', new \DateTimeZone('GMT'));
                $deletedDate = new \DateTime('- 3 weeks', new \DateTimeZone('GMT'));
                break;
            default:
                $customerStatus = null;
                $updatedDate = null;
                $deletedDate = null;
        }

        $customerDataArr = ['status' => $randomStatus, 'updated' => $updatedDate, 'deleted' => $deletedDate];
        return $customerDataArr;
    }

    /**
     * @param $customer Customers
     * @return string
     */
    private function encodePassword($customer)
    {
        $encoder = $this->container->get('security.encoder_factory')->getEncoder($customer);
        $plainPassword = strtolower($customer->getFirstName()).'_pass';
        $encodedPassword = $encoder->encodePassword($plainPassword, base_convert(sha1(uniqid(mt_rand(), true)), 16, 36));
        return $encodedPassword;
    }
}