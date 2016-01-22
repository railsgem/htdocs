<?php

        /*
        *@通过curl方式获取指定的图片到本地
        *@ 完整的图片地址
        *@ 要存储的文件名
        *@ 调用时，直接
        *@ getImg("https://static.chemistwarehouse.com.au/ams/media/productimages/50005/150.jpg","upload/image.jpg");
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

        /*
        *@ 通过product_id创建文件夹名称
        *@ 
        *@ 
        */
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

        /*
        *@ 通过给定的分类url及page分页进行抓取图片
        *@ url分页类目链接
        *@ page当前第几页
        */
        function fetch_by_category($url="",$page=""){
            $product = array();
            if (empty($url)){
                $url = 'http://www.chemistwarehouse.com.au/Shop-Online/506/Bio-Organics';
            }
            echo $url;
            // Create DOM from URL or file
            $url = $url."?page=".$page;
            echo "<h3>begin to fetch:[".$url."]</h3>";
            $html = file_get_html($url);
            //$product = array();
            foreach($html->find('.Product') as $element) {
                //$element
                // echo $element->plaintext."</br><br>";
        		//$product = array();
                foreach($element->find('img') as $element3) {
                    //echo "product id:".substr($element3->src, 63,5). '<br>';
                    //echo "Product Name: ".$element3->alt . '<br>';
                    //echo "Small img: ".$element3->src . '<br>';
                    //echo "Big img: ".substr_replace($element3->src,'original.jpg',-7 ). '<br>';
                    //save product images
                    getImg($element3->src,substr($element3->src, 63,5));
                    getImg(substr_replace($element3->src,'original.jpg',-7 ),substr($element3->src, 63,5));

                    foreach($element->find('.Price') as $element2) {
                           //echo "Chemist price: ".$element2->plaintext."</br>";
                           //echo "Chemist price: ".ltrim(rtrim($element2->plaintext," "), "$")."</br>";

                           //array_push($product_item,"chemist_price"=>$element2->plaintext);
                    }
                    //save product into array
                    $product_item = array(
                    	"product_id"=>substr($element3->src, 63,5),
                    	"product_name"=>$element3->alt,
                    	"small_img_src"=>$element3->src,
                    	"big_img_src"=>substr_replace($element3->src,'original.jpg',-7 ),
                    	"chemist_price"=>ltrim(rtrim($element2->plaintext," "), "$")
                    	);
                    //print_r($product_item);
                }
                array_push($product,$product_item);
                //echo "----------------------------------------------------</br>";
                   
            }
            echo json_encode($product);
            return $product;
        }

        /*
        *@ 通过给定的分类url进行抓取图片
        *@  
        *@ 
        */
        function fetch_all_product_by_category($url=""){
            
            $product = array();

            if (empty($url)){
                $url = 'http://www.chemistwarehouse.com.au/Shop-Online/506/Bio-Organics';
            }
            echo $url;
            $pages = get_max_pages($url);

            //进行循环
            for($ipage = 1; $ipage <= $pages; $ipage++) {
                $product_item = array();
                //echo $ipage;
                echo $url.'?page='.$ipage.'</br>';
                $product_item = fetch_by_category($url,$ipage,$product);
                $product = $product + $product_item;
            }
            return $product;
        }

        /*
        *@ 通过给定的分类url计算该分类有多少页
        *@ 默认每页24个产品
        */
        function get_max_pages($url=""){
            if (empty($url)){
                $url = 'http://www.chemistwarehouse.com.au/Shop-Online/506/Bio-Organics';
            }
            echo $url;
                $html = file_get_html($url);
                // 如果找不到分页返回页数=1
                if (empty($html->find('.Pager') )){
                    return $pages = 1;
                }
                //获取最大的分页数目
                foreach($html->find('.Pager') as $element) {
                        foreach($element->find('b') as $element2) {
                               $pages = str_replace(" Results","",$element2->plaintext)/24;
                               //获得第一个result值退出循环，因页面有两处pager
                               return ceil($pages);
                               exit;
                        }
                       exit;
                }
        }
?>