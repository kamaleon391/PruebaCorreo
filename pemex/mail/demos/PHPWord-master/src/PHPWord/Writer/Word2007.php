    Mac OS X            	   2  �     �                                    ATTR
��  �   �                     �     com.apple.quarantine 0001;54427f57;Firefox;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 This resource fork intentionally left blank                                                                                                                                                                                                                            ��e);
        // }
        $xmlWriter->writeRaw($value);
        $xmlWriter->endElement(); // meta:user-defined
    }
}
writeNamed(XMLWriter $xmlWriter)
    {
        $styles = Style::getStyles();
        if (count($styles) > 0) {
            foreach ($styles as $style) {
                if ($style->isAuto() === false) {
                    $styleClass = str_replace('\\Style\\', '\\Writer\\ODText\\Style\\', get_class($style));
                    if (class_exists($styleClass)) {
                        /** @var $styleWriter \PhpOffice\PhpWord\Writer\ODText\Style\AbstractStyle Type hint */
                        $styleWriter = new $styleClass($xmlWriter, $style);
                        $styleWriter->write();
                    }
                }
            }
        }
    }
    /**
     * Write page layout styles
     */
    private function writePageLayout(XMLWriter $xmlWriter)
    {
        $xmlWriter->startElement('style:page-layout');
        $xmlWriter->writeAttribute('style:name', 'Mpm1');

        $xmlWriter->startElement('style:page-layout-properties');
        $xmlWriter->writeAttribute('fo:page-width', "21.001cm");
        $xmlWriter->writeAttribute('fo:page-height', '29.7cm');
        $xmlWriter->writeAttribute('style:num-format', '1');
        $xmlWriter->writeAttribute('style:print-orientation', 'portrait');
        $xmlWriter->writeAttribute('fo:margin-top', '2.501cm');
        $xmlWriter->writeAttribute('fo:margin-bottom', '2cm');
        $xmlWriter->writeAttribute('fo:margin-left', '2.501cm');
        $xmlWriter->writeAttribute('fo:margin-right', '2.501cm');
        $xmlWriter->writeAttribute('style:writing-mode', 'lr-tb');
        $xmlWriter->writeAttribute('style:layout-grid-color', '#c0c0c0');
        $xmlWriter->writeAttribute('style:layout-grid-lines', '25199');
        $xmlWriter->writeAttribute('style:layout-grid-base-height', '0.423cm');
        $xmlWriter->writeAttribute('style:layout-grid-ruby-height', '0cm');
        $xmlWriter->writeAttribute('style:layout-grid-mode', 'none');
        $xmlWriter->writeAttribute('style:layout-grid-ruby-below', 'false');
        $xmlWriter->writeAttribute('style:layout-grid-print', 'false');
        $xmlWriter->writeAttribute('style:layout-grid-display', 'false');
        $xmlWriter->writeAttribute('style:layout-grid-base-width', '0.37cm');
        $xmlWriter->writeAttribute('style:layout-grid-snap-to', 'true');
        $xmlWriter->writeAttribute('style:footnote-max-height', '0cm');

        $xmlWriter->startElement('style:footnote-sep');
        $xmlWriter->writeAttribute('style:width', '0.018cm');
        $xmlWriter->writeAttribute('style:line-style', 'solid');
        $xmlWriter->writeAttribute('style:adjustment', 'left');
        $xmlWriter->writeAttribute('style:rel-width', '25%');
        $xmlWriter->writeAttribute('style:color', '#000000');
        $xmlWriter->endElement(); //style:footnote-sep

        $xmlWriter->endElement(); // style:page-layout-properties


        $xmlWriter->startElement('style:header-style');
        $xmlWriter->endElement(); // style:header-style

        $xmlWriter->startElement('style:footer-style');
        $xmlWriter->endElement(); // style:footer-style

        $xmlWriter->endElement(); // style:page-layout
    }
    /**
     * Write master style
     */
    private function writeMaster(XMLWriter $xmlWriter)
    {
        $xmlWriter->startElement('office:master-styles');

        $xmlWriter->startElement('style:master-page');
        $xmlWriter->writeAttribute('style:name', 'Standard');
        $xmlWriter->writeAttribute('style:page-layout-name', 'Mpm1');
        $xmlWriter->endElement(); // style:master-page

        $xmlWriter->endElement(); // office:master-styles
    }
}
tyle::getStyle($style);
                }
                $style->setStyleName($element->getElementId());
                $this->autoStyles['Table'][] = $style;
            }
        }
    }

    /**
     * Get style of individual element
     *
     * @param \PhpOffice\PhpWord\Element\Text $element
     * @param int $paragraphStyleCount
     * @param int $fontStyleCount
     */
    private function getElementStyle(&$element, &$paragraphStyleCount, &$fontStyleCount)
    {
        $fontStyle = $element->getFontStyle();
        $paragraphStyle = $element->getParagraphStyle();
        $phpWord = $this->getParentWriter()->getPhpWord();

        // Font
        if ($fontStyle instanceof Font) {
            $fontStyleCount++;
            $style = $phpWord->addFontStyle("T{$fontStyleCount}", $fontStyle);
            $style->setAuto();
            $element->setFontStyle("T{$fontStyleCount}");

        // Paragraph
        } elseif ($paragraphStyle instanceof Paragraph) {
            $paragraphStyleCount++;
            $style = $phpWord->addParagraphStyle("P{$paragraphStyleCount}", array());
            $style->setAuto();
            $element->setParagraphStyle("P{$paragraphStyleCount}");
        }
    }
}
, strrev('.php')) === 0) {
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
        list($zipFilena