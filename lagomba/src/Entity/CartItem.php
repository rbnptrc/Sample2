<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CartItem
 *
 * @ORM\Table(name="cart_item", indexes={@ORM\Index(name="IDX_F0FE252720AEF35F", columns={"cart_id_id"}), @ORM\Index(name="IDX_F0FE252722F63AD1", columns={"mushroom_id_id"})})
 * @ORM\Entity
 */
class CartItem
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="qty", type="integer", nullable=false)
     */
    private $qty;

    /**
     * @var int
     *
     * @ORM\Column(name="unit_price", type="integer", nullable=false)
     */
    private $unitPrice;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \Cart
     *
     * @ORM\ManyToOne(targetEntity="Cart")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cart_id_id", referencedColumnName="id")
     * })
     */
    private $cartId;

    /**
     * @var \Mushroom
     *
     * @ORM\ManyToOne(targetEntity="Mushroom")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="mushroom_id_id", referencedColumnName="id")
     * })
     */
    private $mushroomId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQty(): ?int
    {
        return $this->qty;
    }

    public function setQty(int $qty): self
    {
        $this->qty = $qty;

        return $this;
    }

    public function getUnitPrice(): ?int
    {
        return $this->unitPrice;
    }

    public function setUnitPrice(int $unitPrice): self
    {
        $this->unitPrice = $unitPrice;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCartId(): ?Cart
    {
        return $this->cartId;
    }

    public function setCartId(?Cart $cartId): self
    {
        $this->cartId = $cartId;

        return $this;
    }

    public function getMushroomId(): ?Mushroom
    {
        return $this->mushroomId;
    }

    public function setMushroomId(?Mushroom $mushroomId): self
    {
        $this->mushroomId = $mushroomId;

        return $this;
    }


}
