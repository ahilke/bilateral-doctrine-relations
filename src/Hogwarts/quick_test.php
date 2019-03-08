<?php declare(strict_types=1);

namespace Hogwarts;

require __DIR__.'/../../vendor/autoload.php';

$slytherin = new House('Slytherin');
$gryffindor = new House('Gryffindor');
$harryPotter = new Wizard('Harry Potter');

echo "Add Wizard to House:\n";
$slytherin->addWizard($harryPotter);
echo "\n";
$harryPotter->printStatus();
$slytherin->printStatus();
$gryffindor->printStatus();
echo "------------------------------\n";

echo "Remove Wizard from House:\n";
$slytherin->removeWizard($harryPotter);
echo "\n";
$harryPotter->printStatus();
$slytherin->printStatus();
$gryffindor->printStatus();
echo "------------------------------\n";

echo "Set House of Wizard:\n";
$harryPotter->setHouse($slytherin);
echo "\n";
$harryPotter->printStatus();
$slytherin->printStatus();
$gryffindor->printStatus();
echo "------------------------------\n";

echo "Overwrite House of Wizard:\n";
$harryPotter->setHouse($gryffindor);
echo "\n";
$harryPotter->printStatus();
$slytherin->printStatus();
$gryffindor->printStatus();
echo "------------------------------\n";

echo "Null House of Wizard:\n";
$harryPotter->setHouse(null);
echo "\n";
$harryPotter->printStatus();
$slytherin->printStatus();
$gryffindor->printStatus();
echo "------------------------------\n";
