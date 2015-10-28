<?php
/**
 * mm: the PHP media library
 *
 * Copyright (c) 2007 David Persson
 *
 * Distributed under the terms of the MIT License.
 * Redistributions of files must retain the above copyright notice.
 */

namespace mm\tests\integration\Mime\Type\Magic\Adapter;

use mm\Mime\Type\Magic\Adapter\Freedesktop;

class FreedesktopShippedTest extends \PHPUnit_Framework_TestCase {

	public $subject;

	protected $_files;
	protected $_data;

	protected function setUp() {
		$this->_files = dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))) . '/data';
		$this->_data = dirname(dirname(dirname(dirname(dirname(dirname(dirname(__FILE__))))))) .'/data';
	}

	public function testAnalyze() {
		$file = $this->_data . '/magic.db';
		$this->subject = new Freedesktop(compact('file'));

		$files = [
			'ms_snippet.avi' => 'video/x-msvideo',
			'image_gif.gif' => 'image/gif',
			'application_pdf.pdf' => 'application/pdf',
			'postscript_snippet.ps' => 'application/postscript',
			'tar_snippet.tar' => 'application/x-tar',
			'wave_snippet.wav' => 'audio/x-wav',
			'3gp_snippet.3gp' => 'video/3gpp',
			'bzip2_snippet.bz2' => 'application/x-bzip', // application/x-bzip2
			'video_snippet.mp4' => 'video/mp4',
			'gzip_snippet.gz' => 'application/x-gzip',
			'text_html_snippet.html' => 'text/html',
			'image_jpeg_snippet.jpg' => 'image/jpeg', // audio/MP4A-LATM
			'video_mpeg_snippet.mpeg' => 'video/mpeg',
			'video_ogg_snippet.ogv' => 'video/x-theora+ogg', // application/ogg
			'audio_ogg_snippet.ogg' => 'audio/x-vorbis+ogg', //application/ogg
			'code_php.php' => 'application/x-php',
			'image_png.png' => 'image/png',
			'text_rtf_snippet.rtf' => 'application/rtf', // text/rtf
			'ms_word_snippet.doc' => 'application/msword', // audio/MP4A-LATM
			'xml_snippet.xml' => 'application/xml', // text/xml

			// fails with detecting application/vnd.oasis.opendocument.graphics
			// 'opendocument_writer_snippet.odt' => 'application/vnd.oasis.opendocument.text',
			// fails with detecting application/zip
			// 'ms_word_snippet.docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
			'audio_mpeg_snippet.mp3' => 'audio/mpeg',
			// fails with detecting video/x-ms-asf
			// 'text_plain_snippet.txt' => 'text/plain',
			// fails with detecting text/x-csrc
			// 'css_snippet.css' => 'text/css',
			// fails with detecting text/x-csrc
			// 'javascript_snippet.js' => 'application/javascript',
			// fails with detecting text/html
			// 'text_xhtml_snippet.xhtml' => 'application/xhtml+xml',
			// fails with detecting nothing
			// 'po_snippet.po' => 'text/x-gettext-translation',
			// fails with detecting nothing
			// 'text_pot_snippet.pot' => 'text/x-gettext-translation-template',
			// fails with detecting nothing
			// 'mo_snippet.mo' => 'application/x-gettext-translation',

			'video_flash_snippet.flv' => 'video/x-flv',
			'audio_snippet.snd' => 'audio/basic',
			'audio_apple_snippet.aiff' => 'audio/x-aiff',
			'flash_snippet.swf' => 'application/x-shockwave-flash',
			'audio_mpeg_snippet.m4a' => 'audio/mp4',
			'audio_musepack_snippet.mpc' => 'audio/x-musepack',
			'video_quicktime_snippet.mov' => 'video/quicktime',
			'video_ms_snippet.wmv' => 'video/x-ms-asf',

			// fails with detecting nothing
			// 'audio_snippet.aac' => 'audio/x-aac',
			// fails with detecting video/x-ms-asf
			// 'audio_ms_snippet.wma' => 'audio/x-ms-asf',
			'flac_snippet.flac' => 'audio/flac',

			/* Fail! No data yet :( */
			// 'java_snippet.class' => 'application/x-java',
			// 'real_video_snippet.rm' => 'application/vnd.rn-realmedia'
		];

		foreach ($files as $file => $mimeTypes) {
			$handle = fopen($this->_files . '/' . $file, 'r');
			$this->assertContains($this->subject->analyze($handle), (array) $mimeTypes, "File `{$file}`.");
			fclose($handle);
		}
	}
}

?>