<?php

namespace App\DataFixtures;

use App\Entity\Song;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class SongFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager) {
        foreach ($this->getSongData() as [$title, $rating, $length, $album]) {
            $song = new Song();
            $song->setTitle($title);
            $song->setRating($rating);
            $song->setLength($length);
            $song->addAlbum($album);

            $manager->persist($song);
        }

        $manager->flush();
    }

    private function getSongData(): array {
        return [
            ['Kids with guns', 4.25, 3.46, $this->getReference(0)],
            ['Dirty Harry', 4, 3.44, $this->getReference(0)],
            ['November has come', 4.75, 2.41, $this->getReference(0)],

            ['Dark Necessities', 4.5, 5.02, $this->getReference(1)],
            ['The Hunter', 4, 4.00, $this->getReference(1)],

            ['Four out of five', 4, 5.12, $this->getReference(3)],
        ];
    }

    public function getDependencies() {
        return array(
            AlbumFixtures::class,
        );
    }
}
