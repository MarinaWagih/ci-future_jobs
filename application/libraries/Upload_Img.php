<?php
//use Category;

Class Upload_Img
{
  public function  upload($id,$files,$path,$var_name)
  {
      $imageName=rand(0,9999999999) .rand(0,9999999999) .rand(0,9999999999);
      $config['upload_path'] = $path;//'images/adv/'
      $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';
      $config['max_size'] = '2048000';
      $config['max_width'] = '6000';
      $config['max_height'] = '768';
      $config['file_name'] = $imageName.$id;
      $img = $var_name;
      $CI =& get_instance();

      if (!empty($files[$var_name]['name']))
      {

          $path1 = $files[$var_name]['name'];
          $ext = pathinfo($path1, PATHINFO_EXTENSION);


          $data['user_image'] = $config['file_name']."." . $ext;

          $CI->load->library('upload');
          $CI->upload->initialize($config);
          if(!$CI->upload->do_upload($img)) {
              var_dump($CI->upload->display_errors());
              exit;
          }
         return $config['file_name']."." . $ext;

      }
      else
      {

          $fileName='default.jpg';
      }
      return $fileName;
  }

}
?>
