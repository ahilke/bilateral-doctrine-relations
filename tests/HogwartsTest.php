<?php declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use Eris\TestTrait;
use Hogwarts\House;
use Hogwarts\Wizard;
use PHPUnit\Framework\TestCase;
use function Eris\Generator\names;

final class HogwartsTest extends TestCase
{
    use TestTrait;

    public function testAddRemove() {
        $this->forAll(names(), names())->then(function ($houseName, $wizardName) {
            $house = new House($houseName);
            $wizard = new Wizard($wizardName);

            $house->addWizard($wizard);
            $house->removeWizard($wizard);
            self::assertEmpty($house->getWizards());
        });
    }

    public function testOverwrite() {
        $this->forAll(names(), names(), names())->then(function ($houseAName, $houseBName, $wizardName) {
            $houseA = new House($houseAName);
            $houseB = new House($houseBName);
            $wizard = new Wizard($wizardName);

            $wizard->setHouse($houseA);
            $wizard->setHouse($houseB);

            $this->assertEquals($houseB, $wizard->getHouse());
            $this->assertEmpty($houseA->getWizards(), "$wizard was not removed from $houseA");
            $this->assertCount(1, $houseB->getWizards());
            $this->assertEquals($wizard, $houseB->getWizards()->first());
        });
    }
}
