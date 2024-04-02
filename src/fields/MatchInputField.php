<?php

namespace born05\matchinput\fields;

use Craft;
use craft\base\ElementInterface;
use craft\fields\PlainText;
use craft\helpers\StringHelper;

class MatchInputField extends PlainText
{
    public static function validateRegex($regex)
    {
        try {
            // preg_match() returns 1 if the pattern matches given subject, 0 if it does not, or FALSE if an error occurred.
            $valid = (preg_match($regex, '') !== false);
        } catch (\Exception $e) {
            $valid = false;
        }

        return $valid;
    }

    // Public Properties
    // =========================================================================

    /**
     * @var string The input’s inputMask text
     */
    public $inputMask;

    /**
     * @var string The input’s errorMessage text
     */
    public $errorMessage;

    // If we don't duplicate the properties of PlainText field here, then they don't get saved
    // =========================================================================

    /**
     * @var string|null The input’s placeholder text
     */
    public ?string $placeholder = null;

    /**
     * @var bool Whether the input should allow line breaks
     */
    public bool $multiline = false;

    /**
     * @var int The minimum number of rows the input should have, if multi-line
     */
    public int $initialRows = 4;

    /**
     * @var int|null The maximum number of characters allowed in the field
     */
    public ?int $charLimit = null;

    // Static Methods
    // =========================================================================

    /**
     * Returns the display name of this class.
     *
     * @return string The display name of this class.
     */
    public static function displayName(): string
    {
        return Craft::t('matchinput', 'Match Input');
    }

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    protected function defineRules(): array
    {
        $rules = parent::defineRules();
        $rules[] = [['inputMask', 'errorMessage'], 'string'];
        $rules[] = ['inputMask', 'required'];
        $rules[] = ['inputMask', 'isValidRegex'];
        return $rules;
    }

    public function isValidRegex($object, $attribute)
    {
        $inputMask = $this->$object;
        if (!self::validateRegex($inputMask))
        {
            $this->addError($object, Craft::t('matchinput', 'Not a valid regex (missing delimiters?)'));
        }
    }

    /**
     * @inheritdoc
     */
    public function getSettingsHtml(): ?string
    {
        return Craft::$app->getView()->renderTemplate(
            'matchinput/_components/fields/settings',
            [
                'field' => $this
            ]
        );
    }

    /**
     * @inheritdoc
     */
    protected function inputHtml(mixed $value, ?ElementInterface $element = null, bool $inline = false): string
    {
        return Craft::$app->getView()->renderTemplate(
            'matchinput/_components/fields/input',
            [
                'name' => $this->handle,
                'value' => $value,
                'field' => $this,
                'placeholder' => $this->placeholder !== null ? Craft::t('site', StringHelper::unescapeShortcodes($this->placeholder)) : null,
                'orientation' => $this->getOrientation($element),
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function getElementValidationRules(): array
    {
        $rules = parent::getElementValidationRules();
        // add our rule
        $rules[] = ['match', 'pattern' => $this->inputMask];
        return $rules;
    }
}
