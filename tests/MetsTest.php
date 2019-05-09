<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 09/05/2019
 * Time: 10:13
 */

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Entity\Mets;

class MetsTest extends TestCase
{
    public function testmets(){

        $mets = (new Mets())
            ->setTitle('couscous')
            ->setDescription('de type royale ou pas')
        ;

        $this->assertEquals('couscous', $mets->getTitle());
        $this->assertEquals('de type royale ou pas', $mets->getDescription());
    }
}