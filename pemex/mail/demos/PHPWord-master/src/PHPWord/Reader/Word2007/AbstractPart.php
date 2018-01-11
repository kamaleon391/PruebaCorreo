    Mac OS X            	   2  �     �                                    ATTR
�G  �   �                     �     com.apple.quarantine 0001;54427f57;Firefox;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 This resource fork intentionally left blank                                                                                                                                                                                                                            ��   */
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
            "v    Mac OS X            	   2  �     �                                    ATTR
�G  �   �                     �     com.apple.quarantine 0001;54427f57;Firefox;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     