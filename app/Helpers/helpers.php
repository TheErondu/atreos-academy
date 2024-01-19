<?php

use App\Helpers\UserEnrollmentData;

function enrollmentData($enrollment, $lesson=null)
{
    return app(UserEnrollmentData::class)->enrollmentData($enrollment, $lesson);
}
