<?php

namespace App\Command;

use App\Entity\Post;
use Domain\Post\PostManager;
use joshtronic\LoremIpsum;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AddPostCommand extends Command
{
    protected static   $defaultName = 'app:add-post';
    protected static $defaultDescription = 'Run app:add-post';

    private PostManager $postManager;
    private LoremIpsum $loremIpsum;

    public function __construct(PostManager $postManager, LoremIpsum $loremIpsum, string $name = null)
    {
        parent::__construct($name);
        $this->postManager = $postManager;
        $this->loremIpsum = $loremIpsum;
    }

    protected function configure(): void
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $dateTime = new \DateTime('now');
        $title    = 'Summary ' . $dateTime->format('Y-m-d');
        $content  = $this->loremIpsum->paragraphs(1);

        $post = new Post();
        $post->setTitle($title);
        $post->setContent($content);

        $this->postManager->addPost($post);

        $output->writeln('The post has been added.');

        return Command::SUCCESS;
    }
}
