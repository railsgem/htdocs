<?php
         /*
        *@通过curl方式获取指定的图片到本地
        *@ 完整的图片地址
        *@ 要存储的文件名
        */
        function getImg($url = "", $product_id = "")
        {
        		$filename = 'upload/product/'.$product_id.'/'.substr($url, 69);
        		//创建文件夹
        		createFile($product_id);
                //去除URL连接上面可能的引号
                //$url = preg_replace( '/(?:^['"]+|['"/]+$)/', '', $url );
                $hander = curl_init();
                $fp = fopen($filename,'wb');
                curl_setopt($hander,CURLOPT_URL,$url);
                curl_setopt($hander,CURLOPT_FILE,$fp);
                curl_setopt($hander,CURLOPT_HEADER,0);
                curl_setopt($hander,CURLOPT_FOLLOWLOCATION,1);
                //curl_setopt($hander,CURLOPT_RETURNTRANSFER,false);//以数据流的方式返回数据,当为false是直接显示出来
                curl_setopt($hander,CURLOPT_TIMEOUT,60);
                curl_exec($hander);
                curl_close($hander);
                fclose($fp);
                Return true;
        }
        //调用时，直接
       // getImg("https://static.chemistwarehouse.com.au/ams/media/productimages/50005/150.jpg","upload/image.jpg");

        function createFile($product_id)
        {
                //要创建的多级目录
                $path="upload/product/".$product_id;
                //判断目录存在否，存在给出提示，不存在则创建目录
                if (is_dir($path)){  
                        echo "对不起！目录 " . $path . " 已经存在！";
                }else{
                        //第三个参数是“true”表示能创建多级目录，iconv防止中文目录乱码
                        $res=mkdir(iconv("UTF-8", "GBK", $path),0777,true); 
                        if ($res){
                                echo "目录 $path 创建成功";
                        }else{
                                echo "目录 $path 创建失败";
                        }
                }
        }
?>