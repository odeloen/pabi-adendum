<?php

namespace App\Ods\Elearning\Member\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ods\Core\Entities\Alert;
use App\Ods\Core\Requests\UseCaseRequest;
use App\Ods\Elearning\Member\Repositories\AcceptedCourseRepository;
use App\Ods\Elearning\Member\Usecases\SearchCourseUseCase;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ResourceController extends Controller
{
    public function courseImage($courseID){
        $courseRepository = new AcceptedCourseRepository;

        $course = $courseRepository->find($courseID);

        $picturePath = $course->instance->picture_path;

        if ($picturePath == null){
            $path = public_path('template/global_assets/images/placeholders/placeholder.jpg');
        } else {
            $path = storage_path('images/' . $picturePath);
        }

        if(!File::exists($path)) {
            return response()->json(['message' => 'Image not found.'], 404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }
}
