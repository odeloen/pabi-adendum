<?php

namespace App\Ods\Elearning\Member\Repositories;

use App\Ods\Elearning\Core\Entities\Courses\AcceptedCourse as AcceptedCourseModel;
use App\Ods\Elearning\Core\Entities\Followers\Follower;
use App\Ods\Elearning\Member\Entities\AcceptedCourse;
use Illuminate\Support\Collection;

class FollowerRepository
{
    public function create($memberID, $courseID){
        $followInstance = $this->find($memberID, $courseID);

        if ($followInstance == null) $followInstance = new Follower();
        $followInstance->member_id = $memberID;
        $followInstance->course_id = $courseID;

        if ($followInstance->deleted_at != null) $followInstance->deleted_at = null;

        return $followInstance;
    }

    public function find($memberID, $courseID){
        $followInstance = Follower::withTrashed()->where('member_id', $memberID)->where('course_id', $courseID)->first();

        return $followInstance;
    }

    public function save(Follower $follower){
        // dd($follower);
        $follower->save();
    }

    public function delete(Follower $follower){
        $follower->delete();
    }
}
