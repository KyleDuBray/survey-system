<?php

class Question
{
    public $text;
    public $response_type;
    public $options;
    public function __construct($text, $response_type)
    {
        $this->text = $text;
        $this->$response_type = $response_type;
    }

    public function addOption($option_text)
    {
        if ($this->response_type === "multiple-choice") {
            array_push($options, $option_text);
        } else {
            echo '<p class="error">Error- invalid option addition to response type.</p>';
        }
    }
}