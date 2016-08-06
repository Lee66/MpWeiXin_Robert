<?php
require_once('weixin.class.php');
$weixin = new class_weixin();
$signPackage = $weixin->GetSignPackage();

?>

<!DOCTYPE html>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, minimum-scale=1.0, user-scalable=no" />
        <meta name="format-detection" content="telephone=no" />
  <title>南山道长</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
  <link rel="stylesheet" href="http://demo.open.weixin.qq.com/jssdk/css/style.css">
</head>
<body ontouchstart="">
 上传图片的测试

 <h3 id="menu-image">图像接口</h3>
      <span class="desc">拍照或从手机相册中选图接口</span>
      <button class="btn btn_primary" id="chooseImage" onclick="chooseImg_Opinion()">chooseImage</button>
    
    <span>图片预览</span>
	<div id="photo"></div>

</body>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
	wx.config({
		debug: false,
		appId: '<?php echo $signPackage["appId"];?>',
		timestamp: <?php echo $signPackage["timestamp"];?>,
		nonceStr: '<?php echo $signPackage["nonceStr"];?>',
		signature: '<?php echo $signPackage["signature"];?>',
		jsApiList: [
			// 所有要调用的 API 都要加到这个列表中
			'checkJsApi',
			'chooseImage',
		  ]
	});
</script>

<script>
	wx.ready(function () {
		//自动执行的
		wx.checkJsApi({
			jsApiList: [
				'chooseImage',
			],
			success: function (res) {
				// alert(JSON.stringify(res));
				// alert(JSON.stringify(res.checkResult.getLocation));
				// if (res.checkResult.getLocation == false) {
					// alert('你的微信版本太低，不支持微信JS接口，请升级到最新的微信版本！');
					// return;
				// }
			}
		});
	});

	wx.error(function (res) {
		alert(res.errMsg);
	});

 function chooseImg_Opinion() {
                wx.chooseImage({
                    success: function (res) {
                        showImgs_Opinion(res);
                    }
                });
            }

 function showImgs_Opinion(res) {
 	var parent = document.getElementById('photo');

 	var div = document.createElement("div");
	//设置 div 属性，如 id
	div.setAttribute("id", "imgDiv");
 	var _html="";
    for(var i in res.localIds){
       	var photoSrc=res.localIds[i];
       	_html=_html+'<br>图片'+i+':<img src="'+photoSrc+'" height="200" width="200" />\n';
    }
　　div.innerHTML = _html;
　　parent.appendChild(div);

 </script>
</html>
