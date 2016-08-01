<?php 
session_start();
require_once("../globefunction.php");
require_once("../mysql_connect.inc.php");
require_once('../tcpdf/tcpdf.php');
require_once('../tcpdf/config/lang/eng.php');
require_once("./judge_login.php");

// create new PDF document
class MYPDF extends TCPDF {
	//Page header
	public function Header() {}
	
	// Page footer
	public function Footer() {}
}

$pdf = new MYPDF(PDF_PAGE_ORIENTATION, mm, A4, true, 'UTF-8', false);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->SetTopMargin(10);   // 上邊界
$pdf->SetLeftMargin(10);  // 左邊界
$pdf->SetRightMargin(10); // 右邊界
$pdf->SetAutoPageBreak(true, 10); // 當下邊界剩10時，則自動跳頁(無需則true改為false即可)

// add a page
$pdf->AddPage();

// set core font
$pdf->SetFont('droidsansfallback','', 20);
$pdf->Ln(5);
$pdf->SetFont('droidsansfallback','', 10);


/* create some PHP content
------------------------------------------------------------------------------*/
$txt='
	<style type="text/css">
		.content {
			border: 2px #ccc solid;
			background-color: #ECECFF;
			font-size: 36px;
			font-weight: normal;
			line-height: 7px;
		}
		.title {
			font-size: 48px;
			font-weight: bold;
		}
	</style>
';

$cnt = count($_POST['checksurvey']);
	
for($i=0; $i<$cnt; $i++)
{
	$result = mysql_query("SELECT * FROM survey,teacher_info WHERE survey.tid='".$_POST['checksurvey'][$i]."' and teacher_info.tid='".$_POST['checksurvey'][$i]."'");
	$list = mysql_fetch_array($result);
	
	if($list['exceedClass']==0)
		$exceedClass = '否';
	else
		$exceedClass = '是，'.$list['exceedClass'].'&nbsp;節';
	
	for($j=1; $j<=15; $j++)
	{
		if($list['hope'.$j]=='none')
			${"hope".$j} = '<font style="color:#888;">none</font>';
		else
			${"hope".$j} = '<u>'.$list['hope'.$j].'</u>';
	}
	
	$txt.= '
		<div class="content">
			<table>
				<tr>
					<td width="5%" ></td>
					<td width="90%">
							<br/><br/>
							<span class="title">超鐘點意願調查</span>
							<br/>
							<table>
								<tr>
									<td width="3%" >1.</td>
									<td width="97%">
										102.6.11高市教小第10288725700號建議每周以兼6代5不超過9節為原則。（兼即超鐘點之意）
									</td>
								</tr>
								<tr>
									<td>2.</td>
									<td>
										法定授課節數：級任老師每周授課16節，科任老師每周授課20節；建議級任老師每周至多超鐘點4節，
										<br/>
										科任老師每周至多超鐘點2節。
									</td>
								</tr>
							</table>
							<font style="line-height:1px;"><br/></font>
							
							教師姓名：<u>'.$list['name'].'</u>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							是否願意超鐘點：'.$exceedClass.'
							
							<font style="line-height:3px;">
								<br/><br/><br/>
								──────────────────────────────────────────────────────────────────────────────
								<br/><br/>
							</font>
							
							<span class="title">欲任教科目</span>
							<br/>
							下列為<u>欲任教科目</u>，標示的順序提供教務處做參考，但因配課因素不一定能全從其意願，敬請見諒。
							<br/>
							<font style="line-height:1px;"><br/></font>
							<table>
								<tr>
									<td width="33%" >意願一：'.$hope1.'</td>
									<td width="33%" >意願二：'.$hope2.'</td>
									<td width="34%" >意願三：'.$hope3.'</td>
								</tr>
								<tr>
									<td width="33%" >意願四：'.$hope4.'</td>
									<td width="33%" >意願五：'.$hope5.'</td>
									<td width="34%" >意願六：'.$hope6.'</td>
								</tr>
								<tr>
									<td width="33%" >意願七：'.$hope7.'</td>
									<td width="33%" >意願八：'.$hope8.'</td>
									<td width="34%" >意願九：'.$hope9.'</td>
								</tr>
								<tr>
									<td width="33%" >意願十：　'.$hope10.'</td>
									<td width="33%" >意願十一：'.$hope11.'</td>
									<td width="34%" >意願十二：'.$hope12.'</td>
								</tr>
								<tr>
									<td width="33%" >意願十三：'.$hope13.'</td>
									<td width="33%" >意願十四：'.$hope14.'</td>
									<td width="34%" >意願十五：'.$hope15.'</td>
								</tr>
							</table>
						
						<div style="text-align:right;line-height:8px;">
							教師簽章：_________________________
						</div>
					</td>
					<td width="5%" ></td>
				</tr>
			</table>
		</div>
		<font style="line-height:1px;"><br/></font>
	';
}
	
/* PDF 合併
------------------------------------------------------------------------------*/
$pdf->writeHTML($txt, true, false, false, true, 'J');

// 取得當下時間
date_default_timezone_set('Asia/Taipei');  // 將時區設為台灣，預設為倫敦，相差8小時
$today = date("Ymd_Hi");  // 日期格式化

// 檔名與路徑
$filename = $today."_survey.pdf";
$fileaddress = "../pdf/".$filename;

// Close and output PDF document
$pdf->Output($fileaddress, 'F');

header('Location: '.$fileaddress);
?>