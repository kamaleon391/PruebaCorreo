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

namespace PhpOffice\PhpWord\Reader\Word2007;

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\XMLReader;

/**
 * Numbering reader
 *
 * @since 0.10.0
 */
class Numbering extends AbstractPart
{
    /**
     * Read numbering.xml
     *
     * @param \PhpOffice\PhpWord\PhpWord $phpWord
     */
    public function read(PhpWord &$phpWord)
    {
        $abstracts = array();
        $numberings = array();
        $xmlReader = new XMLReader();
        $xmlReader->getDomFromZip($this->docFile, $this->xmlFile);

        // Abstract numbering definition
        $nodes = $xmlReader->getElements('w:abstractNum');
        if ($nodes->length > 0) {
            foreach ($nodes as $node) {
                $abstractId = $xmlReader->getAttribute('w:abstractNumId', $node);
                $abstracts[$abstractId] = array('levels' => array());
                $abstract = &$abstracts[$abstractId];
                $subnodes = $xmlReader->getElements('*', $node);
                foreach ($subnodes as $subnode) {
                    switch ($subnode->nodeName) {
                        case 'w:multiLevelType':
                            $abstract['type'] = $xmlReader->getAttribute('w:val', $subnode);
                            break;
                        case 'w:lvl':
                            $levelId = $xmlReader->getAttribute('w:ilvl', $subnode);
                            $abstract['levels'][$levelId] = $this->readLevel($xmlReader, $subnode, $levelId);
                            break;
                    }
                }
            }
        }

        // Numbering instance definition
        $nodes = $xmlReader->getElements('w:num');
        if ($nodes->length > 0) {
            foreach ($nodes as $node) {
                $numId = $xmlReader->getAttribute('w:numId', $node);
                $abstractId = $xmlReader->getAttribute('w:val', $node, 'w:abstractNumId');
                $numberings[$numId] = $abstracts[$abstractId];
                $numberings[$numId]['numId'] = $numId;
                $subnodes = $xmlReader->getElements('w:lvlOverride/w:lvl', $node);
                foreach ($subnodes as $subnode) {
                    $levelId = $xmlReader->getAttribute('w:ilvl', $subnode);
                    $overrides = $this->readLevel($xmlReader, $subnode, $levelId);
                    foreach ($overrides as $key => $value) {
                        $numberings[$numId]['levels'][$levelId][$key] = $value;
                    }
                }
            }
        }

        // Push to Style collection
        foreach ($numberings as $numId => $numbering) {
            $phpWord->addNumberingStyle("PHPWordList{$numId}", $numbering);
        }
    }

    /**
     * Read numbering level definition from w:abstractNum and w:num
     *
     * @param \PhpOffice\PhpWord\Shared\XMLReader $xmlReader
     * @param \DOMElement $subnode
     * @param integer $levelId
     * @return array
     */
    private function readLevel(XMLReader $xmlReader, \DOMElement $subnode, $levelId)
    {
        $level = array();

        $level['level'] = $levelId;
        $level['start'] = $xmlReader->getAttribute('w:val', $subnode, 'w:start');
        $level['format'] = $xmlReader->getAttribute('w:val', $subnode, 'w:numFmt');
        $level['restart'] = $xmlReader->getAttribute('w:val', $subnode, 'w:lvlRestart');
        $level['suffix'] = $xmlReader->getAttribute('w:val', $subnode, 'w:suff');
        $level['text'] = $xmlReader->getAttribute('w:val', $subnode, 'w:lvlText');
        $level['align'] = $xmlReader->getAttribute('w:val', $subnode, 'w:lvlJc');
        $level['tab'] = $xmlReader->getAttribute('w:pos', $subnode, 'w:pPr/w:tabs/w:tab');
        $level['left'] = $xmlReader->getAttribute('w:left', $subnode, 'w:pPr/w:ind');
        $level['hanging'] = $xmlReader->getAttribute('w:hanging', $subnode, 'w:pPr/w:ind');
        $level['font'] = $xmlReader->getAttribute('w:ascii', $subnode, 'w:rPr/w:rFonts');
        $level['hint'] = $xmlReader->getAttribute('w:hint', $subnode, 'w:rPr/w:rFonts');

        foreach ($level as $key => $value) {
            if (is_null($value)) {
                unset($level[$key]);
            }
        }

        return $level;
    }
}
sh(true);
        $this->flags = array_pop($this->groups);
    }

    /**
     * Mark backslash `\` character
     */
    private function markBackslash()
    {
        if ($this->isFirst) {
            $this->setControl(false);
            $this->text .= '\\';
        } else {
            $this->flush();
            $this->setControl(true);
            $this->control = '';
        }
    }

    /**
     * Mark newline character: Flush control word because it's not possible to span multiline
     */
    private function markNewline()
    {
        if ($this->isControl) {
            $this->flushControl(true);
        }
    }

    /**
     * Flush control word or text
     *
     * @param bool $isControl
     */
    private function flush($isControl = false)
    {
        if ($this->isControl) {
            $this->flushControl($isControl);
        } else {
            $this->flushText();
        }
    }

    /**
     * Flush control word
     *
     * @param bool $isControl
     */
    private function flushControl($isControl = false)
    {
        if (preg_match("/^([A-Za-z]+)(-?[0-9]*) ?$/", $this->control, $match) === 1) {
            list(, $control, $parameter) = $match;
            $this->parseControl($control, $parameter);
        }

        if ($isControl === true) {
            $this->setControl(false);
        }
    }

    /**
     * Flush text in queue
     */
    private function flushText()
    {
        if ($this->text != '') {
            if (isset($this->flags['property'])) { // Set property
                $this->flags['value'] = $this->text;
            } else { // Set text
                if ($this->flags['paragraph'] === true) {
                    $this->flags['paragraph'] = false;
                    $this->flags['text'] = $this->text;
                }
            }

            // Add text if it's not flagged as skipped
            if (!isset($this->flags['skipped'])) {
                $this->readText();
            }

            $this->text = '';
        }
    }

    /**
     * Reset control word and first char state
     *
     * @param bool $value
     */
    private function setControl($value)
    {
        $this->isControl = $value;
        $this->isFirst = $value;
    }

    /**
     * Push text into queue
     *
     * @param string $char
     */
    private function pushText($char)
    {
        if ($char == '<') {
            $this->text .= "&lt;";
        } elseif ($char == '>') {
            $this->text .= "&gt;";
        } else {
            $this->text .= $char;
        }
    }

    /**
     * Parse control
     *
     * @param string $control
     * @param string $parameter
     */
    private function parseControl($control, $parameter)
    {
        $controls = array(
            'par'       => array(self::PARA,    'paragraph',    true),
            'b'         => array(self::STYL,    'font',         'bold',         true),
            'i'         => array(self::STYL,    'font',         'italic',       true),
            'u'         => array(self::STYL,    'font',         'underline',    true),
            'strike'    => array(self::STYL,    'font',         'strikethrough',true),
            'fs'        => array(self::STYL,    'font',         'size',         $parameter),
            'qc'        => array(self::STYL,    'paragraph',    'align',        'center'),
            'sa'        => array(self::STYL,    'paragraph',    'spaceAfter',   $parameter),
            'fonttbl'   => array(self::SKIP,    'fonttbl',      null),
            'colortbl'  => array(self::SKIP,    'colortbl',     null),
            'info'      => array(self::SKIP,    'info',         null),
            'generator' => array(self::SKIP,    'generator',    null),
            'title'     => array(self::SKIP,    'title',        null),
            'subject'   => array(self::SKIP,    'subject',      null),
            'category'  => array(self::SKIP,    'category',     null),
            'keywords'  => array(self::SKIP,    'keywords',     null),
            'comment'   => array(self::SKIP,    'comment',      null),
            'shppict'   => array(self::SKIP,    'pic',          null),
            'fldinst'   => array(self::SKIP,    'link',         null),
        );

        if (array_key_exists($control, $controls)) {
            list($function) = $controls[$control];
            if (method_exists($this, $function)) {
                $directives = $controls[$control];
                array_shift($directives); // remove the function variable; we won't need it
                $this->$function($directives);
            }
        }
    }

    /**
     * Read paragraph
     *
     * @param array $directives
     */
    private function readParagraph($directives)
    {
        list($property, $value) = $directives;
        $this->textrun = $this->section->addTextRun();
        $this->flags[$property] = $value;
    }

    /**
     * Read style
     *
     * @param array $directives
     */
    private function readStyle($directives)
    {
        list($style, $property, $value) = $directives;
        $this->flags['styles'][$style][$property] = $value;
    }

    /**
     * Read skip
     *
     * @param array $directives
     */
    private function readSkip($directives)
    {
        list($property) = $directives;
        $this->flags['property'] = $property;
        $this->flags['skipped'] = true;
    }

    /**
     * Read text
     */
    private function readText()
    {
        $text = $this->textrun->addText($this->text);
        if (isset($this->flags['styles']['font'])) {
            $text->getFontStyle()->setStyleByArray($this->flags['styles']['font']);
        }
    }
}
   case 'image/png':
                $this->imageCreateFunc = 'imagecreatefrompng';
                $this->imageFunc = 'imagepng';
                $this->imageExtension = 'png';
                break;
            case 'image/gif':
                $this->imageCreateFunc = 'imagecreatefromgif';
                $this->imageFunc = 'imagegif';
                $this->imageExtension = 'gif';
                break;
            case 'image/jpeg':
            case 'image/jpg':
                $this->imageCreateFunc = 'imagecreatefromjpeg';
                $this->imageFunc = 'imagejpeg';
                $this->imageExtension = 'jpg';
                break;
            case 'image/bmp':
            case 'image/x-ms-bmp':
                $this->imageType = 'image/bmp';
                $this->imageExtension = 'bmp';
                break;
            case 'image/tiff':
                $this->imageExtension = 'tif';
                break;
        }
    }

    /**
     * Set proportional width/height if one dimension not available
     *
     * @param integer $actualWidth
     * @param integer $actualHeight
     */
    private function setProportionalSize($actualWidth, $actualHeight)
    {
        $styleWidth = $this->style->getWidth();
        $styleHeight = $this->style->getHeight();
        if (!($styleWidth && $styleHeight)) {
            if ($styleWidth == null && $styleHeight == null) {
                $this->style->setWidth($actualWidth);
                $this->style->setHeight($actualHeight);
            } elseif ($styleWidth) {
                $this->style->setHeight($actualHeight * ($styleWidth / $actualWidth));
            } else {
                $this->style->setWidth($actualWidth * ($styleHeight / $actualHeight));
            }
        }
    }

    /**
     * Get is watermark
     *
     * @deprecated 0.10.0
     * @codeCoverageIgnore
     */
    public function getIsWatermark()
    {
        return $this->isWatermark();
    }

    /**
     * Get is memory image
     *
     * @deprecated 0.10.0
     * @codeCoverageIgnore
     */
    public function getIsMemImage()
    {
        return $this->isMemImage();
    }
}
\Serializer\\": ""
                }
            },
            "notification-url": "https://packagist.org/downloads/",
            "license": [
                "BSD-3-Clause"
            ],
            "description": "provides an adapter based interface to simply generate storable representation of PHP types by different facilities, and recover",
            "keywords": [
                "serializer",
                "zf2"
            ],
            "time": "2014-01-02 18:00:26"
        },
        {
            "name": "zendframework/zend-servicemanager",
            "version": "2.1.6",
            "target-dir": "Zend/ServiceManager",
            "source": {
                "type": "git",
                "url": "https://github.com/zendframework/Component_ZendServiceManager.git",
                "reference": "de182a20dfdcf978c49570514103c7477ef16e4f"
            },
            "dist": {
                "type": "zip",
                "url": "https://api.github.com/repos/zendframework/Component_ZendServiceManager/zipball/de182a20dfdcf978c49570514103c7477ef16e4f",
                "reference": "de182a20dfdcf978c49570514103c7477ef16e4f",
                "shasum": ""
            },
            "require": {
                "php": ">=5.3.3"
            },
            "suggest": {
                "zendframework/zend-di": "Zend\\Di component"
            },
            "type": "library",
            "extra": {
                "branch-alias": {
                    "dev-master": "2.2-dev",
                    "dev-develop": "2.3-dev"
                }
            },
            "autoload": {
                "psr-0": {
                    "Zend\\ServiceManager\\": ""
                }
            },
            "notification-url": "https://packagist.org/downloads/",
            "license": [
                "BSD-3-Clause"
            ],
            "keywords": [
                "servicemanager",
                "zf2"
            ],
            "time": "2014-03-03 21:00:04"
        },
        {
            "name": "zendframework/zend-stdlib",
            "version": "2.1.6",
            "target-dir": "Zend/Stdlib",
            "source": {
                "type": "git",
                "url": "https://github.com/zendframework/Component_ZendStdlib.git",
                "reference": "e646729f2274f4552b6a92e38d8e458efe08ebc5"
            },
            "dist": {
                "type": "zip",
                "url": "https://api.github.com/repos/zendframework/Component_ZendStdlib/zipball/e646729f2274f4552b6a92e38d8e458efe08ebc5",
                "reference": "e646729f2274f4552b6a92e38d8e458efe08ebc5",
                "shasum": ""
            },
            "require": {
                "php": ">=5.3.3"
            },
            "suggest": {
                "zendframework/zend-eventmanager": "To support aggregate hydrator usage",
                "zendframework/zend-servicemanager": "To support hydrator plugin manager usage"
            },
            "type": "library",
            "extra": {
                "branch-alias": {
                    "dev-master": "2.2-dev",
                    "dev-develop": "2.3-dev"
                }
            },
            "autoload": {
                "psr-0": {
                    "Zend\\Stdlib\\": ""
                }
            },
            "notification-url": "https://packagist.org/downloads/",
            "license": [
                "BSD-3-Clause"
            ],
            "keywords": [
                "stdlib",
                "zf2"
            ],
            "time": "2014-01-04 13:00:28"
        },
        {
            "name": "zetacomponents/base",
            "v<?php
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

namespace PhpOffice\PhpWord\Reader\Word2007;

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\XMLReader;

/**
 * Numbering reader
 *
 * @since 0.10.0
 */
class Numbering extends AbstractPart
{
    /**
     * Read numbering.xml
     *
     * @param \PhpOffice\PhpWord\PhpWord $phpWord
     */
    public function read(PhpWord &$phpWord)
    {
        $abstracts = array();
        $numberings = array();
        $xmlReader = new XMLReader();
        $xmlReader->getDomFromZip($this->docFile, $this->xmlFile);

        // Abstract numbering definition
        $nodes = $xmlReader->getElements('w:abstractNum');
        if ($nodes->length > 0) {
            foreach ($nodes as $node) {
                $abstractId = $xmlReader->getAttribute('w:abstractNumId', $node);
                $abstracts[$abstractId] = array('levels' => array());
                $abstract = &$abstracts[$abstractId];
                $subnodes = $xmlReader->getElements('*', $node);
                foreach ($subnodes as $subnode) {
                    switch ($subnode->nodeName) {
                        case 'w:multiLevelType':
                            $abstract['type'] = $xmlReader->getAttribute('w:val', $subnode);
                            break;
                        case 'w:lvl':
                            $levelId = $xmlReader->getAttribute('w:ilvl', $subnode);
                            $abstract['levels'][$levelId] = $this->readLevel($xmlReader, $subnode, $levelId);
                            break;
                    }
                }
            }
        }

        // Numbering instance definition
        $nodes = $xmlReader->getElements('w:num');
        if ($nodes->length > 0) {
            foreach ($nodes as $node) {
                $numId = $xmlReader->getAttribute('w:numId', $node);
                $abstractId = $xmlReader->getAttribute('w:val', $node, 'w:abstractNumId');
                $numberings[$numId] = $abstracts[$abstractId];
                $numberings[$numId]['numId'] = $numId;
                $subnodes = $xmlReader->getElements('w:lvlOverride/w:lvl', $node);
                foreach ($subnodes as $subnode) {
                    $levelId = $xmlReader->getAttribute('w:ilvl', $subnode);
        