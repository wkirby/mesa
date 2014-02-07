<?php

// Security Check
if (!defined('MESA')) { die( 'wallhax' ); }

class MesaQuery {
    public $query;
    public $pages;

    public $type;
    public $id;
    public $is_single = false;

    private $exemptFilesArray = array('.', '..', '.ds_store', '.thumbs', '.svn', '.git');
    private $validFileTypes = array('md', 'txt');

    /**
     * Set Queries on Construct and Run Init
     */
    public function __construct($query) {
        if ( !empty($query) ) {
            $this->query = $query;
        }

        $this->init();
    }

    /**
     * Init Query
     */
    public function init() {
        $this->parseQuery();
        $this->getQuery();
    }

    /**
     * Parse Query and Set Defaults
     */
    public function parseQuery() {
        // TODO: Add check to make sure it's a valid type
        if ( isset($this->query['type']) && !empty($this->query['type']) ) {
            $this->type = $this->query['type'];
        } else {
            $this->type = 'posts';
        }

        if ( !empty($this->query['id']) ) {
            $this->is_single = true;
        }
    }

    /**
     * Get Files By Query
     * 
     * Retrieve files based on query.
     */
    public function getQuery() {
        $path = trailingslash(CONTENTDIR . $this->type);
        $handle = opendir($path);

        while ( false !== ($currentFile = readdir($handle)) ) { 

            $isExemptFile = in_array( strtolower($currentFile), $this->exemptFilesArray );
            $isValidFileType = in_array( pathinfo($currentFile, PATHINFO_EXTENSION), $this->validFileTypes );

            if ( !$isExemptFile && $isValidFileType ) {
                
                // Retrieve All Files, unless Specific ID Query is set
                // then retrieve single page, with id matching the PATHINFO

                if ( !$this->is_single ) {
                    $this->pages[] = new MesaPage($path . $currentFile);
                    continue;
                } else if ( $this->query['id'] === pathinfo($currentFile, PATHINFO_FILENAME) ) {
                    $this->pages[] = new MesaPage($path . $currentFile);
                    break;
                }
            } 
        }

        closedir($handle);
    }

    public function filterQuery($key, $value) {

    }
}