<?php
// api/src/Entity/Product.php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="clients")
 * @ApiResource(iri="Client")
 */
class Client // The class name will be used to name exposed resources
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * A name property - this description will be available in the API documentation too.
     *
     * @ORM\Column
     * @Assert\NotBlank()
     */
    public string $name = '';

    /**
     * A name property - this description will be available in the API documentation too.
     *
     * @ORM\Column(name="website", nullable=true)
     * @Assert\Url()
     */
    public string $website = '';

    /**
     * A name property - this description will be available in the API documentation too.
     *
     * @ORM\Column(name="platform", nullable=true)
     * @Assert\NotBlank()
     */
    public ?string $platform = null;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    public $credentials = null;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    public $endpoints = null;

    // Notice the "cascade" option below, this is mandatory if you want Doctrine to automatically persist the related entity
    /**
     * @var Order[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Order", mappedBy="client")
     */
    public iterable $orders;

    public function __construct()
    {
        $this->orders = new ArrayCollection(); // Initialize $orders as a Doctrine collection
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    // Adding both an adder and a remover as well as updating the reverse relation is mandatory
    // if you want Doctrine to automatically update and persist (thanks to the "cascade" option) the related entity
    public function addOrder(Order $order): void
    {
        $order->client = $this;
        $this->orders->add($order);
    }

    public function removeOrder(Order $order): void
    {
        $order->client = null;
        $this->orders->removeElement($order);
    }
}
