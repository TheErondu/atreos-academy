<?php

namespace App\DTOs;

class NotificationDetails
{
    public $title;
    public $body;
    public $CTAButtonText;
    public $CTAButtonUrl;
    public $footerText;

    public function __construct($title, $body, $CTAButtonText, $CTAButtonUrl, $footerText)
    {
        $this->title = $title;
        $this->body = $body;
        $this->CTAButtonText = $CTAButtonText;
        $this->CTAButtonUrl = $CTAButtonUrl;
        $this->footerText = $footerText;
    }
}
