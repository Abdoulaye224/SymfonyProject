<?php
namespace App\DataFixtures;

use App\Entity\Editor;
use App\Repository\VideoGameRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as Faker;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class EditorFixture extends Fixture
{
    private $videoGameRepository;
    public function __construct(VideoGameRepository $videoGameRepository)
    {
        $this->videoGameRepository = $videoGameRepository;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            $editor = new Editor();

            $editor->setName($faker->name);
            $editor->setNationality($faker->name);
            $editor->setSocietyName($faker->name);

            $manager->persist($editor);
        }

        $manager->flush();
    }
}
