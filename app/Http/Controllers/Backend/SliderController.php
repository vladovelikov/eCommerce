<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SliderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    use ImageUploadTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(SliderDataTable $dataTable)
    {
        return $dataTable->render('admin.slider.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'type' => ['string', 'max:200'],
            'starting_price' => ['max:200'],
            'button_url' => ['url'],
            'order' => ['required', 'integer'],
            'status' => ['required'],
            'background_image' => ['nullable', 'image', 'max:2000']
        ]);

        $slider = new Slider();

        /* Handle image upload */
        $imagePath = $this->uploadImage($request, 'background_image', 'uploads');

        $slider->type = $request->type;
        $slider->title = $request->title;
        $slider->starting_price = $request->starting_price;
        $slider->button_url = $request->button_url;
        $slider->order = $request->order;
        $slider->status = $request->status;
        $slider->image = $imagePath;

        $slider->save();

        toastr()->success('Slider created successfully.');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $slider = Slider::findOrFail($id);

        return view('admin.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'type' => ['string', 'max:200'],
            'starting_price' => ['max:200'],
            'button_url' => ['url'],
            'order' => ['required', 'integer'],
            'status' => ['required'],
            'background_image' => ['nullable', 'image', 'max:2000']
        ]);

        $slider = Slider::findOrFail($id);
        $imageOldPath = $slider->image;

        $imagePath = $this->uploadImage($request, 'background_image', 'uploads', $imageOldPath);

        $slider->type = $request->type;
        $slider->title = $request->title;
        $slider->starting_price = $request->starting_price;
        $slider->button_url = $request->button_url;
        $slider->order = $request->order;
        $slider->status = $request->status;
        $slider->image = $imagePath ?: $imageOldPath;

        $slider->save();

        toastr()->success('Slider updated successfully.');

        return redirect()->route('admin.slider.index');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
