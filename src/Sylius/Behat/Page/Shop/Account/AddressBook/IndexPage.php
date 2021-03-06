<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Behat\Page\Shop\Account\AddressBook;

use Behat\Mink\Element\NodeElement;
use Sylius\Behat\Page\SymfonyPage;
 
/**
 * @author Anna Walasek <anna.walasek@lakion.com>
 * @author Jan Góralski <jan.goralski@lakion.com>
 */
class IndexPage extends SymfonyPage implements IndexPageInterface
{
    /**
     * {@inheritdoc}
     */
    public function getRouteName()
    {
        return 'sylius_shop_account_address_book_index';
    }

    /**
     * {@inheritdoc}
     */
    public function getAddressesCount()
    {
        return count($this->getElement('addresses')->findAll('css', 'address'));
    }

    /**
     * {@inheritdoc}
     */
    public function hasAddressOf($fullName)
    {
        return null !== $this->getAddressOf($fullName);
    }

    /**
     * {@inheritdoc}
     */
    public function hasNoAddresses()
    {
        return $this->getDocument()->hasContent('You have no addresses defined');
    }

    /**
     * {@inheritdoc}
     */
    public function deleteAddress($fullName)
    {
        $addressToDelete = $this->getAddressOf($fullName);
        $addressToDelete->pressButton('Delete');
    }

    /**
     * @param string $fullName
     *
     * @return NodeElement|null
     */
    private function getAddressOf($fullName)
    {
        return $this->getElement('addresses')->find('css', sprintf('div:contains("%s")', $fullName));
    }

    /**
     * {@inheritdoc}
     */
    protected function getDefinedElements()
    {
        return array_merge(parent::getDefinedElements(), [
            'addresses' => '#sylius-addresses',
        ]);
    }
}
