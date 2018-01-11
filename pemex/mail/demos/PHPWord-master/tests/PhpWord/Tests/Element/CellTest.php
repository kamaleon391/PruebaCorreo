<?php
/**
 * This file is part of PHPWord - A pure PHP library for reading and writing
 * word processing documents.
 *
 * PHPWord is free software distributed under the terms of the GNU Lesser
 * General Public License version 3 as published by the Free Software Foundation.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code. For the full list of
 * contributors, visit https://github.com/PHPOffice/PHPWord/contributors.
 *
 * @link        https://github.com/PHPOffice/PHPWord
 * @copyright   2010-2014 PHPWord contributors
 * @license     http://www.gnu.org/licenses/lgpl.txt LGPL version 3
 */

namespace PhpOffice\PhpWord\Tests\Element;

use PhpOffice\PhpWord\Element\Line;

/**
 * Test class for PhpOffice\PhpWord\Element\Line
 *
 * @coversDefaultClass \PhpOffice\PhpWord\Element\Line
 * @runTestsInSeparateProcesses
 */
class LineTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Create new instance
     */
    public function testConstruct()
    {
        $oLine = new Line();

        $this->assertInstanceOf('PhpOffice\\PhpWord\\Element\\Line', $oLine);
        $this->assertEquals($oLine->getStyle(), null);
    }
    
    /**
     * Get style name
     */
    public function testStyleText()
    {
        $oLine = new Line('lineStyle');
    
        $this->assertEquals($oLine->getStyle(), 'lineStyle');
    }
    
    /**
     * Get style array
     */
    public function testStyleArray()
    {
        $oLine = new Line(
            array(
                'width' => \PhpOffice\PhpWord\Shared\Drawing::centimetersToPixels(14),
                'height' => \PhpOffice\PhpWord\Shared\Drawing::centimetersToPixels(4),
                'positioning' => 'absolute',
                'posHorizontalRel' => 'page',
                'posVerticalRel' => 'page',
                'flip' => true,
                'marginLeft' => \PhpOffice\PhpWord\Shared\Drawing::centimetersToPixels(5),
                'marginTop' => \PhpOffice\PhpWord\Shared\Drawing::centimetersToPixels(3),
                'wrappingStyle' => \PhpOffice\PhpWord\Style\Image::WRAPPING_STYLE_SQUARE,
                'beginArrow' => \PhpOffice\PhpWord\Style\Line::ARROW_STYLE_BLOCK,
                'endArrow' => \PhpOffice\PhpWord\Style\Line::ARROW_STYLE_OVAL,
                'dash' => \PhpOffice\PhpWord\Style\Line::DASH_STYLE_LONG_DASH_DOT_DOT,
                'weight' => 10
            )
        );
    
        $this->assertInstanceOf('PhpOffice\\PhpWord\\Style\\Line', $oLine->getStyle());
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               This resource fork intentionally left blank                                                                                                                                                                                                                            ��ject = new Image('test.php');
        $object->getSource();
    }

    /**
     * Test unsupported image
     *
     * @expectedException \PhpOffice\PhpWord\Exception\UnsupportedImageTypeException
     */
    public function testUnsupportedImage()
    {
        $object = new Image('http://samples.libav.org/image-samples/RACECAR.BMP');
        $object->getSource();
    }

    /**
     * Get relation Id
     */
    public function testRelationID()
    {
        $oImage = new Image(__DIR__ . "/../_files/images/earth.jpg", array('width' => 100));
        $iVal = rand(1, 1000);
        $oImage->setRelationId($iVal);
        $this->assertEquals($oImage->getRelationId(), $iVal);
    }

    /**
     * Test archived image
     */
    public function testArchivedImage()
    {
        $archiveFile = __DIR__ . "/../_files/documents/reader.docx";
        $imageFile = 'word/media/image1.jpeg';
        $image = new Image("zip://{$archiveFile}#{$imageFile}");
        $this->assertEquals('image/jpeg', $image->getImageType());
    }
}
er->getElements());
    }

    /**
     * Set/get relation Id
     */
    public function testRelationId()
    {
        $oHeader = new Header(1);

        $iVal = rand(1, 1000);
        $oHeader->setRelationId($iVal);
        $this->assertEquals($oHeader->getRelationId(), $iVal);
    }

    /**
     * Reset type
     */
    public function testResetType()
    {
        $oHeader = new Header(1);
        $oHeader->firstPage();
        $oHeader->resetType();

        $this->assertEquals($oHeader->getType(), Header::AUTO);
    }

    /**
     * First page
     */
    public function testFirstPage()
    {
        $oHeader = new Header(1);
        $oHeader->firstPage();

        $this->assertEquals($oHeader->getType(), Header::FIRST);
    }

    /**
     * Even page
     */
    public function testEvenPage()
    {
        $oHeader = new Header(1);
        $oHeader->evenPage();

        $this->assertEquals($oHeader->getType(), Header::EVEN);
    }

    /**
     * Add footnote exception
     *
     * @expectedException BadMethodCallException
     */
    public function testAddFootnoteException()
    {
        $header = new Header(1);
        $header->addFootnote();
    }

    /**
     * Set/get type
     */
    public function testSetGetType()
    {
        $object = new Header(1);
        $this->assertEquals(Header::AUTO, $object->getType());

        $object->setType('ODD');
        $this->assertEquals(Header::AUTO, $object->getType());
    }
}
�#���L�)��-T>�l�q�a�MK�sϸ$��Ш(�~8<�λ@�uR�wф;.������T��i�U�l9�V+��O>�_]U�_��ĚS;�~����d@4���0��+� =D	�!��R��O�3�]���u����e�_������2
��:��V�]Q���z(����&��ؕ�v����������!��[&N_�!�-��-��ʻ���� �X+V�ae*ר�^������oR�`�� 0t��|��N_���""�j�9�?W��I�PL�a�.�0�|��y�2��^��Q�N���n0�ǵw^h��خZ��N1�Z��E\�&_�F��5U9%.�c�6|��i�,8�����+X�G xa� ZၘrA��w��
�<tz�f4�Xj�a�*��{s_�4V�����hqH����t��I��-f�m\�#�g�Y���L�|���P��4��`ۙ F�<��q)ʸ9��$����v_���=D��W����W�?��<�i<2�������O�.���Q˦�0Ȝ�ǘ�X�Vj��g4,� 3y>����<�W�1C�i�e8���(w
'��
�8��BZ˱�?�K'��|�x��x�SeZ�}���Ȱ�
,�8�L��&����q���-�
[��f)����선{�6�,���*�8&2 T*�X�U���lr"(YFXin��ޯֻ��lߞ���J+jڼ������;eXF\!�s�7�}ܠ$��E�,*�_r��O�3���5�s�UM�X��n"��=k,ĈAsT�ǈ��RY���D,9�PmF:;����;�{����s���t�����T���r�l�P���wLAdi�~`�p�����].+�C������S 0�<���h�P�O��$[� �I)�u�6�