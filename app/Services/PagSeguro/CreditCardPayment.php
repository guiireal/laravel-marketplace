<?php

namespace App\Services\PagSeguro;

use App\Models\User;
use PagSeguro\Configuration\Configure;
use PagSeguro\Domains\Requests\DirectPayment\CreditCard;

class CreditCardPayment
{
    private array $items;
    private User $user;
    private array $cardInfo;
    private string $reference;

    public function __construct(User $user, array $items, array $cardInfo, string $reference)
    {
        $this->user = $user;
        $this->items = $items;
        $this->cardInfo = $cardInfo;
        $this->reference = $reference;
    }

    public function doPayment()
    {
        $creditCard = new CreditCard();
        $creditCard->setReceiverEmail(env('PAGSEGURO_EMAIL'));
        $creditCard->setReference($this->reference);
        $creditCard->setCurrency("BRL");
        foreach ($this->items as $item) {
            $creditCard->addItems()->withParameters(
                $this->reference,
                $item['name'],
                $item['qty'],
                $item['price']
            );
        }
        $user = $this->user;
        $email = env('PAGSEGURO_ENV') == 'sandbox' ? 'test@sandbox.pagseguro.com.br' : $user->email;
        $creditCard->setSender()->setName($user->name);
        $creditCard->setSender()->setEmail($email);
        $creditCard->setSender()->setPhone()->withParameters(
            11,
            958052138
        );
        $creditCard->setSender()->setDocument()->withParameters(
            'CPF',
            '41950961893'
        );
        $creditCard->setSender()->setHash($this->cardInfo['hash']);
        $creditCard->setSender()->setIp('127.0.0.0');
        $creditCard->setShipping()->setAddress()->withParameters(
            'Av. Brig. Faria Lima',
            '1384',
            'Jardim Paulistano',
            '01452002',
            'São Paulo',
            'SP',
            'BRA',
            'apto. 114'
        );
        $creditCard->setBilling()->setAddress()->withParameters(
            'Av. Brig. Faria Lima',
            '1384',
            'Jardim Paulistano',
            '01452002',
            'São Paulo',
            'SP',
            'BRA',
            'apto. 114'
        );
        $creditCard->setToken($this->cardInfo['card_token']);
        list($quantity, $installmentAmount) = explode('|', $this->cardInfo['installment']);
        $installmentAmount = number_format($installmentAmount, 2, '.', '');
        $quantity = intval($quantity);
        $creditCard->setInstallment()->withParameters($quantity, $installmentAmount);
        $creditCard->setHolder()->setBirthdate('01/10/1979');
        $creditCard->setHolder()->setName($this->cardInfo['card_name']);
        $creditCard->setHolder()->setPhone()->withParameters(
            11,
            958052138
        );
        $creditCard->setHolder()->setDocument()->withParameters(
            'CPF',
            '41950961893'
        );
        $creditCard->setMode('DEFAULT');
        return $creditCard->register(
            Configure::getAccountCredentials()
        );
    }
}
