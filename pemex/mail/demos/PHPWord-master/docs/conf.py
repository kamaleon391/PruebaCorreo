    Mac OS X            	   2  �     �                                    ATTR
�#  �   �                     �     com.apple.quarantine 0001;54427f57;Firefox;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 This resource fork intentionally left blank                                                                                                                                                                                                                            ��Writer\Word2007\Part\DocPropsApp`
- `Element\Title::getBookmarkId()` replaced by `Element\Title::getRelationId()`
- `Writer\HTML::writeDocument`: Replaced by `Writer\HTML::getContent`

### Miscellaneous

- License: Change the project license from LGPL 2.1 into LGPL 3.0 - GH-211
- Word2007 Writer: New `Style\Image` class - @ivanlanin
- Refactor: Replace static classes `Footnotes`, `Endnotes`, and `TOC` with `Collections` - @ivanlanin GH-206
- QA: Reactivate `phpcpd` and `phpmd` on Travis - @ivanlanin
- Refactor: PHPMD recommendation: Change all `get...` method that returns `boolean` into `is...` or `has...` - @ivanlanin
- Docs: Create gh-pages branch for API documentation - @Progi1984 GH-154
- QA: Add `.scrutinizer.yml` and include `composer.lock` for preparation to Scrutinizer - @ivanlanin GH-186
- Writer: Refactor writer parts using composite pattern - @ivanlanin
- Docs: Show code quality and test code coverage badge on README
- Style: Change behaviour of `set...` function of boolean properties; when none is defined, assumed true - @ivanlanin
- Shared: Unify PHP ZipArchive and PCLZip features into PhpWord ZipArchive - @ivanlanin
- Docs: Create VERSION file - @ivanlanin
- QA: Improve dan update requirement check in `samples` folder - @ivanlanin


## 0.10.1 - 21 May 2014

This is a bugfix release for `php-zip` requirement in Composer.

- Change Composer requirements for php-zip from `require` to `suggest` - @bskrtich GH-246

## 0.10.0 - 4 May 2014

This release marked heavy refactorings on internal code structure with the creation of some abstract classes to reduce code duplication. `Element` subnamespace is introduced in this release to replace `Section`. Word2007 reader capability is greatly enhanced. Endnote is introduced. List numbering is now customizable. Basic HTML and PDF writing support is enabled. Basic ODText reader is introduced.

### Features

- Image: Get image dimensions without EXIF extension - @andrew-kzoo GH-184
- Table: Add `tblGrid` element for Libre/Open Office table sizing - @gianis6 GH-183
- Footnote: Ability to insert textbreak in footnote `$footnote->addTextBreak()` - @ivanlanin
- Footnote: Ability to style footnote reference mark by using `FootnoteReference` style - @ivanlanin
- Font: Add `bgColor` to font style to define background using HEX color - @jcarignan GH-168
- Table: Add `exactHeight` to row style to define whether row height should be exact or atLeast - @jcarignan GH-168
- Element: New `CheckBox` element for sections and table cells - @ozilion GH-156
- Settings: Ability to use PCLZip as alternative to ZipArchive - @bskrtich @ivanlanin GH-106 GH-140 GH-185
- Template: Ability to find & replace variables in headers & footers - @dgudgeon GH-190
- Template: Ability to clone & delete block of text using `cloneBlock` and `deleteBlock` - @diego-vieira GH-191
- TOC: Ability to have two or more TOC in one document and to set min and max depth for TOC - @Pyreweb GH-189
- Table: Ability to add footnote in table cell - @ivanlanin GH-187
- Footnote: Ability to add image in footnote - @ivanlanin GH-187
- ListItem: Ability to add list item in header/footer - @ivanlanin GH-187
- CheckBox: Ability to add checkbox in header/footer - @ivanlanin GH-187
- Link: Ability to add link in header/footer - @ivanlanin GH-187
- Object: Ability to add object in header, footer, textrun, and footnote - @ivanlanin GH-187
- Media: Add `Media::resetElements()` to reset all media data - @juzi GH-19
- General: Add `Style::resetStyles()` - @ivanlanin GH-187
- DOCX Reader: Ability to read header, footer, footnotes, link, preservetext, textbreak, pagebreak, table, list, image, and title - @ivanlanin
- Endnote: Ability to add endnotes - @ivanlanin
- ListItem: Ability to create custom list and reset list number - @ivanlanin GH-10 GH-198
- ODT Writer: Basic table writing support - @ivanlanin
- Image: Keep image aspect ratio if only 1 dimension styled - @japonicus GH-194
- HTML Writer: Basic HTML writer: text, textrun, link, title, textbreak, table, image (as Base64), footnote, endnote - @ivanlanin GH-203 GH-67 GH-147
- PDF Writer: Basic PDF writer using DomPDF: All HTML element except image - @ivanlanin GH-68
- DOCX Writer: Change `docProps/app.xml` `Application` to `PHPWord` - @ivanlanin
- DOCX Writer: Create `word/settings.xml` and `word/webSettings.xml` dynamically - @ivanlanin
- ODT Writer: Basic image writing - @ivanlanin
- ODT Writer: Link writing - @ivanlanin
- ODT Reader: Basic ODText Reader - @ivanlanin GH-71
- Section: Ability to define gutter and line numbering - @ivanlanin
- Font: Small caps, all caps, and double strikethrough - @ivanlanin GH-151
- Settings: Ability to use measurement unit other than twips with `setMeasurementUnit` - @ivanlanin GH-199
- Style: Remove `bgColor` from `Font`, `Table`, and `Cell` and put it into the new `Shading` style - @ivanlanin
- Style: New `Indentation` and `Spacing` style - @ivanlanin
- Paragraph: Ability to define first line and right indentation - @ivanlanin

### Bugfixes

- Footnote: Footnote content doesn'