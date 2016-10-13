<?php

namespace Arslanim\TemplateMapper;

use PhpOffice\PhpWord\TemplateProcessor;
use Arslanim\TemplateMapper\Interfaces\TemplateFillStrategy;

class DocumentMapper {

	/**
     * PhpWord's template processor.
     *
     * @var TemplateProcessor
     */
	protected $template;

	/**
     * Objects, that attributes need to be mapped on Word template.
     *
     * @var array
     */
	protected $objects = [];

	/**
     * Create a new document instance.
     *
     * @param TemplateProcessor $templateProcessor
     * @param array $fillObjects
     */
	public function __construct(TemplateProcessor $template, $objects = []) {
		
		$this->template = $template;

		foreach ($objects as $key => $object) {
			if (!$this->checkObjectImplementation(class_implements($object))) {
				throw new \InvalidArgumentException("Class [" . get_class($object) . "] must implement TemplateFillStrategy interface.");
			}
		}
		$this->objects = $objects;
	}
	
	public function getTemplate() {
		return $this->template;
	}
    
	public function setTemplate($template) {
		$this->template = $template;
	}

	public function getObjects() {
		return $this->objects;
	}
    
	public function setObjects($objects) {
		$this->objects = $objects;
	}

	public function mapObjects() {
		foreach ($this->objects as $object) {
			$this->template = $object->mapObject($this->template);
		}

		return $this->template;
	}

	protected function checkObjectImplementation($interfaces) {
		foreach ($interfaces as $key => $value) {
			if ($value === "Arslanim\TemplateMapper\Interfaces\TemplateFillStrategy") return true;
		}
	}
}
