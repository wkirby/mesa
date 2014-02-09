<?php

// Security Check
if (!defined('MESA')) { die( 'wallhax' ); }

class MesaQuery {
    public $query;
    public $pages;

    public $type;
    public $id;
    public $isSingle = false;

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
            $this->id = $this->query['id'];
            $this->isSingle = true;
        }
    }

    /**
     * Get Files By Query
     * 
     * Retrieve files based on query.
     */
    public function getQuery() {
        $path = trailingslash(CONTENTDIR . $this->type);

        if(!is_dir($path)) {
            $this->is_404 = true;
            return;
        }

        if ( $handle = opendir($path) ) {
            while ( false !== ($currentFile = readdir($handle)) ) { 

                $isExemptFile = in_array( strtolower($currentFile), $this->exemptFilesArray );
                $isValidFileType = in_array( pathinfo($currentFile, PATHINFO_EXTENSION), $this->validFileTypes );

                if ( !$isExemptFile && $isValidFileType ) {
                    
                    // Retrieve All Files, unless Specific ID Query is set
                    // then retrieve single page, with id matching the PATHINFO

                    if ( !$this->isSingle ) {
                        $this->pages[] = new MesaPage($path . $currentFile);
                        continue;
                    } else if ( $this->query['id'] === pathinfo($currentFile, PATHINFO_FILENAME) ) {
                        $this->pages[] = new MesaPage($path . $currentFile);
                        break;
                    }
                } 
            }
        }

        closedir($handle);
    }

    public function hasPages() {
        return ($this->pages > 0);
    }

    public function filterQuery($key, $value) {

    }
}