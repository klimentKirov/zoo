<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AnimalRepository")
 */
class Animal
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $action;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Cage", mappedBy="animal", cascade={"persist", "remove"})
     */
    private $cage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCage(): ?Cage
    {
        return $this->cage;
    }

    public function setCage(Cage $cage): self
    {
        $this->cage = $cage;

        // set the owning side of the relation if necessary
        if ($this !== $cage->getAnimal()) {
            $cage->setAnimal($this);
        }

        return $this;
    }

    public function eat(): string
    {
        return "The " . $this->getName() . " is eating";
    }

    /**
     * @param mixed $action
     */
    public function setAction($action): void
    {
        $this->action = $action;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    public function makeAction(): string
    {
        return "The " . $this->getName() . " is " . $this->getAction();
    }
}
