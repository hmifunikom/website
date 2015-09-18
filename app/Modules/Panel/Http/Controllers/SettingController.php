<?php namespace HMIF\Modules\Panel\Http\Controllers;

use Illuminate\Http\Request;
use Settings;
use stdClass;
use HMIF\Libraries\ImageManipulation;

class SettingController extends PanelController {

    public function __construct()
    {
        parent::__construct();
        $this->authorize('manage', 'Setting');
    }

	public function edit()
	{
        head_title('Setting');
		return view('panel::setting');
	}

    public function update(Request $request)
    {
        $fields = explode(',', $request->get('fields'));

        foreach($fields as $f)
        {
            Settings::set($f, $request->get($f));
        }

        flash_success_update('Data sukses diubah.');

        return redirect_ajax('panel.setting.edit');
    }

    public function updateImage(Request $request)
    {
        if(! is_ajax()) redirect_ajax('panel.setting.edit');

        $fields = $request->get('fields');

        $img = new ImageManipulation($fields, $fields);

        if ($img->isUploaded())
        {
            $img->save();

            delete_media(Settings::get($fields));

            Settings::set($fields, $img->getFileName());

            flash_success('Foto sukses disimpan.');
            $response = new stdClass();
            $response->path = asset_version('media/images/' . $img->getFileName());
            return response_ajax($response);
        }
        else
        {
            flash_error('Foto cover gagal diunggah.');
            return response_ajax_fail();
        }
    }
	
}