<?php

use Zend\I18n\Translator\Loader\LoaderInterface;
use Zend\I18n\Translator\TextDomain;

class DictionaryLoader implements LoaderInterface
{

    public function load($filename, $locale)
    {
        $textDomain = new TextDomain();

        $messages = [

        ];

        foreach ($messages as $message) {
            if (isset($textDomain[$message['message_key']])) {
                if (!is_array($textDomain[$message['message_key']])) {
                    $textDomain[$message['message_key']] = array(
                        $message['message_plural_index'] => $textDomain[$message['message_key']]
                    );
                }

                $textDomain[$message['message_key']][$message['message_plural_index']]
                    = $message['message_translation'];
            } else {
                $textDomain[$message['message_key']] = $message['message_translation'];
            }
        }

        return $textDomain;
    }
}