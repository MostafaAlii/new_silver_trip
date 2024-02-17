<?php
namespace App\Services\Dashboard\General;
use App\Models\State;
class StateService {
    public function updateStatus($stateId, $status, $name) {
        $state = State::findOrFail($stateId);
        $state->status = $status;
        $state->name = $name;
        $state->save();
        return $state;
    }

    public function create($data) {
        return State::create($data);
    }
}