<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 07/05/2019
 * Time: 15:40
 */

namespace App\Tests;


use App\Entity\Vin;
use PHPUnit\Framework\TestCase;


class VinTest extends TestCase
{

    public function test(){
        $vin= (new Vin())
            ->setAppelation('bourgogne');
       //     ->setColor('rouge')
         //   ->setImage('img')
        //    ->setName('fleurie')
      //      ->setPrix('23e');

        $this->assertEqual('bourgogne', $vin->getAppelation());
    }
}