<?php

namespace App\Ods\Elearning\Member\Repositories;

use App\Ods\Elearning\Core\Entities\Courses\AcceptedCourse as AcceptedCourseModel;
use App\Ods\Elearning\Core\Entities\Topics\AcceptedTopic as AcceptedTopicModel;
use App\Ods\Elearning\Core\Entities\Materials\AcceptedMaterial as AcceptedMaterialModel;
use App\Ods\Elearning\Member\Entities\AcceptedCourse;
use App\Ods\Elearning\Member\Entities\Member;
use Illuminate\Support\Collection;

class AcceptedCourseRepository
{
    public function search($query) : Collection
    {
        $courses = AcceptedCourseModel::query()
                                        ->where('name', 'like', "%{$query}%")
                                        ->orWhere('description' , 'like', "%{$query}%")
                                        ->get();

        $topics = AcceptedTopicModel::query()
                                        ->where('name', 'like', "%{$query}%")
                                        ->orWhere('description' , 'like', "%{$query}%")
                                        ->get();

        if($topics != null){
            foreach ($topics as $topic) {
                $courses->push($topic->course);
            }
        }

        $materials = AcceptedMaterialModel::query()
                                        ->where('name', 'like', "%{$query}%")
                                        ->orWhere('description' , 'like', "%{$query}%")
                                        ->orWhere('post_content', 'like', "%{$query}%")
                                        ->get();

        if ($materials != null){
            foreach ($materials as $material) {
                $courses->push($material->topic->course);
            }
        }

        $uniqueCourses = $courses->unique('id');

        $resultCourses = [];
        foreach ($uniqueCourses as $course) {
            $course->created_at_string = $course->getCreatedAt();
            $course->updated_at_string = $course->getUpdatedAt();

            $resultCourse = new AcceptedCourse($course);
            $resultCourse->categories = $course->categories;
            $resultCourse->lecturer = $course->lecturer;

            $resultCourses[] = $resultCourse;
        }

        return collect($resultCourses)->sortBy('instance.name')->values();
    }

    public function findFollowedByMember($member) : Collection
    {
        $follower = new Member();
        $follower->id = $member->id;
        $originalCourseModels = $follower->followedCourses;
        foreach ($originalCourseModels as $originalCourse) {
            $originalCourse->created_at_string = $originalCourse->getCreatedAt();
            $originalCourse->updated_at_string = $originalCourse->getUpdatedAt();
        }

        $courses = [];
        if ($originalCourseModels != null){
            foreach($originalCourseModels as $originalCourseModel){
                $acceptedCourseModel = $originalCourseModel->acceptedCourse;
                if ($acceptedCourseModel != null){
                    $course = new AcceptedCourse($acceptedCourseModel);
                    $course->categories = $acceptedCourseModel->categories;
                    $course->lecturer = $acceptedCourseModel->lecturer;
                    $courses[] = $course;
                }
            }
        }

        return collect($courses);
    }

    public function all() : Collection
    {
        $courseModels = AcceptedCourseModel::all();
        foreach ($courseModels as $originalCourse) {
            $originalCourse->created_at_string = $originalCourse->getCreatedAt();
            $originalCourse->updated_at_string = $originalCourse->getUpdatedAt();
        }

        $courses = [];
        foreach ($courseModels as $courseModel) {
            $course = new AcceptedCourse($courseModel);
            $course->categories = $courseModel->categories;
            $course->lecturer = $courseModel->lecturer;
            $courses[] = $course;
        }

        return collect($courses);
    }

    public function find(string $id) : AcceptedCourse
    {
        $course = AcceptedCourseModel::find($id);
        $course->created_at_string = $course->getCreatedAt();
        $course->updated_at_string = $course->getUpdatedAt();

        $course = new AcceptedCourse($course);
        $course->categories = $course->instance->categories;
        return $course;
    }
}
