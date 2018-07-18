<?php

namespace Vortrixs;

use Composer\Package\RootPackageInterface;

class Scrutinizer
{
	/**
	 * Checks if we are running on Scrutinizer
	 *
	 * @return   boolean
	 */
	public function isScrutinizer() : bool
	{
		return getenv('SCRUTINIZER') && getenv('CI');
	}

	/**
	 * Get the name of the current node
	 *
	 * @return   string
	 */
	public function getNode() : string
	{
		return getenv('SCRUTINIZER_NODE_NAME');
	}

	/**
	 * Get the dependencies for the current node
	 *
	 * @param   RootPackageInterface   $package   [description]
	 * @param   string                 $node      [description]
	 *
	 * @return   array
	 */
	public function getNodeDependencies(RootPackageInterface $package, string $node)
	{
		$extra = $package->getExtra();

		if (! array_key_exists('scrutinizer', $extra))
		{
			return false;
		}

		return $extra['scrutinizer'][$node];
	}
}
