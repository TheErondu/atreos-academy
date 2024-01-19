<?php
namespace App\Helpers;

use App\Models\Enrollment;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Collection;

class UserEnrollmentData
{
    static function enrollmentData(Enrollment $enrollment, Lesson $lesson=null)
    {

        $lessonsList = $enrollment->progress->toArray();
        $enrollmentCollection = new Collection($lessonsList);
        if($lesson!==null){
            $lessonIndex = array_search($lesson->id, array_column($lessonsList, 'lessonId'));
            $lessonData = $lessonsList[$lessonIndex];
        }
        $allLessonsCompleted = $enrollmentCollection->every(function ($item) {
            return !is_null($item['completedDate']);
        });
        $enrollmentData = (object) array(
            'lessonsList' => (object)$lessonsList,
            'lessonData' => $lesson!==null?(object)$lessonData:null,
            'allLessonsCompleted' => $allLessonsCompleted,
        );
        return $enrollmentData;
    }
}
