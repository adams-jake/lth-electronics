<?php

class Image {

	public int $id = -1;
	public string $src = "";
	public string $srcset = "";
	public string $sizes = "100vw";
	public string $width = "";
	public string $height = "";
	public string $alt = "";
	public string $description = "";
	public string $caption = "";
	public string $mimetype = "";
	public string $x = "";
	public string $y = "";
	public string $focalpoint = "";
	public string $style = "";
	public array $sources = [];

	public function __construct($input) {
		$fields = is_numeric($input) ? acf_get_attachment($input) : $input;
		$this->id = $fields['ID'] ?? -1;
		$this->src = $fields['url'] ?? "";
		$this->srcset = wp_get_attachment_image_srcset($this->id) ?: "";
		$this->sizes = "100vw";
		$this->width = $fields['width'] ?? "";
		$this->height = $fields['height'] ?? "";
		$this->alt = $fields['alt'] ?? "";
		$this->description = $fields['description'] ?? "";
		$this->caption = $fields['caption'] ?? "";
		$this->mimetype = $fields['mime_type'] ?? "";
		$this->x = $fields['x'] ?? get_post_meta($this->id, "x", true) ?? "";
		$this->y = $fields['y'] ?? get_post_meta($this->id, "y", true) ?? "";
		$this->focalpoint = (is_numeric($this->x) && is_numeric($this->y)) ? "{$this->x}% {$this->y}%" : "";
		$this->style = $this->focalpoint ? "object-position:{$this->focalpoint};" : "";
		$this->sources = Image::sources($this->id);
	}

	public function hasImage() {
		return !!$this->src;
	}

	public function url(string $name = 'large') {
		return Image::sources($this->id)[$name]['url'] ?? "";
	}

	public function width(string $name = 'large') {
		return Image::sources($this->id)[$name]['width'] ?? "";
	}

	public function height(string $name = 'large') {
		return Image::sources($this->id)[$name]['height'] ?? "";
	}

	public static function sources(int $id) {
		static $cache;
		if (isset($cache[$id])) return $cache[$id];
		if (!$meta = wp_get_attachment_metadata($id)) return [];
		$sources = [];
		foreach (get_intermediate_image_sizes() as $size) {
			if ($source = wp_get_attachment_image_src($id, $size)) {
				$uncropped = wp_image_matches_ratio($source[1], $source[2], $meta['width'], $meta['height']);
				if (!$uncropped) continue; 
				$sources[$size] = [
					'url' => (string) $source[0],
					'size' => (string) $size,
					'width' => (int) $source[1], 
					'height' => (int) $source[2]
				];
			}
		}
		return $cache[$id] = $sources;
	}

	public static function base64(string $imagePath) {
		$image = @file_get_contents($imagePath);
		if (!$image) return "";
		return "data:" . mime_content_type($imagePath) . ";charset=utf-8;base64," . base64_encode($image);
	}

	public static function featured(int $id) {
		global $post;
	    if (!$id && $post) $id = get_post_thumbnail_id($post->ID);
	    return new Image($id);
	}
}
