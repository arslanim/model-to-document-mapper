<?php

namespace Arslanim\TemplateMapper\Document;

use PhpOffice\PhpWord\TemplateProcessor;
use Arslanim\TemplateMapper\Interfaces\TemplateFillStrategy;

class Document {

	/**
     * PhpWord's template processor.
     *
     * @var TemplateProcessor
     */
	protected $templateProcessor = null;

	/**
     * Objects, that attributes need to be mapped on Word template.
     *
     * @var array
     */
	protected $fillObjects = [];

	/**
     * Create a new document instance.
     *
     * @param TemplateProcessor $templateProcessor
     * @param array $fillObjects
     */
	public function __construct(TemplateProcessor $templateProcessor, $fillObjects = []) {
		
		$this->templateProcessor = $templateProcessor;

		foreach ($fillObjects as $key => $value) {
			if (!$this->checkFillObjectImplementation(class_implements($value))) {
				throw new \InvalidArgumentException("Class [" . get_class($value) . "] must implement TemplateFillStrategy interface.");
			}
		}
		$this->fillObjects = $fillObjects;
	}
	
	public function getTemplateProcessor() {
		return $this->templateProcessor;
	}
	public function setTemplateProcessor($templateProcessor) {
		$this->templateProcessor = $templateProcessor;
	}

	public function getFillObjects() {
		return $this->fillObjects;
	}
	public function setFillObjects($fillObjects) {
		$this->fillObjects = $fillObjects;
	}

	public function fillTemplate() {
		foreach ($this->fillObjects as $fillObject) {
			$this->templateProcessor = $fillObject->fillTemplatePart($this->templateProcessor);
		}

		return $this->templateProcessor;
	}

	protected function checkFillObjectImplementation($interfaces) {
		foreach ($interfaces as $key => $value) {
			if ($value === "Arslanim\TemplateMapper\Interfaces\TemplateFillStrategy") return true;
		}
	}
}
