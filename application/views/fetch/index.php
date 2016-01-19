
<?php

        error_reporting(E_ALL);
        include_once('simple_html_dom.php');

        // Create DOM from URL or file
        $html = file_get_html('http://www.chemistwarehouse.com.au/Shop-Online/957/Baby-Formula');
        /**
        // Find all images 
        foreach($html->find('img') as $element) 
               echo $element->src . '<br>';

        // Find all links 
        foreach($html->find('a') as $element) 
               echo $element->href . '<br>';
        */
       $smallimg_src="https://static.chemistwarehouse.com.au/ams/media/productimages/77384/150.jpg";
       echo "product id:".substr($smallimg_src, 63). '<br>';
       echo "product id:".substr($smallimg_src, 69). '<br>';

        foreach($html->find('.Product') as $element) {
                //$element
                echo $element->plaintext."</br><br>";

                foreach($element->find('img') as $element3) {
                        echo "product id:".substr($element3->src, 63,5). '<br>';
                        echo "Product Name: ".$element3->alt . '<br>';
                        echo "Small img: ".$element3->src . '<br>';
                        echo "Big img: ".substr_replace($element3->src,'original.jpg',-7 ). '<br>';
                        getImg($element3->src,substr($element3->src, 63,5));
                        getImg(substr_replace($element3->src,'original.jpg',-7 ),substr($element3->src, 63,5));
                }
                foreach($element->find('.Price') as $element2) {
                       echo "Chemist price: ".$element2->plaintext."</br>";
                }
        //https://static.chemistwarehouse.com.au/ams/media/productimages/77384/150.jpg
        //https://static.chemistwarehouse.com.au/ams/media/productimages/56696/original.jpg
                echo "----------------------------------------------------</br>";
               

        }
        /*
        *@通过curl方式获取指定的图片到本地
        *@ 完整的图片地址
        *@ 要存储的文件名
        */
  /**       function getImg($url = "", $filename = "")
        {

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
        */
        //createFile("1111");

?>