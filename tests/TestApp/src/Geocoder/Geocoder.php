<?php

namespace TestApp\Geocoder;

use Cake\Utility\Text;
use Geo\Geocoder\Geocoder as GeoGeocoder;
use RuntimeException;
use Shim\TestSuite\TestTrait;

/**
 * Geocode via google (UPDATE: api3)
 *
 * @see https://developers.google.com/maps/documentation/geocoding/
 *
 * Used by Geo.GeocoderBehavior
 *
 * @author Mark Scherer
 * @license MIT
 */
class Geocoder extends GeoGeocoder {

	use TestTrait;

	/**
	 * @param \Geocoder\Provider\Provider $geocoder
	 * @return void
	 */
	public function setGeocoderAndResult($geocoder) {
		$this->geocoder = $geocoder;
	}

	/**
	 * @param string $address
	 * @param array $params
	 *
	 * @throws \RuntimeException
	 * @return \Geocoder\Model\AddressCollection
	 */
	public function geocode($address, array $params = []) {
		$file = Text::slug($address) . '.txt';

		$testFiles = ROOT . DS . 'tests' . DS . 'test_files' . DS . 'Geocoder' . DS;
		$testFile = $testFiles . $file;

		if ($this->isDebug() || !file_exists($testFile)) {
			if (!$this->isDebug() && getenv('CI')) {
				throw new RuntimeException('Should not happen on CI: ' . $testFile);
			}

			$addresses = parent::geocode($address, $params);
			file_put_contents($testFile, serialize($addresses));
		}

		$addresses = file_get_contents($testFile);
		$addresses = unserialize($addresses);

		return $addresses;
	}

}
