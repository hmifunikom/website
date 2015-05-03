<?php namespace HMIF\Libraries;

use Input;
use Image;
use File;

class ImageManipulation {

    private $file_object;
    private $temp_filename;
    private $filename;
    private $suffix;

    private $orig_path;
    private $thumb_path;
    private $temp_path;

    private $_uploaded = false;

    public function __construct($field, $filename)
    {
        $this->orig_path = public_path('media/images');
        $this->thumb_path = public_path('media/thumbs');
        $this->temp_path = public_path('media/temp');


        if (Input::hasFile($field))
        {
            $this->filename = $filename;
            $this->suffix = '_'.str_random(3);

            $this->file_object = Input::file($field);
            $this->temp_filename = str_random();
            $this->file_object->move($this->temp_path, $this->temp_filename);

            $this->_uploaded = true;
        }
    }

    public function resize($size = 1024)
    {
        $img = Image::make($this->_source());
        $img->resize(null, 1024, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $this->_fix_orientation($img);
        $img->save($this->_destination_orig());
    }

    public function thumb($width = 300, $height = null)
    {
        $img = Image::make($this->_source());
        
        if($height)
            $img->fit($width, $height);
        else
            $img->fit($width);
    
        $this->_fix_orientation($img);
        $img->save($this->_destination_thumb());
    }

    public function isUploaded()
    {
        return $this->_uploaded;
    }

    public function getFileName()
    {
        return $this->filename.$this->suffix.'.'.$this->file_object->getClientOriginalExtension();
    }

    private function _source()
    {
        return $this->temp_path.'/'.$this->temp_filename;
    }

    private function _destination_orig()
    {
        return $this->orig_path.'/'.$this->filename.$this->suffix.'.'.$this->file_object->getClientOriginalExtension();
    }

    private function _destination_thumb()
    {    
        return $this->thumb_path.'/'.$this->filename.$this->suffix.'.'.$this->file_object->getClientOriginalExtension();
    }

    private function _fix_orientation($img)
    {
        if(! $this->_is_jpeg($img)) return;
        $img->orientate();
    }

    private function _is_jpeg($img)
    {
        return "image/jpeg" == $img->mime;
    }

    public function __destruct()
    {
        File::delete($this->_source());
    }
}