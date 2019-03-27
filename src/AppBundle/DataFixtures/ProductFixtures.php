<?php
/**
 * Created by PhpStorm.
 * User: Corballs
 * Date: 3/26/19
 * Time: 12:16 PM
 */

namespace AppBundle\DataFixtures;
use CoreBundle\Entity\Customers;
use CoreBundle\Entity\Products;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $productArr =
        [
            ['name' => 'iMac'],
            ['name' => 'Power Ranger'],
            ['name' => 'Office Supplies'],
            ['name' => 'Herbal Essences'],
            ['name' => 'Macbook Pro'],
            ['name' => 'VR Headset'],
            ['name' => 'Pencil Sharpener'],
            ['name' => 'Snowboard'],
            ['name' => 'Pizza'],
            ['name' => 'Blu-ray'],
            ['name' => 'Sweater'],
            ['name' => 'Water Bottle'],
        ];

        foreach ($productArr as $products)
        {
            $product = new Products();
            $productData = $this->getProductData();
            $product->setName($products['name']);
            $product->setCustomer($this->getCustomer($manager));
            $product->setStatus($productData['status']);
            $product->setUpdatedAt($productData['updated']);
            $product->setDeletedAt($productData['deleted']);
            $manager->persist($product);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [CustomerFixtures::class];
    }

    /**
     * @param $manager ObjectManager
     * @return Customers
     */
    private function getCustomer($manager)
    {
        $customers = $manager->getRepository('CoreBundle:Customers')->findByNewAndApproved('new', 'approved');
        $customerWithProductsArr = $customers[array_rand($customers)];
        return $customerWithProductsArr;
    }

    /**
     * @return array
     */
    private function getProductData()
    {
        $statuses = ['pending', 'new', 'pending', 'pending', 'approved', 'new'];
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
                $randomValue = rand(0, 1);
                $randomHours = rand(1, 24);
                $randomMinutes = rand(0, 59);
                $updatedTime = $randomValue === 0 ? $randomHours.':'.$randomMinutes. '- 5 days' : $randomHours.':'.$randomMinutes. '- 2 week';
                $updatedDate = $updatedDate = new \DateTime($updatedTime, new \DateTimeZone('GMT'));
                $deletedDate = null;
                break;
            default:
                $customerStatus = null;
                $updatedDate = null;
                $deletedDate = null;
        }

        $productDataArr = ['status' => $randomStatus, 'updated' => $updatedDate, 'deleted' => $deletedDate];
        return $productDataArr;
    }
}