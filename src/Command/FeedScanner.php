<?php

namespace NapoleonCat\Command;

use NapoleonCat\Model\InboxItemCollection;
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
    //private const CURRENT_PAGE_ID = 104303108447809;
    private const SPACE_DECORATOR = '    ';

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

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $pageId = $input->getArgument(self::PAGE_SOCIAL_ARGUMENT);
        $collection = $this->pageScannerService->scan($pageId);
        $this->debugFeed($collection, $output);
        $output->writeln('Feed successfully generated!');

        return Command::SUCCESS;
    }

    private function debugFeed(InboxItemCollection $collection, OutputInterface $output, $step = 0): void
    {
        foreach ($collection as $item) {
            $output->writeln(str_repeat(self::SPACE_DECORATOR, $step) . $item->getData());
            if ($item->getChild()) {
                $this->debugFeed($item->getChild(), $output, $step+1);
            }
        }
    }
}