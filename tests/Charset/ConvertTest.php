<?php
    class ConvertTest extends PHPUnit_Framework_TestCase {

        public function testUtf8Esc() {
            $code = \PhpTool\Charset\Convert::utf8_esc('天');
            $this->assertEquals('\xe5\xa4\xa9', $code);
        }

        public function testUtf8Desc() {
            $code = \PhpTool\Charset\Convert::utf8_desc('\xe5\xa4\xa9');
            $this->assertEquals('天', $code);
        }
        public function testUnicode2utf8One() {
            $code = \PhpTool\Charset\Convert::unicode2utf8('&#22825;');
            $this->assertEquals('天', $code);
        }
        public function testUnicode2utf8Two() {
            $code = \PhpTool\Charset\Convert::unicode2utf8('\u5929');
            $this->assertEquals('天', $code);
        }
    }
