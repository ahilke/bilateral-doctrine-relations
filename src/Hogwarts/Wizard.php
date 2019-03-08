<?php declare(strict_types=1);

namespace Hogwarts;

final class Wizard
{
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="House", inversedBy="users")
     */
    private $house;

    public function __construct(string $name) {
        $this->name = $name;
    }

    public function __toString() {
        return $this->name;
    }

    /**
     * Updates this side first, as updating the inverse side first would lead to infinite recursion.
     * This requires to save the current group in a temporary variable to remove the user from it later.
     *
     * If user is already in a group, removes them from it.
     * If a new group is given, adds the user to it.
     */
    public function setHouse(?House $house): void
    {
        echo "Set $this to $house\n";

        if ($this->house === $house) { // exit condition
            return;
        }

        $oldHouse = $this->house;
        $this->house = $house;

        if ($oldHouse !== null) {
            $oldHouse->removeWizard($this);
        }
        if ($house !== null) {
            $house->addWizard($this);
        }
    }

    public function getHouse(): ?House
    {
        return $this->house;
    }

    public function printStatus(): void
    {
        echo "$this is in {$this->house}\n";
    }
}
