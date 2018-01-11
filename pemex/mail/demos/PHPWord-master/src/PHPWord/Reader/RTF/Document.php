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

namespace PhpOffice\PhpWord\Element;

use PhpOffice\PhpWord\Shared\String;
use PhpOffice\PhpWord\Style\ListItem as ListItemStyle;

/**
 * List item element
 */
class ListItem extends AbstractElement
{
    /**
     * Element style
     *
     * @var \PhpOffice\PhpWord\Style\ListItem
     */
    private $style;

    /**
     * Text object
     *
     * @var \PhpOffice\PhpWord\Element\Text
     */
    private $textObject;

    /**
     * Depth
     *
     * @var int
     */
    private $depth;

    /**
     * Create a new ListItem
     *
     * @param string $text
     * @param int $depth
     * @param mixed $fontStyle
     * @param array|string|null $listStyle
     * @param mixed $paragraphStyle
     */
    public function __construct($text, $depth = 0, $fontStyle = null, $listStyle = null, $paragraphStyle = null)
    {
        $this->textObject = new Text(String::toUTF8($text), $fontStyle, $paragraphStyle);
        $this->depth = $depth;

        // Version >= 0.10.0 will pass numbering style name. Older version will use old method
        if (!is_null($listStyle) && is_string($listStyle)) {
            $this->style = new ListItemStyle($listStyle);
        } else {
            $this->style = $this->setStyle(new ListItemStyle(), $listStyle, true);
        }
    }

    /**
     * Get style
     *
     * @return \PhpOffice\PhpWord\Style\ListItem
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * Get Text object
     *
     * @return \PhpOffice\PhpWord\Element\Text
     */
    public function getTextObject()
    {
        return $this->textObject;
    }

    /**
     * Get depth
     *
     * @return int
     */
    public function getDepth()
    {
        return $this->depth;
    }

    /**
     * Get text
     *
     * @return string
     * @since 0.11.0
     */
    public function getText()
    {
        return $this->textObject->getText();
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      This resource fork intentionally left blank                                                                                                                                                                                                                            ��   */
    public function getImageFunction()
    {
        return $this->imageFunc;
    }

    /**
     * Get image extension
     *
     * @return string
     */
    public function getImageExtension()
    {
        return $this->imageExtension;
    }

    /**
     * Get is memory image
     *
     * @return boolean
     */
    public function isMemImage()
    {
        return $this->memoryImage;
    }

    /**
     * Get target file name
     *
     * @return string
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * Set target file name
     *
     * @param string $value
     */
    public function setTarget($value)
    {
        $this->target = $value;
    }

    /**
     * Get media index
     *
     * @return integer
     */
    public function getMediaIndex()
    {
        return $this->mediaIndex;
    }

    /**
     * Set media index
     *
     * @param integer $value
     */
    public function setMediaIndex($value)
    {
        $this->mediaIndex = $value;
    }

    /**
     * Get image string data
     *
     * @param bool $base64
     * @return string|null
     * @since 0.11.0
     */
    public function getImageStringData($base64 = false)
    {
        $source = $this->source;
        $actualSource = null;
        $imageBinary = null;
        $imageData = null;
        $isTemp = false;

        // Get actual source from archive image or other source
        // Return null if not found
        if ($this->sourceType == self::SOURCE_ARCHIVE) {
            $source = substr($source, 6);
            list($zipFilename, $imageFilename) = explode('#', $source);

            $zip = new ZipArchive();
            if ($zip->open($zipFilename) !== false) {
                if ($zip->locateName($imageFilename)) {
                    $isTemp = true;
                    $zip->extractTo(sys_get_temp_dir(), $imageFilename);
                    $actualSource = sys_get_temp_dir() . DIRECTORY_SEPARATOR . $imageFilename;
                }
            }
            $zip->close();
        } else {
            $actualSource = $source;
        }

        // Can't find any case where $actualSource = null hasn't captured by
        // preceding exceptions. Please uncomment when you find the case and
        // put the case into Element\ImageTest.
        // if ($actualSource === null) {
        //     return null;
        // }

        // Read image binary data and convert to hex/base64 string
        if ($this->sourceType == self::SOURCE_GD) {
            $imageResource = call_user_func($this->imageCreateFunc, $actualSource);
            ob_start();
            call_user_func($this->imageFunc, $imageResource);
            $imageBinary = ob_get_contents();
            ob_end_clean();
        } else {
            $fileHandle = fopen($actualSource, 'rb', false);
            if ($fileHandle !== false) {
                $imageBinary = fread($fileHandle, filesize($actualSource));
                fclose($fileHandle);
            }
        }
        if ($imageBinary !== null) {
            if ($base64) {
                $imageData = chunk_split(base64_encode($imageBinary));
            } else {
                $imageData = chunk_split(bin2hex($imageBinary));
            }
        }

        // Delete temporary file if necessary
        if ($isTemp === true) {
            @unlink($actualSource);
        }

        return $imageData;
    }

    /**
     * Check memory image, supported type, image functions, and proportional width/height
     *
     * @param string $source
     * @throws \PhpOffice\PhpWord\Exception\InvalidImageException
     * @throws \PhpOffice\PhpWord\Exception\UnsupportedImageTypeException
     */
    private function checkImage($source)
    {
        $this->setSourceType($source);

        // Check image data
        if ($this->sourceType == self::SOURCE_ARCHIVE) {
            $imageData = $this->getArchiveImageSize($source);
        } else {
            $imageData = @getimagesize($source);
        }
        if (!is_array($imageData)) {
            throw new InvalidImageException();
        }
        list($actualWidth, $actualHeight, $imageType) = $imageData;

        // Check image type support
        $supportedTypes = array(IMAGETYPE_JPEG, IMAGETYPE_GIF, IMAGETYPE_PNG);
        if ($this->sourceType != self::SOURCE_GD) {
            $supportedTypes = array_merge($supportedTypes, array(IMAGETYPE_BMP, IMAGETYPE_TIFF_II, IMAGETYPE_TIFF_MM));
        }
        if (!in_array($imageType, $supportedTypes)) {
            throw new UnsupportedImageTypeException();
        }

        // Define image functions
        $this->imageType = image_type_to_mime_type($imageType);
        $this->setFunctions();
        $this->setProportionalSize($actualWidth, $actualHeight);
    }

    /**
     * Set source type
     *
     * @param string $source
     */
    private function setSourceType($source)
    {
        if (stripos(strrev($source), strrev('.php')) === 0) {
            $this->memoryImage = true;
            $this->sourceType = self::SOURCE_GD;
        } elseif (strpos($source, 'zip://') !== false) {
            $this->memoryImage = false;
            $this->sourceType = self::SOURCE_ARCHIVE;
        } else {
            $this->memoryImage = (filter_var($source, FILTER_VALIDATE_URL) !== false);
            $this->sourceType = $this->memoryImage ? self::SOURCE_GD : self::SOURCE_LOCAL;
        }
    }

    /**
     * Get image size from archive
     *
     * @param string $source
     * @return array|null
     */
    private function getArchiveImageSize($source)
    {
        $imageData = null;
        $source = substr($source, 6);
        list($zipFilename, $imageFilename) = explode('#', $source);
        $tempFilename = tempnam(sys_get_temp_dir(), 'PHPWordImage');

        $zip = new ZipArchive();
        if ($zip->open($zipFilename) !== false) {
            if ($zip->locateName($imageFilename)) {
                $imageContent = $zip->getFromName($imageFilename);
                if ($imageContent !== false) {
                    file_put_contents($tempFilename, $imageContent);
                    $imageData = @getimagesize($tempFilename);
                    unlink($tempFilename);
                }
            }
            $zip->close();
        }

        return $imageData;
    }

    /**
     * Set image functions and extensions
     */
    private function setFunctions()
    {
        switch ($this->imageType) {
         