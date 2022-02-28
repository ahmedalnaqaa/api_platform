<?php
// api/src/Entity/Order.php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Client from my shop - this description will be automatically extracted from the PHPDoc to document the API.
 *
 * @ORM\Entity
 * @ORM\Table(name="orders")
 * @ApiResource(iri="https://schema.org/Order")
 */
class Order
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string")
     */
    public string $orderNumber = '';

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    public $orderDetails = null;

    /**
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="orders")
     */
    public ?Client $client = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}