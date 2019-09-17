<?php

declare(strict_types=1);

namespace Francken\Domain\Members\Registration\Events;

use Broadway\Serializer\Serializable as SerializableInterface;
use Francken\Domain\Members\PaymentInfo;
use Francken\Domain\Members\Registration\RegistrationRequestId;
use Francken\Domain\Serializable;

final class PaymentInfoProvided implements SerializableInterface
{
    use Serializable;

    private $id;
    private $paysForMembership = true;
    private $paysForFoodAndDrinks = false;
    private $iban = '';

    public function __construct(
        RegistrationRequestId $id,
        PaymentInfo $payment
    ) {
        $this->id = (string)$id;
        $this->paysForMembership = $payment->payForMembership();
        $this->paysForFoodAndDrinks = $payment->payForFoodAndDrinks();
        $this->iban = $payment->iban();
    }

    public function registrationRequestId() : RegistrationRequestId
    {
        return new RegistrationRequestId($this->id);
    }

    public function paymentInfo()
    {
        return new PaymentInfo(
            $this->paysForMembership,
            $this->paysForFoodAndDrinks,
            $this->iban
        );
    }
}
