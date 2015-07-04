<?php
//文件下载函数
//$file_sub_path的格式是   /xx/xx/
	function fileDown($fileName){
		//转化文件的编码方式，主要是针对中文命名的文件，因为文件函数出现的时候只是针对英文命名的文件，到现在没有更新
		//$fileName=iconv("utf-8","gb2312",$fileName);
		//设置文件的路径
		//$filePath=$fileName;
		//判断文件是否存在
		if(!file_exists($fileName)){
			die("该文件不存在");
		}
		
		//打开文件
		$fp=fopen($fileName,"r");
		$fileSize=filesize($fileName);
		header("Content-type:application/octet-stream");
		header("Accept-Ranges:bytes");
		header("Accept-Length:$fileSize");
		header("Content-Disposition:attachment;filename=".$fileName);
		//判断文件的大小，参数为文件名（即不用打开文件就可以测试文件的大小）
		$buffer=500;
		$fileCount=0;
		while(!feof($fp)&&($fileSize-$fileCount>0)){
			$fileData=fread($fp,$buffer);
			$fileCount+=$buffer;
			echo $fileData;
		}
		//关闭文件
		fclose($fp);		
	}
	fileDown("a.jpg");
?>