<?php
/**
 * User: Administrator
 */

namespace Home\Controller;

namespace Home\Event;
use Think\Controller;
use Think\Image;
use Think\Upload;

class UploadEvent extends Controller{
    /**
     * 本站使用了编辑器(wangEditor)，当用户想在编译内容中插入图片时，需要先将图片
     * 上传至服务器，服务器再将存放图片的地址返回，编辑器再通过访问图片地址，获取图片资源。
     * 所以该方法是用于上传用户的临时图片资源，并将最终的地址返回给编译器。
     * author Fox
     */
    public function uploadImg(){
        $upload=new Upload();   //实例化上传类
//        $upload->maxSize=3000;   //设置上传大小，字节
        $upload->exts=array('jpg','png','jpeg');//限制后缀
        $upload->rootPath=IMAGE_ROOT_PATH; //上传文件的根目录，默认是./Public
        $upload->savePath='/tmp/';  //保存资源的文件夹
        $info=$upload->upload();
        if($info){
            foreach($info as $file) {
                $image = new Image();
                $image->open(IMAGE_ROOT_PATH . $file['savepath'] . $file['savename']);
                if ($image->width() > 300 || $image->height() > 300) {
                    $image->thumb(300, 300)->save(IMAGE_ROOT_PATH . $file['savepath'] . $file['savename']);
                }
                //返回上传的图片地址
                echo 'http://' . $_SERVER['HTTP_HOST'] . '/lnc/Public/uploads' . $file['savepath'] . $file['savename'];
            }
        }else{
            $data['status'] = 0;
            $data['content'] = $upload->getError();
            $this->ajaxReturn($data);
        }
    }

    public function pubImg($tempAddress,&$comment){
        foreach($tempAddress[0] as $value){
            if(is_file(IMAGE_ROOT_PATH.$value) && file_exists(IMAGE_ROOT_PATH.$value)){
                    //获取本日的文件夹
                    $dir=IMAGE_PATH.date('Y-m-d',time()).'/';
                    //判断本日文件夹是否存在，如果存在直接copy文件过去，反之先创建本日文件夹.
                    if(is_dir($dir)){
                        copy(IMAGE_ROOT_PATH.$value,$dir.basename($value));
                    }else{
                        mkdir($dir);
                        copy(IMAGE_ROOT_PATH.$value,$dir.basename($value));
                    }
                    if(preg_match('/tmp[^\"]*"/',$comment)) {
                        $comment=str_replace('/tmp/', '/img/', $comment);
                    }
                    //当copy完成后将临时文件删除
                    unlink(IMAGE_ROOT_PATH.$value);
                }
        }
    }

    /**
     * 上传图片操作，传送临时图片地址，将临时图片内容copy到存放图片的地址处，
     * 再将临时地址下的图片资源删除。
     * @param $imgAddress 图片资源地址
     * @return array  返回本次评论临时图片资源保存在服务器的地址
     * author Fox
     */
//    public function pubImg($imgAddress,$comment){
//            foreach ($imgAddress as $value){
//                //获取临时文件目录加文件名
//                $fileName = basename(dirname($value)).'/'.basename($value);
////                //将临时文件的路径存进数组
////                $filePathArray[]=$fileName;
//                //判断临时文件是否存在
//                if(is_file(TMP_IMAGE_PATH.$fileName) && file_exists(TMP_IMAGE_PATH.$fileName)){
//                    //获取本日的文件夹
//                    $dir=IMAGE_PATH.date('Y-m-d',time()).'/';
//                    //判断本日文件夹是否存在，如果存在直接copy文件过去，反之先创建本日文件夹.
//                    if(is_dir($dir)){
//                        copy(TMP_IMAGE_PATH.$fileName,$dir.basename($value));
//                    }else{
//                        mkdir($dir);
//                        copy(TMP_IMAGE_PATH.$fileName,$dir.basename($value));
//                    }
////                    if(preg_match('/\/tmp\/2016\-10\-20\/580846f4f05a9\.jpg/', $comment)){
////                        echo 222;
////                    }
////                    echo preg_replace('/'.'^\/tmp\/'.preg_quote(basename(dirname($value))).'\/'.preg_quote(basename($value)).'$/',$comment);
//                    //当copy完成后将临时文件删除
//                    unlink(TMP_IMAGE_PATH.$fileName);
//                }
//            }
////            return $filePathArray;
//    }

//    public function clearTmpFile()
//    {
//        $dir = dir(TMP_IMAGE_PATH);
//        print_r($dir);
//        while ($file = $dir->read()) {
//            $info = stat(TMP_IMAGE_PATH . $file);
//            $currenttime = time();
//            if (($currenttime - $info[9]) > 100 && is_file(TMP_IMAGE_PATH . $file)) {
//                unlink(TMP_IMAGE_PATH . $file);
//
//            }
//        }
//    }

}