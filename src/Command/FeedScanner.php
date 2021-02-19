<?php

declare(strict_types=1);
namespace NapoleonCat\Command;
use NapoleonCat\Infrastructure\QueueRepositoryInterface;
use NapoleonCat\Model\InboxItemCollection;
use NapoleonCat\Model\ItemType;

/**
 * Class FeedScanner
 */
class FeedScanner extends Command
{
    protected static $defaultName = 'app:feed';
    private const PAGE_SOCIAL_ARGUMENT = 'page_social_id';

    public function __construct()
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Feed Facebook Page & send to ZMQ');
        $this->addArgument(self::PAGE_SOCIAL_ARGUMENT, InputArgument::REQUIRED);
        $this->addOption('print','p', InputOption::VALUE_NONE);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

    }
}