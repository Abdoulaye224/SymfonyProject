<?php
namespace App\DataFixtures;

use App\Entity\VideoGame;
use App\Repository\EditorRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as Faker;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class VideoGameFixture extends Fixture
{
    private $editorRepository;
    public function __construct(EditorRepository $editorRepository)
    {
        $this->editorRepository = $editorRepository;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker::create();

        $editorList = $this->editorRepository->findAll();

        for ($i = 0; $i < 20; $i++) {
            $videoGame = new VideoGame();

            $editorIndex = $faker->numberBetween(0, count($editorList)-1);

            $videoGame->setTitle($faker->title);

            $videoGame->setSupport($faker->word);
            $videoGame->setDescription($faker->text);
            $videoGame->setEditor($editorList[$editorIndex]);

            $manager->persist($videoGame);
        }

        $manager->flush();
    }
}
