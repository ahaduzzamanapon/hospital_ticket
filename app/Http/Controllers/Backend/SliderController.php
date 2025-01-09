<?php

namespace App\Http\Controllers\Backend;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return view('backend.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('backend.sliders.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string|max:255',
        ]);

        // Handle logo file upload with original extension
        $sliderPath = null;
        if ($request->hasFile('image')) {
            $slider = $request->file('image');
            $sliderName = 'image_' . time() . '.' . $slider->getClientOriginalExtension();
            $sliderPath = $slider->storeAs('uploads/sliders', $sliderName, 'public');
        }


        // Save data to the database
        $setting = new Slider();
        $setting->title = $request->input('title');
        $setting->image = $sliderPath;
        $setting->description = $request->input('description');
        $setting->save();

        // Redirect back with a success message
        return redirect()->route('admin.sliders.index')->with('success', 'Slider saved successfully!');
    }


    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('backend.sliders.edit', compact('slider'));
    }


    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string|max:255',
        ]);

        $slider = Slider::findOrFail($id);

        // Handle Logo
        if ($request->hasFile('image')) {
            // Delete the existing logo file
            if ($slider->image && file_exists(storage_path('app/public/' . $slider->image))) {
                unlink(storage_path('app/public/' . $slider->image));
            }
            $slider = $request->file('image');
            $sliderName = 'logo_' . time() . '.' . $slider->getClientOriginalExtension();
            $sliderPath = $slider->storeAs('uploads/logos', $sliderName, 'public');
            $slider->image = $sliderPath;
        }
        // Update other fields
        $slider->title = $request->title;
        $slider->description = $request->description;

        $slider->save();

        return redirect()->route('admin.settings.index')->with('success', 'Setting updated successfully.');
    }



    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);

        // Unlink logo if it exists
        if ($slider->image && file_exists(storage_path('app/public/' . $slider->image))) {
            unlink(storage_path('app/public/' . $slider->image));
        }

        // Delete the setting record from the database
        $slider->delete();

        // Redirect with a success message
        return redirect()->route('admin.settings.index')->with('success', 'Setting deleted successfully.');
    }
}
