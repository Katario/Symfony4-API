<?php

namespace App\Tests;

use App\Entity\Album;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class AlbumTest extends TestCase
{
    /**
     * Not really useful, but allow to have a test here
     *
     * @var Album
     */
    protected $album;

    protected function setUp() {
        $this->album = new Album();
    }

    public function testGetterAndSetter() {
        $this->assertNull($this->album->getId());

        $this->album->setTitle('Test');
        $this->assertEquals('Test', $this->album->getTitle());

        $this->album->setYear(2000);
        $this->assertEquals(2000, $this->album->getYear());
    }
}
