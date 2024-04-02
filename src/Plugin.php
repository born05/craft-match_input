<?php

namespace born05\matchinput;

use craft\services\Fields;
use craft\events\RegisterComponentTypesEvent;
use yii\base\Event;
use born05\matchinput\fields\MatchInputField;

/**
 *
 * @author    Marion Newlevant
 * @package   MatchInput
 * @since     1.0.0
 */
class Plugin extends \craft\base\Plugin
{

    // Public Methods
    // =========================================================================

    /**
     * Called after the plugin class is instantiated; do any one-time initialization
     * here such as hooks and events.
     *
     * If you have a '/vendor/autoload.php' file, it will be loaded for you automatically;
     * you do not need to load it in your init() method.
     *
     */
    public function init()
    {
        parent::init();

        // Register our fields
        Event::on(
            Fields::class,
            Fields::EVENT_REGISTER_FIELD_TYPES,
            function (RegisterComponentTypesEvent $event) {
                $event->types[] = MatchInputField::class;
            }
        );
    }
}
