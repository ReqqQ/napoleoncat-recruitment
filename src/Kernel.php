<?php

namespace NapoleonCat;

use NapoleonCat\DependecyInjection\CollectCommandsToApplicationCompilerPass;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel as BasicKernel;
use Symfony\Component\DependencyInjection\ContainerBuilder;

final class Kernel extends BasicKernel
{
    /**
     * In more complex app, add bundles here
     */
    public function registerBundles(): array
    {
        return [];
    }

    protected function build(ContainerBuilder $containerBuilder): void
    {
        $containerBuilder->addCompilerPass(new CollectCommandsToApplicationCompilerPass);
    }

    /**
     * Load all services
     */
    public function registerContainerConfiguration(LoaderInterface $loader): void
    {
        $loader->load(__DIR__ . '/../config/services.yml');
    }
}