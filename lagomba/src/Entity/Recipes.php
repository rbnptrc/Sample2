<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Recipes
 *
 * @ORM\Table(name="recipes")
 * @ORM\Entity
 */
class Recipes
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
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=false)
     */
    private $image;

    /**
     * @var string|null
     *
     * @ORM\Column(name="one", type="string", length=255, nullable=true)
     */
    private $one;

    /**
     * @var string|null
     *
     * @ORM\Column(name="two", type="string", length=255, nullable=true)
     */
    private $two;

    /**
     * @var string|null
     *
     * @ORM\Column(name="three", type="string", length=255, nullable=true)
     */
    private $three;

    /**
     * @var string|null
     *
     * @ORM\Column(name="four", type="string", length=255, nullable=true)
     */
    private $four;

    /**
     * @var string|null
     *
     * @ORM\Column(name="five", type="string", length=255, nullable=true)
     */
    private $five;

    /**
     * @var string|null
     *
     * @ORM\Column(name="six", type="string", length=255, nullable=true)
     */
    private $six;

    /**
     * @var string|null
     *
     * @ORM\Column(name="seven", type="string", length=255, nullable=true)
     */
    private $seven;

    /**
     * @var string|null
     *
     * @ORM\Column(name="eight", type="string", length=255, nullable=true)
     */
    private $eight;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nine", type="string", length=255, nullable=true)
     */
    private $nine;

    /**
     * @var string|null
     *
     * @ORM\Column(name="zehn", type="string", length=255, nullable=true)
     */
    private $zehn;

    /**
     * @var string|null
     *
     * @ORM\Column(name="eleven", type="string", length=255, nullable=true)
     */
    private $eleven;

    /**
     * @var string|null
     *
     * @ORM\Column(name="twelve", type="string", length=255, nullable=true)
     */
    private $twelve;

    /**
     * @var string|null
     *
     * @ORM\Column(name="thirteen", type="string", length=255, nullable=true)
     */
    private $thirteen;

    /**
     * @var string|null
     *
     * @ORM\Column(name="fourteen", type="string", length=255, nullable=true)
     */
    private $fourteen;

    /**
     * @var string|null
     *
     * @ORM\Column(name="fifteen", type="string", length=255, nullable=true)
     */
    private $fifteen;

    /**
     * @var string
     *
     * @ORM\Column(name="preptime", type="string", length=255, nullable=false)
     */
    private $preptime;

    /**
     * @var string
     *
     * @ORM\Column(name="preplevel", type="string", length=255, nullable=false)
     */
    private $preplevel;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getOne(): ?string
    {
        return $this->one;
    }

    public function setOne(?string $one): self
    {
        $this->one = $one;

        return $this;
    }

    public function getTwo(): ?string
    {
        return $this->two;
    }

    public function setTwo(?string $two): self
    {
        $this->two = $two;

        return $this;
    }

    public function getThree(): ?string
    {
        return $this->three;
    }

    public function setThree(?string $three): self
    {
        $this->three = $three;

        return $this;
    }

    public function getFour(): ?string
    {
        return $this->four;
    }

    public function setFour(?string $four): self
    {
        $this->four = $four;

        return $this;
    }

    public function getFive(): ?string
    {
        return $this->five;
    }

    public function setFive(?string $five): self
    {
        $this->five = $five;

        return $this;
    }

    public function getSix(): ?string
    {
        return $this->six;
    }

    public function setSix(?string $six): self
    {
        $this->six = $six;

        return $this;
    }

    public function getSeven(): ?string
    {
        return $this->seven;
    }

    public function setSeven(?string $seven): self
    {
        $this->seven = $seven;

        return $this;
    }

    public function getEight(): ?string
    {
        return $this->eight;
    }

    public function setEight(?string $eight): self
    {
        $this->eight = $eight;

        return $this;
    }

    public function getNine(): ?string
    {
        return $this->nine;
    }

    public function setNine(?string $nine): self
    {
        $this->nine = $nine;

        return $this;
    }

    public function getZehn(): ?string
    {
        return $this->zehn;
    }

    public function setZehn(?string $zehn): self
    {
        $this->zehn = $zehn;

        return $this;
    }

    public function getEleven(): ?string
    {
        return $this->eleven;
    }

    public function setEleven(?string $eleven): self
    {
        $this->eleven = $eleven;

        return $this;
    }

    public function getTwelve(): ?string
    {
        return $this->twelve;
    }

    public function setTwelve(?string $twelve): self
    {
        $this->twelve = $twelve;

        return $this;
    }

    public function getThirteen(): ?string
    {
        return $this->thirteen;
    }

    public function setThirteen(?string $thirteen): self
    {
        $this->thirteen = $thirteen;

        return $this;
    }

    public function getFourteen(): ?string
    {
        return $this->fourteen;
    }

    public function setFourteen(?string $fourteen): self
    {
        $this->fourteen = $fourteen;

        return $this;
    }

    public function getFifteen(): ?string
    {
        return $this->fifteen;
    }

    public function setFifteen(?string $fifteen): self
    {
        $this->fifteen = $fifteen;

        return $this;
    }

    public function getPreptime(): ?string
    {
        return $this->preptime;
    }

    public function setPreptime(string $preptime): self
    {
        $this->preptime = $preptime;

        return $this;
    }

    public function getPreplevel(): ?string
    {
        return $this->preplevel;
    }

    public function setPreplevel(string $preplevel): self
    {
        $this->preplevel = $preplevel;

        return $this;
    }


}
