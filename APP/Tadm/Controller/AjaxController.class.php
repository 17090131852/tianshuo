<?php
namespace Tadm\Controller;
use Common\Controller\BaseController;

class Ajaxcontroller extends Base
{

    /**
     * 得到分类
     */
    public function getCat()
    {
        $pid = $this->request('pid','int',0);

        $catobj = M('category');
        $cat = $catobj->field('id,pid,title')->where("pid='{$pid}'")->select();
        array_unshift($cat,array('id'=>0,'pid'=>0,'title'=>'请选择'));
        $this->ajaxReturn($cat,'JSON');
//        echo json_encode($cat);die;
    }

    public function upload(){
        $res    = array();

        $targetFolder = $_SERVER['DOCUMENT_ROOT'].'/Upload/Goods/'.date("Ymd").'/'; // Relative to the root
        //判断目录是否存在，不存在则新建
        if (!file_exists($targetFolder)) {
            mkdir($targetFolder,0777);
            chmod($targetFolder, 0777);
        }

        $verifyToken = md5('unique_salt' . $_POST['timestamp']);
        if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
            $tempFile  = $_FILES['Filedata']['tmp_name'];
            $fileParts = pathinfo($_FILES['Filedata']['name']);
            //生成新文件名
            $newname    = md5(uniqid(rand())).'.'.$fileParts['extension'];
            $targetPath = $targetFolder;
            $targetFile = rtrim($targetPath,'/') . '/' . $newname;
//            echo $targetFile;
            // Validate the file type
            $fileTypes = array('jpg','jpeg','gif','png'); // File extensions

            if (in_array($fileParts['extension'],$fileTypes)) {
                //得到图片宽高
                $imgsize  = getimagesize($tempFile);
                $width  = $imgsize[0];
                $height = $imgsize[1];
                if($width!=400 || $height!=400){
                    $res['status']  = 0;
                    $res['msg']     = '图片上传有误，请上传400px*400px图片';
                }else{
                    move_uploaded_file($tempFile,$targetFile);
                    $res['status']     = 1;
                    $res['msg']        = '上传成功';
                    $res['targetFolder'] = '/Upload/Goods/'.date("Ymd").'/'.$newname;

                }
            } else {
                $res['status'] = 0;
                $res['msg']    = '上传文件类型有误';
            }
        }else{
                $res['status'] = 0;
                $res['msg']    = '图片验证有误';            
        }

        echo json_encode($res);exit;
    }
    /**
     * 新建目录
     * @param  [type]  $dir  [description]
     * @param  integer $mode [description]
     * @return [type]        [description]
     */
    public function mkdirs($dir, $mode = 0777)
    {
        if (is_dir($dir) || @mkdir($dir, $mode)) return TRUE;
        // if (!mkdirs(dirname($dir), $mode)) return FALSE;
        return @mkdir($dir, $mode);
    } 
    
}