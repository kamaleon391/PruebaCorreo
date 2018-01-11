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

namespace PhpOffice\PhpWord\Reader;

/**
 * Reader interface
 *
 * @since 0.8.0
 */
interface ReaderInterface
{
    /**
     * Can the current ReaderInterface read the file?
     *
     * @param  string $filename
     * @return boolean
     */
    public function canRead($filename);

    /**
     * Loads PhpWord from file
     *
     * @param string $filename
     */
    public function load($filename);
}
mFromZip($this->docFile, $this->xmlFile);

        $nodes = $xmlReader->getElements('office:body/office:text/*');
        if ($nodes->length > 0) {
            $section = $phpWord->addSection();
            foreach ($nodes as $node) {
                // $styleName = $xmlReader->getAttribute('text:style-name', $node);
                switch ($node->nodeName) {

                    case 'text:h': // Heading
                        $depth = $xmlReader->getAttribute('text:outline-level', $node);
                        $section->addTitle($node->nodeValue, $depth);
                        break;

                    case 'text:p': // Paragraph
                        $section->addText($node->nodeValue);
                        break;

                    case 'text:list': // List
                        $listItems = $xmlReader->getElements('text:list-item/text:p', $node);
                        foreach ($listItems as $listItem) {
                            // $listStyleName = $xmlReader->getAttribute('text:style-name', $listItem);
                            $section->addListItem($listItem->nodeValue);
                        }
                        break;
                }
            }
        }
    }
}
      $rels = array();
        $xmlFile = 'META-INF/manifest.xml';
        $xmlReader = new XMLReader();
        $xmlReader->getDomFromZip($docFile, $xmlFile);
        $nodes = $xmlReader->getElements('manifest:file-entry');
        foreach ($nodes as $node) {
            $type = $xmlReader->getAttribute('manifest:media-type', $node);
            $target = $xmlReader->getAttribute('manifest:full-path', $node);
            $rels[] = array('type' => $type, 'target' => $target);
        }

        return $rels;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               This resource fork intentionally left blank                                                                                                                                                                                                                            ��imiter found: Parse buffered control
                        if ($this->isFirst) {
                            $this->isFirst = false;
                        } else {
                            if ($char == ' ') { // Discard space as a control word delimiter
                                $this->flushControl(true);
                            }
                        }
                    }
                }
            }
            $this->offset++;
        }
        $this->flushText();
    }

    /**
     * Mark opening braket `{` character
     */
    private function markOpening()
    {
        $this->flush(true);
        array_push($this->groups, $this->flags);
    }

    /**
     * Mark closing braket `}` character
     */
    private function markClosing()
    {
        $this->flush(true);
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
     * @param bool $isContr