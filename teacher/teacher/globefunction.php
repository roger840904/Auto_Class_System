<?php
function menu()
{
	echo '
	<ul>
		<li><a href="#">&nbsp 課程意願 ▼ &nbsp</a>
			<ul>
				<li>
					<a href="surveymanage.php">意願調查</a>
				</li>
				<li>
					<a href="arrange.php">課程編排</a>
				</li>
			</ul>
		</li>
		<li><a href="#">&nbsp 管理  ▼ &nbsp</a>
			<ul>
				<li>
					<a href="staffmanage.php">教職管理</a>
				</li>
				<li>
					<a href="classmanage.php">班級管理</a>
				</li>
				<li>
					<a href="resourcemanage.php">資源班管理</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="timetableinquiry.php">課表查詢</a>
		</li>
		<li>
			<a href="setting.php">修改帳密</a>
		</li>
		<li>
			<a href="../logout.php">登出</a>
		</li>
	</ul>	
		';
}

function popup_model_submit_javascript($form_name)
{	?>
	<script type="text/javascript">
	// 有form的時候
	function popup_modal_submit(get_heading){
		document.getElementById("popup_heading").innerHTML = get_heading;
		document.getElementById("select_ok").href = "javascript: submitform()";
		$('#popup_modal').reveal({			// The item which will be opened with reveal
			animation: 'fade',             	// fade, fadeAndPop, none
			animationspeed: 600,			// how fast animtions are
			closeonbackgroundclick: true,	// if you click background will modal close?
			dismissmodalclass: 'close'		// the class of a button or element that will close an open modal
		});
	}
	// 控制form submit
	function submitform()
	{
		document.forms["<?php echo $form_name; ?>"].submit();  /* forms["form的id"] */
	}
	</script>
	<?php
}
function popup_model_submit_javascript2()
{	?>
	<script type="text/javascript">
	// 有form的時候
	function popup_modal_submit(get_heading,form_name){
		document.getElementById("popup_heading").innerHTML = get_heading;
		document.getElementById("select_ok").href = "javascript: submitform('"+form_name+"')";
		$('#popup_modal').reveal({			// The item which will be opened with reveal
			animation: 'fade',             	// fade, fadeAndPop, none
			animationspeed: 600,			// how fast animtions are
			closeonbackgroundclick: true,	// if you click background will modal close?
			dismissmodalclass: 'close'		// the class of a button or element that will close an open modal
		});
	}
	// 控制form submit
	function submitform(form_name)
	{
		document.forms[form_name].submit();  /* forms["form的id"] */
	}
	</script>
	<?php
}
function popup_model_href_javascript()
{	?>
	<script type="text/javascript">
	// 純粹跳頁的時候
	function popup_modal_href(get_heading,get_href){
		document.getElementById("popup_heading").innerHTML = get_heading;
		document.getElementById("select_ok").href = get_href;
		
	   	$('#popup_modal').reveal({		// The item which will be opened with reveal
		  	animation: 'fade',             	// fade, fadeAndPop, none
			animationspeed: 600,			// how fast animtions are
			closeonbackgroundclick: true,	// if you click background will modal close?
			dismissmodalclass: 'close'		// the class of a button or element that will close an open modal
		});
	}
	</script>
	<?php
}

function show_popup_model()
{
	echo'
	<!-- 自訂 提醒視窗 -->
	<div id="popup_modal">
		<div id="popup_heading"></div>
		<div id="popup_content">
			<a href="#" id="select_ok" class="select_btn green close"><img src="popup_window/btn_ok.png">&nbsp&nbsp確 定&nbsp&nbsp</a>
			<a href="#" id="select_cancel" class="select_btn red close"><img src="popup_window/btn_cancel.png">&nbsp&nbsp取 消&nbsp&nbsp</a>
		</div>
	</div>
	';
}

function show_popup_model_admin()
{
	echo'
	<!-- 自訂 提醒視窗 -->
	<div id="popup_modal">
		<div id="popup_heading"></div>
		<div id="popup_content">
			<a href="#" id="select_ok" class="select_btn green close"><img src="../popup_window/btn_ok.png">&nbsp&nbsp確 定&nbsp&nbsp</a>
			<a href="#" id="select_cancel" class="select_btn red close"><img src="../popup_window/btn_cancel.png">&nbsp&nbsp取 消&nbsp&nbsp</a>
		</div>
	</div>
	';
}

function show_popup_alert()
{
	echo'
		<!-- 自訂 提醒視窗 -->
		<div id="popupModal">
			<div id="popupHeading"></div>
			<div id="popupContent" style="height:132px;">
				<img id="imgAlert" src="">
				<p id="popupWord">文字描述</p>
				<a href="#" id="selectOk" class="btn_alert close">確 定</a>
			</div>
		</div>
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="popup_window/styles_popup_window.css">
		<!-- jQuery -->
		<script src="popup_window/jquery.min.js"></script>
		<script src="popup_window/jquery.reveal.js"></script>
		<script type="text/javascript">
			function popup_modal_alert(get_img,get_heading,get_herf){
				document.getElementById("imgAlert").src = "popup_window/img_"+get_img+".png";
				document.getElementById("popupWord").innerHTML = get_heading;
				document.getElementById("selectOk").href = get_herf;
				$("#popupModal").reveal({		// The item which will be opened with reveal
					animation: "fade",             	// fade, fadeAndPop, none
					animationspeed: 600,			// how fast animtions are
					closeonbackgroundclick: true,	// if you click background will modal close?
					dismissmodalclass: "close"		// the class of a button or element that will close an open modal
				});
			}
		</script>
	';
}

function show_popup_alert_admin()
{
	echo'
		<!-- 自訂 提醒視窗 -->
		<div id="popupModal">
			<div id="popupHeading"></div>
			<div id="popupContent" style="height:132px;">
				<img id="imgAlert" src="">
				<p id="popupWord">文字描述</p>
				<a href="#" id="selectOk" class="btn_alert close">確 定</a>
			</div>
		</div>
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="../popup_window/styles_popup_window.css">
		<!-- jQuery -->
		<script src="../popup_window/jquery.min.js"></script>
		<script src="../popup_window/jquery.reveal.js"></script>
		<script type="text/javascript">
			function popup_modal_alert(get_img,get_heading,get_herf){
				document.getElementById("imgAlert").src = "../popup_window/img_"+get_img+".png";
				document.getElementById("popupWord").innerHTML = get_heading;
				document.getElementById("selectOk").href = get_herf;
				$("#popupModal").reveal({		// The item which will be opened with reveal
					animation: "fade",             	// fade, fadeAndPop, none
					animationspeed: 600,			// how fast animtions are
					closeonbackgroundclick: true,	// if you click background will modal close?
					dismissmodalclass: "close"		// the class of a button or element that will close an open modal
				});
			}
		</script>
	';
}
?>