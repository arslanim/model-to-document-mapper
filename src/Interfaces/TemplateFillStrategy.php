<?php

namespace Arslanim\TemplateMapper\Interfaces;

use PhpOffice\PhpWord\TemplateProcessor;

interface TemplateFillStrategy {
    public function mapObject(TemplateProcessor $template);
}
