<?php

namespace App\Http\Controllers\Api\Setting\New;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\New\CountryResource;
use App\Models\Traits\Api\ApiResponseTrait;

class CountryController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        try {
            return $this->successResponse(CountryResource::collection(Country::active()), 'data Return Successfully');
        } catch (\Exception $exception) {
            return  $this->errorResponse('Something went wrong, please try again later');
        }
    }

    public function show($id)
    {
        try {
            return $this->successResponse(new CountryResource(Country::findorfail($id)), 'data Return Successfully');
        } catch (\Exception $exception) {
            return $this->errorResponse('Something went wrong, please try again later');
        }
    }
}