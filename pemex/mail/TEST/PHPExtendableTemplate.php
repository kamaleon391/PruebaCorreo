<?php
## ####################################### ##
##                                         ##
##  ------ PHPExtendableTemplate -------   ##
##                                         ##
##  Extendable class for render dinamic    ##
##  data for PHP 4 y PHP 5                 ##
##                                         ##
##  @version                               ##
##  1 (30.03.2011)                         ##
##                                         ##
##  @author                                ##
##  Eugenia Bahit                          ##
##  http://eugeniabahit.blogspot.com/      ##
##                                         ##
##  @licence                               ##
##  LGPL                                   ##
##                                         ##
## ####################################### ##

/*
    (ES) Información completa sobre esta librería en
    (EN) Complete info about this library (in spanish only) at
    http://eugeniabahit.blogspot.com/search/label/PHPTemplate
*/

class PHPExtendableTemplate {

    // set from here *************************
    const DEFAULT_TEMPLATE_FOLDER = 'site_media/html/';
    const DEFAULT_TEMPLATE = 'base_template.html';
    // to here *******************************
    public $content; // your rendering template content

    # get file content
    protected function get_file($file='', $folder='') {
        if(!$file) $file = PHPExtendableTemplate::DEFAULT_TEMPLATE;
        if(!$folder) $folder = PHPExtendableTemplate::DEFAULT_TEMPLATE_FOLDER;
        $path = $folder.$file;
        $template_html = file_get_contents($path);
        return $template_html;
    }

    # render simple data
    protected function render_data($dict=array(), $content='') {
        $rendering_data = $content;
        foreach($dict as $search=>$replace) {
            if(!is_array($replace)) {
                $rendering_data = str_replace("{$search}", $replace, $rendering_data);
            }
        }
        return $rendering_data;
    }

    # render complex data (loop data)
    public function render_loop_data($loop='', $content='', $data=array()) {
        // make tags
        if($loop) {
            $ini_tag = '<!--iniloop:'.$loop.'-->';
            $end_tag = '<!--endloop:'.$loop.'-->';
        }
        // count ini_tag chars
        $ini_tag_chars = strlen($ini_tag);
        // search tags in content
        $found_ini_tag = strpos($content, $ini_tag);
        $found_end_tag = strpos($content, $end_tag);
        // get pattern loop
        $from = $found_ini_tag+$ini_tag_chars;
        $to = $found_end_tag-1;
        $length = $to-$from;
        $pattern = substr($content, $from, $length);
        // render loop
        $rendering_loop = '';
        for($i=0;$i<count($data);$i++) {
            foreach($data[$i] as $search=>$replace) {
                $dict[$search] = $replace;
            }
            $rendering_loop .= $this->render_data($dict, $pattern);
        }
        $rendering_loop_data = str_replace($pattern, $rendering_loop, $content);
        return $rendering_loop_data;
    }

    # get simple content
    public function get_content($dict=array(), $file='', $folder='') {
        $content = $this->get_file($file, $folder);
        $this->content = $this->render_data($dict, $content);
        return $this->content;
    }

    # get loop content
    public function get_loop_content($data_loop=array(), $dict=array(), 
                                     $file='', $folder='') {
        $content = $this->get_content($dict, $file, $folder);
        foreach($data_loop as $loop=>$data) {
            $content = $this->render_loop_data($loop, $content, $data);
        }
        return $content;
    }
}
?>