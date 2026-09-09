<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(name: 'app:seed-root-user', description: 'Ensures the default root user exists.')]
class SeedRootUserCommand extends Command
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly UserPasswordHasherInterface $passwordHasher,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $repository = $this->entityManager->getRepository(User::class);
        $user = $repository->findOneBy(['username' => 'root']);

        if (!$user) {
            $user = new User();
        }

        $user->setUsername('root');
        $user->setEmail('root@matelio.local');
        $user->setPassword($this->passwordHasher->hashPassword($user, 'root'));
        $user->setRegistrationDate(new \DateTimeImmutable());

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return Command::SUCCESS;
    }
}
