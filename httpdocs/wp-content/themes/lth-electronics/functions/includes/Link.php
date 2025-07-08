<?php

class Link {

	public $href = '';
	public $target = '';
	public $text = '';
	public $attributes = '';

	public function __construct($fields) {
		$href = $fields['url'] ?? '';
		$target = $fields['target'] ?? null;
		$this->href = $href;
		$this->text = $fields['title'] ?? '';
		$this->target = "target='$target'";
		$this->attributes = $target 
			? "href=\"{$href}\" target=\"{$target}\" rel=\"noopener\""
			: "href=\"{$href}\"";
	}

	public function hasLink() {
		return (!!$this->href);
	}

	public function isExternal() {
		return $this->target !== "";
	}
}