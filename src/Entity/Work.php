<?php

namespace App\Entity;

use App\Repository\WorkRepository;
use App\Validator as Valid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WorkRepository::class)
 * @Valid\WorkParent()
 */
class Work
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity=Work::class, inversedBy="works")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity=Work::class, mappedBy="parent")
     */
    private $works;

    /**
     * @ORM\ManyToMany(targetEntity=Slave::class, mappedBy="works")
     */
    private $slaves;

    public function __construct()
    {
        $this->works = new ArrayCollection();
        $this->slaves = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getWorks(): Collection
    {
        return $this->works;
    }

    public function addWork(self $work): self
    {
        if (!$this->works->contains($work)) {
            $this->works[] = $work;
            $work->setParent($this);
        }

        return $this;
    }

    public function removeWork(self $work): self
    {
        if ($this->works->removeElement($work)) {
            // set the owning side to null (unless already changed)
            if ($work->getParent() === $this) {
                $work->setParent(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getTitle();
    }

    /**
     * @return Collection|Slave[]
     */
    public function getSlaves(): Collection
    {
        return $this->slaves;
    }

    public function addSlave(Slave $slave): self
    {
        if (!$this->slaves->contains($slave)) {
            $this->slaves[] = $slave;
            $slave->addWork($this);
        }

        return $this;
    }

    public function removeSlave(Slave $slave): self
    {
        if ($this->slaves->removeElement($slave)) {
            $slave->removeWork($this);
        }

        return $this;
    }
}
