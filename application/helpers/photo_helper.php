<?php
    function upload_image_to_dir($uploadPath = 'uploads/', $upload_file_name = 'file'){
        $success = array();
        $success['path'] = '';
        $allowedExts = array('jpg', 'png', 'gif');
        if(!empty($_FILES)){
            $extension = end(explode(".", $_FILES[$upload_file_name]["name"]));

            if (($_FILES[$upload_file_name]["size"] < 5000000)	&& in_array($extension, $allowedExts))
            {
                if ($_FILES[$upload_file_name]["error"] > 0) {
                    $success['status'] = false;
                    $success['message'] = 'File is not present';
                }
                else {
                    if (!is_dir($uploadPath)) {
                        mkdir($uploadPath);
                    }

                    $file_name = $uploadPath.$_FILES[$upload_file_name]["name"];

                    if (file_exists($file_name)) {
                        list($name, $ext) = explode('.', $file_name);
                        $file_name = $name."_".date("Y-m-d-H-i-s").".".$ext;
                    }

                    move_uploaded_file($_FILES[$upload_file_name]["tmp_name"], $file_name);
                    $success['status'] = true;
                    $success['path'] = $file_name;
                }
            }
            else {
                $success['status'] = false;
                $success['message'] = 'Either file size is too big of file extension is not supported';
                
            }
        } else{
            $success['status'] = false;
            $success['message'] = 'Missing file path';
        }
        return $success;
    }
