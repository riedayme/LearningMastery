<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class _Process_Upload extends CI_Model {

    function Upload_File($config,$path_dir,$file_data,$file_delete = false,$file_name = null, $is_image = false)
    {

        #load library upload
        $this->load->library('upload');        

        # check type file
        if ($config == 'image') {
            $config_upload = array(
                'upload_path' => $path_dir,
                'allowed_types' =>'jpeg|jpg|png|ico',
                );
        }    

        if (!empty($file_name)) {
            $file_name = $file_name;
        }else {
            $file_name = $file_data;
        }

        $this->upload->initialize(array_merge($config_upload,array('file_name' => $file_name."_".date('YmdHis'))));

        if($this->upload->do_upload($file_data)){

            $data = array($file_data => $this->upload->data());


            # check if create thumbnail
            if ($is_image) {

                if ($is_image == 'resize') {
                    $create_thumb = $this->Image_Resize_Square($data[$file_data]['file_name'],$path_dir);
                    if ($create_thumb != 'success') {
                        echo $create_thumb;
                        exit;
                    }else{
                        $create_thumb = $this->Image_Resize($data[$file_data]['file_name'],$path_dir);
                        if ($create_thumb != 'success') {
                            echo $create_thumb;
                            exit;
                        }
                    }
                }else{      
                    $create_thumb = $this->Image_Thumbnail($data[$file_data]['file_name'],$path_dir);
                    if ($create_thumb != 'success') {
                        echo $create_thumb;
                        exit;
                    }
                }
            }


            #delete old file
            if ($file_delete) {
                @unlink($path_dir.$file_delete);
                if ($is_image) {
                    @unlink($path_dir.'thumbnail/'.$file_delete);
                }    
            }

            return array(
                $file_data => $data[$file_data]['file_name'],
                );

        }else{
            return false;
        }
    }

    function Image_Thumbnail($file_data,$path_dir)
    {

        $this->load->library('image_lib');
        $source_path = $path_dir.$file_data;
        $target_path = $path_dir.'thumbnail/';
        $config = array(
          'image_library' => 'gd2',
          'source_image' => $source_path,
          'new_image' => $target_path,
          'maintain_ratio' => TRUE,
          'width' => 250,
          );

        $this->image_lib->clear();
        $this->image_lib->initialize($config);

        if (!$this->image_lib->resize()) {
            return $this->image_lib->display_errors();
        }
        else {

            return 'success';
        }

    }

    public function Image_Resize($file_data,$path_dir)
    {

        $this->load->library('image_lib');
        $source_path = $path_dir.$file_data;
        $target_path = $source_path;
        $config = array(
          'image_library' => 'gd2',
          'source_image' => $source_path,
          'new_image' => $target_path,
          'maintain_ratio' => TRUE,
          'width' => 110,
          );

        $this->image_lib->clear();
        $this->image_lib->initialize($config);

        if (!$this->image_lib->resize()) {
            return $this->image_lib->display_errors();
        }
        else {
            return 'success';
        }

    }    

    public function Image_Resize_Square($file_data,$path_dir)
    {

        $source_path = $path_dir.$file_data;
        $target_path = $source_path;
        $config = array(
          'image_library' => 'gd2',
          'source_image' => $source_path,
          'new_image' => $target_path,
          'maintain_ratio' => FALSE,
          );

        $this->load->library('FastImage');
        @$fastimage = new FastImage($source_path);

        if ($fastimage->handle) {
            list($width, $height) = $fastimage->getSize();
            $fileData['image_width'] = $width;
            $fileData['image_height'] = $height;
        }

        if ($fileData['image_width'] > $fileData['image_height']) {
            $config['width'] = $fileData['image_height'];
            $config['height'] = $fileData['image_height'];
            $config['x_axis'] = (($fileData['image_width'] / 2) - ($config['width'] / 2));
        }
        else {
            $config['height'] = $fileData['image_width'];
            $config['width'] = $fileData['image_width'];
            $config['y_axis'] = (($fileData['image_height'] / 2) - ($config['height'] / 2));
        }

        $this->load->library('image_lib');
        $this->image_lib->clear();
        $this->image_lib->initialize($config);

        if (!$this->image_lib->crop()) {
            return $this->image_lib->display_errors();
        }
        else {

            return 'success';
        }

    }

}
