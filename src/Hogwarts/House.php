<?php declare(strict_types=1);

namespace Hogwarts;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class House
{
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Wizard", mappedBy="group")
     */
    private $wizards;

    public function __construct(string $name) {
        $this->name = $name;
        $this->wizards = new ArrayCollection();
    }

    public function __toString() {
        return $this->name;
    }

    public function addWizard(Wizard $wizard): void
    {
        echo "Add $wizard to $this\n";

        if (!$this->wizards->contains($wizard)) { // exit condition
            $this->wizards[] = $wizard;
            $wizard->setHouse($this);
        }
    }

    public function removeWizard(Wizard $wizard): void
    {
        echo "Remove $wizard from $this\n";

        if ($this->wizards->contains($wizard)) { // exit condition
            $this->wizards->removeElement($wizard);

            if ($wizard->getHouse() === $this) { // do not delete house if called from setHouse()
                $wizard->setHouse(null);
            }
        }
    }

    /**
     * @return Collection|Wizard[]
     */
    public function getWizards()
    {
        return $this->wizards;
    }

    public function printStatus(): void
    {
        echo "There are {$this->wizards->count()} wizards in $this\n";
    }
}
