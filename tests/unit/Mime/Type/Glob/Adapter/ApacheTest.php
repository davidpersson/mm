<?php
/**
 * mm: the PHP media library
 *
 * Copyright (c) 2007-2014 David Persson
 *
 * Distributed under the terms of the MIT License.
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright  2007-2014 David Persson <nperson@gmx.de>
 * @license    http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link       http://github.com/davidpersson/mm
 */

require_once 'Mime/Type/Glob/Adapter/Apache.php';

class Mime_Type_Glob_Adapter_ApacheTest extends PHPUnit_Framework_TestCase {

	public $subject;

	protected $_files;
	protected $_data;

	protected function setUp() {
		$this->_files = dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))) . '/data';
		$this->_data = dirname(dirname(dirname(dirname(dirname(dirname(dirname(__FILE__))))))) .'/data';
	}

	public function testToArray() {
		$file = $this->_files . '/glob_apache_snippet.db';
		$this->subject = new Mime_Type_Glob_Adapter_Apache(compact('file'));

		$result = $this->subject->to('array');
		$this->assertEquals(390, count($result));
	}

	public function testAnalyzeFail() {
		$file = $this->_files . '/glob_apache_snippet.db';
		$this->subject = new Mime_Type_Glob_Adapter_Apache(compact('file'));

		$result = $this->subject->analyze('');
		$this->assertEquals([], $result);
	}

	public function testAnalyze() {
		$file = $this->_files . '/glob_apache_snippet.db';
		$this->subject = new Mime_Type_Glob_Adapter_Apache(compact('file'));

		$files = [
			'file.css' => ['text/css'],
			'file.gif' => ['image/gif'],
			'file.class' => ['application/java-vm'],
			'file.js' => ['application/x-javascript'],
			'file.pdf' => ['application/pdf'],
			'file.txt' => ['text/plain'],
			'file.doc' => ['application/msword'],
			'file.odt' => ['application/vnd.oasis.opendocument.text'],
			'file.tar' => ['application/x-tar'],
			'file.xhtml' => ['application/xhtml+xml'],
			'file.xml' => ['application/xml']
		];
		foreach ($files as $file => $mimeTypes) {
			$this->assertEquals($mimeTypes, $this->subject->analyze($file), "File `{$file}`.");
		}
	}
}

?>