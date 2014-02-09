<?php

// Security Check
if (!defined('MESA')) { die( 'wallhax' ); }

class MesaPage {

	public $content;
	public $excerpt;
	public $permalink;

	public $plainText;
	public $pageMeta;
	public $pageContent;

	/**
	 * Instantiate Page Object
	 *
	 * Set up the ID and Type of the Page Object using the file
	 * that gets passed in. We shouldn't need the file path after
	 * this so no need to save it directly. We can always reconstruct
	 * it later from these pieces.
	 * 
	 * @param string $file Path to file contents.
	 */
	public function __construct($file = '') {
		$this->id = pathinfo($file, PATHINFO_FILENAME);
		$this->type = basename(pathinfo($file, PATHINFO_DIRNAME));
		
		if (file_exists($file)) {
			$this->plainText = file_get_contents($file);
		}
	}

	/**
	 * Setup Page Content
	 *
	 * Helper method to delay content setup until absolutely necessary.
	 *
	 * TODO: Add methods that try to suss out Date and Title if JSON object
	 * is not set.
	 */
	public function setup() {
		$this->parsePageMeta();
		$this->setupPageData();
		$this->formatPageContent();
		$this->formatPageExcerpt();
		$this->formatPageDate();
		$this->createPermalink();
	}

	/**
	 * Parse Out JSON from Content
	 *
	 * This parses out the JSON object from the file and sets the appropriate
	 * raw variables. Right now these are public variables, but could be private
	 * down the line.
	 *
	 * TODO: Improve parsing so that no delimiter is required, and JSON object
	 * can appear at beginning or end of file.
	 */
	public function parsePageMeta() {
		$pieces = array_map('trim', explode("---", $this->plainText));

		// Do we need to check for JSON?
		if ( count($pieces) < 2 ) {
			$this->pageContent = $pieces[0];
		} else if ('{' === substr($pieces[0], 0, 1) && '}' === substr($pieces[0], -1, 1) ) {
			// JSON exists, set it as the page meta
			$this->pageMeta = json_decode($pieces[0], true);
			$this->pageContent = $pieces[1];
		} else {
			// Fail safely and just use the plaintext as page content
			$this->pageContent = $this->plainText;
		}
	}

	/**
	 * Convert JSON Object to Attributes
	 */
	public function setupPageData() {
		if ( isset($this->pageMeta) && is_array($this->pageMeta) ) {
			foreach ($this->pageMeta as $key => $value) {
				$this->$key = $value;
			}
		}
	}

	/**
	 * Parse Markdown from Page Content
	 */
	public function formatPageContent() {
		$this->content = Parsedown::instance()->parse($this->pageContent);
	}

	/**
	 * Create an Excerpt
	 *
	 * TODO: This uses magic numbers; we need to move these into the config
	 * file for the site, and then figure out how to access them inside
	 * classes.
	 */
	public function formatPageExcerpt() {
		if ( !$this->excerpt ) {
			$excerpt = strip_tags($this->content);
			$excerptWords = explode(' ', $excerpt);
			$this->excerpt = implode(' ', array_slice($excerptWords, 0, 80)) . '&hellip;';
		}
	}

	/**
	 * Guess Date from File Name
	 *
	 * Try to guess the date from the filename by filtering out anything
	 * but numbers, and truncating that to the maximum date length. This
	 * is remarkably bad at actually working, but it's a start.
	 *
	 * TODO: We need a setting as to whether or not users want this kind
	 * of guesswork to be done.
	 */
	public function formatPageDate() {
		if ( !$this->date ) {
			$dateString = filter_var($this->id, FILTER_SANITIZE_NUMBER_INT);
			$dateString = substr($dateString, 0, 8);
			$this->date = date('Y-m-d', strtotime($dateString));
		}
	}

	/**
	 * Build Permalink for Post
	 */
	public function createPermalink() {
		$this->permalink = SITEURL . '?id=' . $this->id . '&' . 'type=' . $this->type;
	}
}