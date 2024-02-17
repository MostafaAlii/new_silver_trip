<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Http\Resources\Users\CaptionActivityUserResources;
use App\Models\Captain;
use App\Models\CaptionActivity;
use App\Models\CarsCaption;
use App\Models\CarType;
use App\Models\CategoryCar;
use App\Models\Traits\Api\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function Symfony\Component\VarDumper\Dumper\esc;

class CaptionActivityUserController extends Controller
{
    use ApiResponseTrait;


    public function captionActivity(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'latitude' => 'required',
            'longitude' => 'required',
            'status_caption_type' => 'required|in:car,scooter'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors()->first(), 422);
        }

        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $radius = 50;
        $gender = $request->gender == 1 ? 'male' : ($request->gender == 2 ? 'female' : '');
        $categoryCars = $request->category_car_id == 1 ? [1, 2] : [3, 4];


        $carTypes = $request->car_type_id;

        try {
            switch ($request->status_caption_type) {
                case "car":


                    $captains = CaptionActivity::where('status_captain_work', 'active')
                        ->where('status_captain', 'active')
                        ->where('type_captain', 'active')
                        ->where('status_caption_type', 'car')
                        ->selectRaw("*, (6371 * acos(cos(radians($latitude)) * cos(radians(latitude)) * cos(radians(longitude) - radians($longitude)) + sin(radians($latitude)) * sin(radians(latitude)))) AS distance")
                        ->whereRaw("(6371 * acos(cos(radians($latitude)) * cos(radians(latitude)) * cos(radians(longitude) - radians($longitude)) + sin(radians($latitude)) * sin(radians(latitude)))) < $radius");


                    if (!empty($categoryCars)) {
                        $categoryCaptions = CarsCaption::whereIn('category_car_id', $categoryCars)->pluck('captain_id')->toArray();

                        $captains->whereIn('captain_id', $categoryCaptions);

                    }

                    if (!empty($gender)) {
                        $GenderCaptions = Captain::whereIn('gender', [$gender])->pluck('id')->toArray();
                        $captains->whereIn('captain_id', $GenderCaptions);

                    }

                    if (!empty($carTypes)) {
                        $carTypeCaptains = CarsCaption::whereIn('car_type_id', [$carTypes])->pluck('captain_id')->toArray();
                        $captains->whereIn('captain_id', $carTypeCaptains);
                    }

                    if (!empty($categoryCars) && !empty($carTypes)) {
                        $categoryCaptions = CarsCaption::whereIn('category_car_id', $categoryCars)->pluck('captain_id')->toArray();
                        $carTypeCaptains = CarsCaption::whereIn('car_type_id', [$carTypes])->pluck('captain_id')->toArray();
                        $combinedCaptains = array_merge($categoryCaptions, $carTypeCaptains);
                        $captains->whereIn('captain_id', $combinedCaptains);
                    }

                    $captains = $captains->get();
                    $captains = $captains->mapInto(CaptionActivityUserResources::class);
                    return $this->successResponse($captains, 'Data returned successfully');
                    break;

                case "scooter":
                    $captainsScooter = CaptionActivity::where('status_captain_work', 'active')
                        ->where('status_captain', 'active')
                        ->where('type_captain', 'active')
                        ->where('status_caption_type', 'scooter')
                        ->selectRaw("*, (6371 * acos(cos(radians($latitude)) * cos(radians(latitude)) * cos(radians(longitude) - radians($longitude)) + sin(radians($latitude)) * sin(radians(latitude)))) AS distance")
                        ->whereRaw("(6371 * acos(cos(radians($latitude)) * cos(radians(latitude)) * cos(radians(longitude) - radians($longitude)) + sin(radians($latitude)) * sin(radians(latitude)))) < $radius");

                    if (!empty($gender)) {
                        $GenderCaptions = Captain::whereIn('gender', [$gender])->pluck('id')->toArray();
                        $captainsScooter->whereIn('captain_id', $GenderCaptions);
                    }

                    $captainsScooter = $captainsScooter->orderBy('distance')->get();
                    $captainsScooter = $captainsScooter->mapInto(CaptionActivityUserResources::class);

                    return $this->successResponse($captainsScooter, 'Data returned successfully');
                    break;

                default:
                    return $this->errorResponse('Invalid type_caption provided');
                    break;
            }

        } catch (\Exception $exception) {
            return $this->errorResponse('Something went wrong, please try again later');
        }
    }


}
