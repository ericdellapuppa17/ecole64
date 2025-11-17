<?php

namespace App\Tests\Entity;

use App\Entity\Devoirs;
use PHPUnit\Framework\TestCase;

class DevoirsTest extends TestCase
{
    public function testSomething(): void
    {
        $this->assertTrue(true);
    }

    public function testSomethingElse(): void
    {
        $this->assertTrue(false, "Il fallait s'y attendre");
    }

    // public function testSlug(): void
    // {
    //     $cours = new Devoirs();
    //     $cours->setDevoirNom('Devoir de test');
    //     $this->assertEquals('devoir-de-test', $cours->getSlug());
    // }
}
