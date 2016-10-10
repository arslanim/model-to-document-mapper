<?php

namespace Arslanim\TemplateMapper\Document;

class Document {
	public $templateProcessor = null;
	public $fillObjects = [];

	public function __construct($templateProcessor = null, $fillObjects = []) {
		$this->templateProcessor = $templateProcessor;
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
}
