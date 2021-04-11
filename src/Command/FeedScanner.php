<?php

namespace NapoleonCat\Command;

use NapoleonCat\Infrastructure\QueueRepositoryInterface;
use NapoleonCat\Model\InboxItemCollection;
use NapoleonCat\Model\ItemType;
use NapoleonCat\Services\PageScanner;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class FeedScanner
 */
class FeedScanner extends Command
{
    private const PAGE_SOCIAL_ARGUMENT = 'page_social_id';

    private PageScanner $pageScannerService;
    protected static $defaultName = 'app:feed';

    public function __construct(PageScanner $pageScannerService)
    {
        $this->pageScannerService = $pageScannerService;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setDescription('Feed Facebook Page & send to ZMQ');
        $this->addArgument(self::PAGE_SOCIAL_ARGUMENT, InputArgument::REQUIRED);
        $this->addOption('print', 'p', InputOption::VALUE_NONE);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        return Command::SUCCESS;
    }
}