<?php

namespace Vortrixs;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

/**
 * Plugin for integrating with Scrutinizer nodes
 *
 * @since 1.0.0
 */
class LibraryPlugin implements PluginInterface
{
    /**
     * Entry point for composer
     *
     * @param   Composer      $composer   [description]
     * @param   IOInterface   $io         [description]
     *
     * @return   boolean
     */
    public function activate(Composer $composer, IOInterface $io)
    {
        $scrutinizer = new Scrutinizer();

        if (!$scrutinizer->isScrutinizer()) {
            return false;
        }

        $installer = new LibraryInstaller($io, $composer, $scrutinizer);
        $composer->getInstallationManager()->addInstaller($installer);

        return true;
    }

    public function deactivate(Composer $composer, IOInterface $io)
    {
    }

    public function uninstall(Composer $composer, IOInterface $io)
    {
    }
}
