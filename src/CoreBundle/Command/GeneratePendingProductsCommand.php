<?php
/**
 * Created by PhpStorm.
 * User: Corballs
 * Date: 3/26/19
 * Time: 10:01 PM
 */

namespace CoreBundle\Command;
use CoreBundle\Entity\Products;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class GeneratePendingProductsCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('epcvip:find:pending:products')
            ->setDescription('Prints pending products over a week old')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();
        $symfonyStyle = new SymfonyStyle($input, $output);
        $pendingProducts = $em->getRepository('CoreBundle:Products')->findByPendingStatusFromDate('pending', new \DateTime('- 1 week', new \DateTimeZone('GMT')));

        $symfonyStyle->writeln
        ([
            '<question>',
            '',
            'Now Outputting Pending Products',
            '===============================',
            '</question>'
        ]);

        foreach ($pendingProducts as $pendingProduct)
        {
            /** @var $pendingProduct Products */
            $output->writeln
            ([
                'issn: '. $pendingProduct->getIssn(),
                'name: '.$pendingProduct->getName(),
                'customer: '.$pendingProduct->getCustomer()->getFirstName().' '.$pendingProduct->getCustomer()->getLastName(),
                'pending since: '.$this->convertGmtToLocal($pendingProduct->getUpdatedAt())->format('F j Y h:i A'),
                ''
            ]);
        }

        $output->writeln
        ([
            '<info>',
            'Pending products retrieved successfully :)',
            '',
            '</info>'
        ]);
    }

    private function convertGmtToLocal($gmtDate)
    {
        /** @var $gmtDate \DateTime */
        $localTimezone = new \DateTimeZone('America/Los_Angeles');
        $localOffset = $localTimezone->getOffset($gmtDate);
        $localInterval = \DateInterval::createFromDateString((string)$localOffset.'seconds');
        $gmtDate->add($localInterval);
        $localDate = $gmtDate;
        return $localDate;
    }
}