<?php

namespace App\Http\Resources\Drivers;

use App\Http\Resources\CountryResources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class CaptionResources extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'gender' => $this->gender,
            'status_caption_type' => $this->status_caption_type,
            'inviteFriend' =>  $this->invite->code_invite ?? null,
            'captaincar' => new CarsCaptionResources($this->captaincar) ?? null,
            'car_media' => $this->getCarMedia()->toArray(),
            'scooters' => CaptainScooterResources::collection($this->scooters) ?? null,
            'scooter_media' => $this->getScooterMedia(),
            'profile' => new CaptainProfileResources($this->profile) ?? null,
            'country' => new CountryResources($this->country) ?? null,
            'fcm_token' => $this->fcm_token,
            'status' => $this->status,
            'avatar' => getImageCaption($this->id),
            'create_dates' => [
                'created_at_human' => $this->created_at->diffForHumans(),
               'created_at' => $this->created_at->format('y-m-d h:i:s')
            ],
            'update_dates' => [
                'updated_at_human' => $this->updated_at->diffForHumans(),
               'updated_at' => $this->updated_at->format('y-m-d h:i:s')
            ]
        ];
    }

    public function getCarMedia() {
        return $this->images->map(function ($image) {
            $path = asset('dashboard/img/' . str_replace(' ', '_', $this->name) . '_' . $this->profile->uuid . '/' . $image->type . '/' . $image->filename);
            return [
                'filename' => $image->filename,
                'type' => $image->type,
                'photo_type' => $image->photo_type,
                'path' => $path,
            ];
        });
    }

    public function getScooterMedia() {
        $scooterMedia = [];
        foreach ($this->scooters as $scooter) {
            $scooterImages = $scooter->scooterImages->map(function ($image) use ($scooter) {
                return [
                    'filename' => $image->filename,
                    'type' => $image->type,
                    'photo_type' => $image->photo_type,
                    'path' => asset('dashboard/img/' . str_replace(' ',
                        '_', $this->name) . '_' . $this->profile->uuid . '/scooter/' . $scooter->scooter_number . '/' .
                        $image->type . '/' . $image->filename),
                ];
            });
            $scooterMedia[] = [
                'scooter_id' => $scooter->id,
                'scooter_images' => $scooterImages,
            ];
        }
        return $scooterMedia;
    }
}