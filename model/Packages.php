<?php

namespace allekurier\api_v1\model;

/**
 * @author it@allekurier.pl
 */
class Packages
{
	/**
	 * @var array
	 */
	private $packages = [];

	/**
	 * @param array $packages[Package]
	 */
	public function __construct(array $packages = [])
	{
		foreach ($packages as $package) {
			$this->addPackage($package);
		}
	}

	/**
	 * @param Package $package
	 */
	public function addPackage(Package $package)
	{
		$this->packages[] = $package;
	}

	/**
	 * @return array
	 */
	public function toArray()
	{
		$packages = [];

		foreach ($this->packages as $package) {
			$packages[] = [
				'weight' => $package->weight(),
				'height' => $package->height(),
				'width'  => $package->width(),
				'length' => $package->length(),
				'custom' => $package->isCustom()
			];
		}

		return $packages;
	}
}
