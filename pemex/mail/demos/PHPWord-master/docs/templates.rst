.. _writersreaders:

Writers & readers
=================

OOXML
-----

The package of OOXML document consists of the following files.

-  \_rels/

   -  .rels

-  docProps/

   -  app.xml
   -  core.xml
   -  custom.xml

-  word/

   -  rels/

      -  document.rels.xml

   -  media/
   -  theme/

      -  theme1.xml

   -  document.xml
   -  fontTable.xml
   -  numbering.xml
   -  settings.xml
   -  styles.xml
   -  webSettings.xml

-  [Content\_Types].xml

OpenDocument
------------

Package
~~~~~~~

The package of OpenDocument document consists of the following files.

-  META-INF/

   -  manifest.xml

-  Pictures/
-  content.xml
-  meta.xml
-  styles.xml

content.xml
~~~~~~~~~~~

The structure of ``content.xml`` is described below.

-  office:document-content

   -  office:font-facedecls
   -  office:automatic-styles
   -  office:body

      -  office:text

         -  draw:\*
         -  office:forms
         -  table:table
         -  text:list
  