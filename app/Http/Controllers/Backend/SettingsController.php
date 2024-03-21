<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSettingsRequest;
use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{

    public function index()
    {
        $settings = Settings::first();

        return view('admin.settings.index', compact('settings'));
    }

    public function update(UpdateSettingsRequest $request)
    {
        $settings = Settings::updateOrCreate(['id' => 1], $request->validated());

        toastr('Updated successfully!', 'success');

        return redirect()->back();
    }
}
