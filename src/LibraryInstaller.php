<?php

namespace Vortrixs;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller as BaseLibraryInstaller;
use Composer\Repository\InstalledRepositoryInterface;

/**
 * @property Composer    $composer Composer instance
 * @property IOInterface $io       IO instance
 */
class LibraryInstaller extends BaseLibraryInstaller
{
	/**
	 * @var   Scrutinizer
	 */
	private $scrutinizer;

	/**
	 * Initializes Plugin installer.
	 *
	 * @param   IOInterface    $io            IO instance
	 * @param   Composer       $composer      Composer instance
	 * @param   Scrutinizer    $scrutinizer   Scrutinizer helper
	 */
	public function __construct(IOInterface $io, Composer $composer, Scrutinizer $scrutinizer)
	{
		parent::__construct($io, $composer);

		$this->scrutinizer = $scrutinizer;
	}

	/**
	 * Installs specific package.
	 *
	 * @param   InstalledRepositoryInterface $repo    repository in which to check
	 * @param   PackageInterface             $package package instance
	 *
	 * @return void
	 */
	public function install(InstalledRepositoryInterface $repo, PackageInterface $package)
	{
		if (!$this->validatePackage($package))
		{
			return;
		}

		parent::install($repo, $package);
	}

	/**
	 * Updates specific package.
	 *
	 * @param   InstalledRepositoryInterface $repo    repository in which to check
	 * @param   PackageInterface             $initial already installed package version
	 * @param   PackageInterface             $target  updated version
	 *
	 * @throws InvalidArgumentException if $initial package is not installed
	 *
	 * @return void
	 */
	public function update(InstalledRepositoryInterface $repo, PackageInterface $initial, PackageInterface $target)
	{
		if (!$this->validatePackage($target))
		{
			return;
		}

		parent::update($repo, $initial, $target);
	}

	/**
	 * Validates wether the package should be installed or not
	 *
	 * @param   PackageInterface   $package   Package that is being validated
	 *
	 * @return   boolean
	 */
	private function validatePackage(PackageInterface $package) : bool
	{
		$dependencies = $this->scrutinizer->getNodeDependencies(
			$this->composer->getPackage(),
			$this->scrutinizer->getNode()
		);

		if (false === $dependencies)
		{
			return true;
		}

		return in_array($package->getPrettyName(), $dependencies);
	}
}
