<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WhatsappSetting;
use Illuminate\Http\Request;

class WhatsappSettingController extends Controller
{
    /**
     * Display the settings form.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = WhatsappSetting::firstOrCreate();
        return view('admin.setting.whatsapp-setting.index', compact('setting'));
    }

    /**
     * Update the settings.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'phone_number' => ['nullable', 'max:30'],
            'message.en' => ['nullable', 'max:1000'],
            'message.es' => ['nullable', 'max:1000'],
            'message.pt' => ['nullable', 'max:1000'],
        ]);

        $setting = WhatsappSetting::firstOrCreate(['id' => $id]);
        $setting->is_enabled = $request->boolean('is_enabled');
        $setting->phone_number = $request->input('phone_number') ?: null;
        $setting->message = array_filter($request->input('message', []));
        $setting->save();

        toastr('Updated Successfully!', 'success');

        return redirect()->back();
    }
}
