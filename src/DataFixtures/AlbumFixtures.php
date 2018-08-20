<?php

namespace App\DataFixtures;

use App\Entity\Album;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AlbumFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $i = 0;
        foreach ($this->getAlbumData() as [$title, $img, $year, $artist]) {
            $album = new Album();
            $album->setTitle($title);
            $album->setImg($img);
            $album->setYear($year);
            $album->setArtist($artist);

            $manager->persist($album);

            $this->addReference($i, $album);
            $i++;
        }

        $manager->flush();
    }

    private function getAlbumData(): array
    {
        return [
            [
                "Demon Days",
                'demondays.png',
                2005,
                "Gorillaz"
            ],
            [
                "The Getaway",
                "thegetaway.png",
                2016,
                "Red Hot Chili Peppers"
            ],
            [
                "Flower Boy",
                "flowerboy.png",
                2017,
                "Tayler the creator"
            ],
            [
                "Tranquility Base Hotel and Casino",
                "tranquilitybasehotelandcasino.png",
                2018,
                "Arctic Monkeys"
            ],
        ];
    }
}
