<?php
// app/DTO/ProgressDTO.php

namespace App\DTOs;

class ProgressDTO
{
    public $lessonId;
    public $startDate;
    public $completedDate;

    public function __construct($lessonId, $startDate, $completedDate)
    {
        $this->lessonId = $lessonId;
        $this->startDate = $startDate;
        $this->completedDate = $completedDate;
    }

    /**
     * Convert the DTO to JSON.
     *
     * @return string
     */
    public function toJson()
    {
        return json_encode([
            'lessonId' => $this->lessonId,
            'startDate' => $this->startDate,
            'completedDate' => $this->completedDate,
        ]);
    }
}
