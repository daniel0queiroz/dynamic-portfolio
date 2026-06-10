<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LinkPageSetting;
use Illuminate\Http\Request;

class LinkPageSettingController extends Controller
{
    public function index()
    {
        $setting = LinkPageSetting::firstOrCreate(
            ['id' => 1],
            [
                'profile_name'   => ['en' => 'Daniel Queiroz', 'es' => 'Daniel Queiroz', 'pt' => 'Daniel Queiroz'],
                'profile_bio'    => ['en' => 'Software Engineer', 'es' => 'Ingeniero de Software', 'pt' => 'Engenheiro de Software'],
                'default_locale' => 'en',
            ]
        );

        return view('admin.link-page-setting.index', compact('setting'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'profile_name.en'  => ['required', 'max:100'],
            'profile_bio.en'   => ['required', 'max:200'],
            'default_locale'   => ['required', 'in:en,es,pt'],
        ]);

        $setting = LinkPageSetting::findOrFail($id);
        $setting->profile_name   = $request->input('profile_name');
        $setting->profile_bio    = $request->input('profile_bio');
        $setting->default_locale = $request->default_locale;
        $setting->save();

        toastr()->success('Links page settings updated!', 'Success');

        return redirect()->back();
    }
}
