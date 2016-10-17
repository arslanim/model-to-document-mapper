# Helps map model of business logic to MS Word template

Extension provides business logic models mapping to MS Word template.

## Installation

```
composer require arslanim/model-to-document-mapper
```
Extension requires:

```
"phpoffice/phpword": "0.13.0"
```

##Preamble

Developing complex ARM's there was obligatoriness to print some models of business logic in document, MS Word for example. And I collided with some broblems: what I can use for printing my model and how can I organize my code. First question was solved by using awesome phpoffice extension. It provides TemplateProcessor class for inserting some values in prepared template. Greate! Then a started to think -> how organize code. First try was not enought pretty: I just get model from DB and set templated values with models attr just in my controller (by the way, most of my projects working on Yii2 framework). That was good enought for a small number of models and small number of attrs. But what gonna happened if there is many models with large list of attributes? Yii controller will be trashed with tones of 
```
$templateProcessor->setValue('template_mark', 'value')
```
Well that is not good for me. So I decided to shift all templating work on model class and wrote extension, that provides this.

##Usage
