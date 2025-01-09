<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all();
        return view('backend.settings.index', compact('settings'));
    }

    public function create()
    {
        return view('backend.settings.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_bn' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'favicon' => 'nullable|image|mimes:ico,jpeg,png,jpg,gif|max:512',
            'address_en' => 'required|string|max:255',
            'address_bn' => 'required|string|max:255',
        ]);

        // Handle logo file upload with original extension
        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = 'logo_' . time() . '.' . $logo->getClientOriginalExtension();
            $logoPath = $logo->storeAs('uploads/logos', $logoName, 'public');
        }

        // Handle favicon file upload with original extension
        $faviconPath = null;
        if ($request->hasFile('favicon')) {
            $favicon = $request->file('favicon');
            $faviconName = 'favicon_' . time() . '.' . $favicon->getClientOriginalExtension();
            $faviconPath = $favicon->storeAs('uploads/favicons', $faviconName, 'public');
        }

        // Save data to the database
        $setting = new Setting();
        $setting->title_en = $request->input('title_en');
        $setting->title_bn = $request->input('title_bn');
        $setting->logo = $logoPath;
        $setting->favicon = $faviconPath;
        $setting->address_en = $request->input('address_en');
        $setting->address_bn = $request->input('address_bn');
        $setting->save();

        // Redirect back with a success message
        return redirect()->route('admin.settings.index')->with('success', 'Settings saved successfully!');
    }



    public function show($id)
    {
        $setting = Setting::findOrFail($id);
        // dd($department);
        return view('backend.settings.show', compact('setting'));
    }

    public function edit($id)
    {
        $setting = Setting::findOrFail($id);
        return view('backend.settings.edit', compact('setting'));
    }


    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_bn' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'favicon' => 'nullable|image|mimes:ico,jpeg,png,jpg,gif|max:512',
            'address_en' => 'required|string|max:255',
            'address_bn' => 'required|string|max:255',
        ]);

        $setting = Setting::findOrFail($id);

        // Handle Logo
        if ($request->hasFile('logo')) {
            // Delete the existing logo file
            if ($setting->logo && file_exists(storage_path('app/public/' . $setting->logo))) {
                unlink(storage_path('app/public/' . $setting->logo));
            }
            $logo = $request->file('logo');
            $logoName = 'logo_' . time() . '.' . $logo->getClientOriginalExtension();
            $logoPath = $logo->storeAs('uploads/logos', $logoName, 'public');
            $setting->logo = $logoPath;
        }

        // Handle Favicon
        if ($request->hasFile('favicon')) {
            // Delete the existing favicon file
            if ($setting->favicon && file_exists(storage_path('app/public/' . $setting->favicon))) {
                unlink(storage_path('app/public/' . $setting->favicon));
            }
            $favicon = $request->file('favicon');
            $faviconName = 'favicon_' . time() . '.' . $favicon->getClientOriginalExtension();
            $faviconPath = $favicon->storeAs('uploads/favicons', $faviconName, 'public');
            $setting->favicon = $faviconPath;
        }

        // Update other fields
        $setting->title_en = $request->title_en;
        $setting->title_bn = $request->title_bn;
        $setting->address_en = $request->address_en;
        $setting->address_bn = $request->address_bn;

        $setting->save();

        return redirect()->route('admin.settings.index')->with('success', 'Setting updated successfully.');
    }



    public function destroy($id)
    {
        $setting = Setting::findOrFail($id);

        // Unlink logo if it exists
        if ($setting->logo && file_exists(storage_path('app/public/' . $setting->logo))) {
            unlink(storage_path('app/public/' . $setting->logo));
        }

        // Unlink favicon if it exists
        if ($setting->favicon && file_exists(storage_path('app/public/' . $setting->favicon))) {
            unlink(storage_path('app/public/' . $setting->favicon));
        }

        // Delete the setting record from the database
        $setting->delete();

        // Redirect with a success message
        return redirect()->route('admin.settings.index')->with('success', 'Setting deleted successfully.');
    }
}
