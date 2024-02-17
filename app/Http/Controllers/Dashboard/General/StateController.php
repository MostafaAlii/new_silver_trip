<?php

namespace App\Http\Controllers\Dashboard\General;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\General\StateService;
use App\DataTables\Dashboard\General\StateDataTable;

class StateController extends Controller {
    public function __construct(protected StateDataTable $stateDataTable, protected StateService $stateService) {
        $this->stateDataTable = $stateDataTable;
        $this->stateService = $stateService;
    }

    public function index() {
        $countries = Country::active();
        return $this->stateDataTable->render('dashboard.general.states.index', ['title' => 'States', 'countries' => $countries]);
    }

    public function store(Request $request) {
        try {
            $validatedData = $request->all();
            $this->stateService->create($validatedData);
            return redirect()->route('states.index')->with('success', 'Country created successfully');
        } catch (\Exception $e) {
            return redirect()->route('states.index')->with('error', 'An error occurred while creating the Country');
        }
    }

    public function changeStatusState(Request $request, $stateId) {
        try {
            $this->stateService->updateStatus($stateId, $request->status, $request->name);
            return redirect()->route('states.index')->with('success', 'State Status updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('states.index')->with('error', 'An error occurred while updating the State Status');
        }
    }

}