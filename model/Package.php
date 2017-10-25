<?php

namespace allekurier\api_v1\model;

/**
 * @author it@allekurier.pl
 */
class Package
{
	/**
	 * @var float
	 */
	private $weight;

	/**
	 * @var float
	 */
	private $width;

	/**
	 * @var float
	 */
	private $height;

	/**
	 * @var float
	 */
	private $length;

	/**
	 * @var bool
	 */
	private $isCustom;

	public function __construct(
		$weight = null,
		$width = null,
		$height = null,
		$length = null,
		$isCustom = false
	) {
		$this->weight = $weight;
		$this->width  = $width;
		$this->height = $height;
		$this->length = $length;
		$this->isCustom = $isCustom;
	}

	/**
	 * @return float
	 */
	public function weight()
	{
		return $this->weight;
	}

	/**
	 * @return float
	 */
	public function width()
	{
		return $this->width;
	}

	/**
	 * @return float
	 */
	public function height()
	{
		return $this->height;
	}

	/**
	 * @return float
	 */
	public function length()
	{
		return $this->length;
	}

	/**
	 * @var bool
	 */
	public function isCustom()
	{
		return $this->isCustom;
	}
}
