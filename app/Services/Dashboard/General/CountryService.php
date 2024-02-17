<?php
namespace App\Services\Dashboard\General;
use App\Models\Country;
class CountryService {
    public function updateStatus($countryId, $status, $name) {
        $country = Country::findOrFail($countryId);
        $country->status = $status;
        $country->name = $name;
        $country->save();
        return $country;
    }

    public function create($data) {
        return Country::create($data);
    }
}