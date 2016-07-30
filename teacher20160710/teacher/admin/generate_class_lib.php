<?php
    function moveElement(&$array, $a, $b) {
        $out = array_splice($array, $a, 1);
        array_splice($array, $b, 0, $out);
    }

    function clearTable($table) {
        $sqldelclass="TRUNCATE `".$table."`"; //清空class_time_info資料表
	    mysql_query($sqldelclass);
    }

    function getPEClass($p, $q) {
        echo $p."_".$q;
			echo '<br/>';
			$result=mysql_query("SELECT subjectNum,gradeSubjectNum FROM grade_schema_info WHERE gradeNumber=".$p." ORDER BY gradeSubjectNum DESC");
			$gradeSubjectNum=[];
			$gradeSubject=[];
			
			if($result===false){
				die(mysql_error());
			}
			
			while($row=mysql_fetch_array($result)) {
				$gradeSubjectNum[]=$row['gradeSubjectNum'];		
				$gradeSubject[]=$row['subjectNum'];
			}

			foreach ($gradeSubject as $key => $value) {
				if($value=='13'){
					moveElement($gradeSubject, $key, 0);
					moveElement($gradeSubjectNum, $key, 0);
				}
			}
			
			$classList=[];
			for($i=0;$i<7;$i++) {
				$classList[$i]=array_fill(0,5,0);
			} //產生全為0的5*7陣列
			
			$daySelect=[1,2,3,4,5];
			
			if($p==1||$p==2){			
				$nodeSelect1=[1,2,3,4];
				$nodeSelect2=[1,2,3,4,5,6,7];
				$nodeSelect3=[1,2,3,4];
				$nodeSelect4=[1,2,3,4];
				$nodeSelect5=[1,2,3,4];	
			}elseif ($p==3||$p==4) {
				$nodeSelect1=[1,2,3,4,5,6,7];
				$nodeSelect2=[1,2,3,4,5,6,7];
				$nodeSelect3=[1,2,3,4];
				$nodeSelect4=[1,2,3,4,5,6,7];
				$nodeSelect5=[1,2,3,4];
			}elseif ($p==5||$p==6) {
				$nodeSelect1=[1,2,3,4,5,6,7];
				$nodeSelect2=[1,2,3,4,5,6,7];
				$nodeSelect3=[1,2,3,4];
				$nodeSelect4=[1,2,3,4,5,6,7];
				$nodeSelect5=[1,2,3,4,5,6,7];
			}
			
			$nodeSelectCount1=sizeof($nodeSelect1);
			$nodeSelectCount2=sizeof($nodeSelect2);
			$nodeSelectCount3=sizeof($nodeSelect3);
			$nodeSelectCount4=sizeof($nodeSelect4);
			$nodeSelectCount5=sizeof($nodeSelect5);
			
			$check1=0;
			$check2=0;
			$check3=0;
			$check4=0;
			$check5=0;
			$sameDayCheck=0;
			$sameClassCheck=0;
			$sameClassCheckday=-1;
			while(sizeof($gradeSubject)>0){
				if($gradeSubject[0]==$sameClassCheck){
					if($check1>=$nodeSelectCount1){
						foreach ($daySelect as $key => $value) {
							if($value=='1'){
								array_splice($daySelect,$key,1);
							}
						}
					}
					
					
					if($check2>=$nodeSelectCount2){
						foreach ($daySelect as $key => $value) {
							if($value=='2'){
								array_splice($daySelect,$key,1);
							}
						}
					}
					if($check3>=$nodeSelectCount3){
						foreach ($daySelect as $key => $value) {
							if($value=='3'){
								array_splice($daySelect,$key,1);
							}
						}
					}
					if($check4>=$nodeSelectCount4){
						foreach ($daySelect as $key => $value) {
							if($value=='4'){
								array_splice($daySelect,$key,1);
							}
						}
					}
					if($check5>=$nodeSelectCount5){
						foreach ($daySelect as $key => $value) {
							if($value=='5'){
								array_splice($daySelect,$key,1);
							}
						}
					}

					foreach ($daySelect as $key => $value) {
						
						if($value==$sameDayCheck){
							array_splice($daySelect,$key,1);
						}
					}
					
					if(sizeof($daySelect)==0){
						$daySelect[$daySelectIndex]=$sameDayCheck;
						$sameClassCheck=$gradeSubject[0];
						$sameClassCheckday=$daySelectIndex;
					} else {
						$daySelectLen=sizeof($daySelect);
						$daySelectIndex=rand(0,$daySelectLen-1);
						$sameDayCheck=$daySelect[$daySelectIndex];
						$sameClassCheck=$gradeSubject[0];
						$sameClassCheckday=$daySelectIndex;
					}
				} else {
					$daySelect=[1,2,3,4,5];	
					if($check1>=$nodeSelectCount1){
						foreach ($daySelect as $key => $value) {
							if($value=='1') {
								array_splice($daySelect,$key,1);
							}
						}
					}
					if($check2>=$nodeSelectCount2){
						foreach ($daySelect as $key => $value) {
							if($value=='2') {
								array_splice($daySelect,$key,1);
							}
						}
					}
					if($check3>=$nodeSelectCount3){
						foreach ($daySelect as $key => $value) {
							if($value=='3') {
								array_splice($daySelect,$key,1);
							}
						}
					}
					if($check4>=$nodeSelectCount4){
						foreach ($daySelect as $key => $value) {
							if($value=='4') {
								array_splice($daySelect,$key,1);
							}
						}
					}
					if($check5>=$nodeSelectCount5){
						foreach ($daySelect as $key => $value) {
							if($value=='5') {
								array_splice($daySelect,$key,1);
							}
						}
					}
					
					//排體育課
					if($gradeSubject[0]=='13'){
						for($i=0;$i<sizeof($daySelect);$i++){
							switch ($daySelect[$i]) {
								case '1':
									if($p==6){
										if(!(in_array('2',$nodeSelect1)||in_array('3',$nodeSelect1)||in_array('6',$nodeSelect1)||in_array('7',$nodeSelect1))){
											array_splice($daySelect,$i,1);
										} 
									}else{									
										if(!(in_array('1',$nodeSelect1)||in_array('2',$nodeSelect1)||in_array('3',$nodeSelect1)||in_array('6',$nodeSelect1)||in_array('7',$nodeSelect1))){
											array_splice($daySelect,$i,1);
										} 
									}
									                                                                                                                                                                                                                                                                                                                                                                                      
									break;								
								case '2':
									if($p==1){
										if(!(in_array('1',$nodeSelect2)||in_array('3',$nodeSelect2)||in_array('6',$nodeSelect2)||in_array('7',$nodeSelect2))){
											array_splice($daySelect,$i,1);
										}
									}elseif($p==2){
										if(!(in_array('2',$nodeSelect2)||in_array('3',$nodeSelect2)||in_array('6',$nodeSelect2)||in_array('7',$nodeSelect2))){
											array_splice($daySelect,$i,1);
										}
									}else{
										if(!(in_array('1',$nodeSelect2)||in_array('2',$nodeSelect2)||in_array('3',$nodeSelect2)||in_array('6',$nodeSelect2)||in_array('7',$nodeSelect2))){
											array_splice($daySelect,$i,1);
										}
									}	
									
									break;
								case '3':
									if($p==5){
										if(!(in_array('2',$nodeSelect3)||in_array('3',$nodeSelect3))){
											array_splice($daySelect,$i,1);
										} 
									}else{
										if(!(in_array('1',$nodeSelect3)||in_array('2',$nodeSelect3)||in_array('3',$nodeSelect3))){
											array_splice($daySelect,$i,1);
										}  
									}
									   
									break;
								case '4':
									if($p==4){
										if(!(in_array('3',$nodeSelect4)||in_array('6',$nodeSelect4)||in_array('7',$nodeSelect4))){
											array_splice($daySelect,$i,1);
										}
									}else{
										if(!(in_array('1',$nodeSelect4)||in_array('2',$nodeSelect4)||in_array('3',$nodeSelect4)||in_array('6',$nodeSelect4)||in_array('7',$nodeSelect4))){
											array_splice($daySelect,$i,1);
										}
									}
									
									break;
								case '5':
									if($p==3){
										if(!(in_array('2',$nodeSelect5)||in_array('3',$nodeSelect5)||in_array('6',$nodeSelect5)||in_array('7',$nodeSelect5))){
											array_splice($daySelect,$i,1);
										}
									}else{
										if(!(in_array('1',$nodeSelect5)||in_array('2',$nodeSelect5)||in_array('3',$nodeSelect5)||in_array('6',$nodeSelect5)||in_array('7',$nodeSelect5))){
											array_splice($daySelect,$i,1);
										}
									}
									
									break;			
							}
						}
					}
					
					//排國文或數學
					if($gradeSubject[0]=='1'||$gradeSubject[0]=='2'){
						for($i=0;$i<sizeof($daySelect);$i++){
							switch ($daySelect[$i]) {
								case '1':
									if(!(in_array('1',$nodeSelect1)||in_array('2',$nodeSelect1)||in_array('3',$nodeSelect1)||in_array('4',$nodeSelect1))){
										array_splice($daySelect,$i,1);
									} 
									                                                                                                                                                                                                                                                                                                                                                                                      
									break;								
								case '2':
									if(!(in_array('1',$nodeSelect2)||in_array('2',$nodeSelect2)||in_array('3',$nodeSelect2)||in_array('4',$nodeSelect2))){
										array_splice($daySelect,$i,1);
									} 	
									
									break;
								case '3':
									if(!(in_array('1',$nodeSelect3)||in_array('2',$nodeSelect3)||in_array('3',$nodeSelect3)||in_array('4',$nodeSelect3))){
										array_splice($daySelect,$i,1);
									} 
									   
									break;
								case '4':
									if(!(in_array('1',$nodeSelect4)||in_array('2',$nodeSelect4)||in_array('3',$nodeSelect4)||in_array('4',$nodeSelect4))){
										array_splice($daySelect,$i,1);
									} 
									
									break;
								case '5':
									if(!(in_array('1',$nodeSelect5)||in_array('2',$nodeSelect5)||in_array('3',$nodeSelect5)||in_array('4',$nodeSelect5))){
										array_splice($daySelect,$i,1);
									} 
									
									break;				
							}
						}
					}
					
					$daySelectLen=sizeof($daySelect);
					$daySelectIndex=rand(0,$daySelectLen-1);
					$sameDayCheck=$daySelect[$daySelectIndex];
					$sameClassCheck=$gradeSubject[0];
					$sameClassCheckday=$daySelectIndex;
				}
				
				switch ($daySelect[$daySelectIndex]) {
					case 1:	
							if($gradeSubject[0]=='13') {
								$nodeSelect1for13=$nodeSelect1;
								if($p==6){
									if(in_array('1',$nodeSelect1for13)) {
										foreach ($nodeSelect1for13 as $key => $value) {
											if($value=='1'){
												array_splice($nodeSelect1for13,$key,1);
											}
										}
									}
								}
								
								if(in_array('4',$nodeSelect1for13)) {
									foreach ($nodeSelect1for13 as $key => $value) {
										if($value=='4'){
											array_splice($nodeSelect1for13,$key,1);
										}
									}
								}
								
								if(in_array('5',$nodeSelect1for13)) {
									foreach ($nodeSelect1for13 as $key => $value) {
										if($value=='5'){
											array_splice($nodeSelect1for13,$key,1);
										}
									}
								}
								
								$nodeSelectLen1=sizeof($nodeSelect1for13);
								$nodeSelectIndex1=rand(0,$nodeSelectLen1-1);
								$classList[$nodeSelect1for13[$nodeSelectIndex1]-1][$daySelect[$daySelectIndex]-1]=$gradeSubject[0];
								
								foreach($nodeSelect1 as $key => $value){
									if($value == $nodeSelect1for13[$nodeSelectIndex1]){
										array_splice($nodeSelect1,$key,1);					
									}
								}
								array_splice($nodeSelect1for13,$nodeSelectIndex1,1);
							}elseif($gradeSubject[0]=='1'||$gradeSubject[0]=='2'){
								$nodeSelect1for13=$nodeSelect1;
																
								if(in_array('5',$nodeSelect1for13)) {
									foreach ($nodeSelect1for13 as $key => $value) {
										if($value=='5'){
											array_splice($nodeSelect1for13,$key,1);
										}
									}
								}
								
								if(in_array('6',$nodeSelect1for13)) {
									foreach ($nodeSelect1for13 as $key => $value) {
										if($value=='6'){
											array_splice($nodeSelect1for13,$key,1);
										}
									}
								}
								
								if(in_array('7',$nodeSelect1for13)) {
									foreach ($nodeSelect1for13 as $key => $value) {
										if($value=='7'){
											array_splice($nodeSelect1for13,$key,1);
										}
									}
								}
								
								$nodeSelectLen1=sizeof($nodeSelect1for13);
								$nodeSelectIndex1=rand(0,$nodeSelectLen1-1);
								$classList[$nodeSelect1for13[$nodeSelectIndex1]-1][$daySelect[$daySelectIndex]-1]=$gradeSubject[0];
								
								foreach($nodeSelect1 as $key => $value){
									if($value == $nodeSelect1for13[$nodeSelectIndex1]){
										array_splice($nodeSelect1,$key,1);					
									}
								}
								array_splice($nodeSelect1for13,$nodeSelectIndex1,1);
							}else {
								$nodeSelectLen1=sizeof($nodeSelect1);
								$nodeSelectIndex1=rand(0,$nodeSelectLen1-1);
								$classList[$nodeSelect1[$nodeSelectIndex1]-1][$daySelect[$daySelectIndex]-1]=$gradeSubject[0];
								
								array_splice($nodeSelect1,$nodeSelectIndex1,1);
							}
							
							
							
							$gradeSubjectNum[0]-=1;
							foreach($gradeSubjectNum as $key => $value){
								if($value == '0'){
									array_splice($gradeSubject,0,1);//刪除科目數為0之索引				
									array_splice($gradeSubjectNum,0,1);						
								}
							}
							$check1+=1;
							if($check1==$nodeSelectCount1){
								foreach($daySelect as $key => $value){
									if($value == '1'){
										array_splice($daySelect,$key,1);//刪除科目數為0之索引
									}
								}
							}
							break;
					case 2:
							if($gradeSubject[0]=='13') {
								$nodeSelect2for13=$nodeSelect2;
								if($p==1){
									if(in_array('2',$nodeSelect2for13)) {
										foreach ($nodeSelect2for13 as $key => $value) {
											if($value=='2'){
												array_splice($nodeSelect2for13,$key,1);
											}
										}
									}
								}elseif($p==2){
									if(in_array('1',$nodeSelect2for13)) {
										foreach ($nodeSelect2for13 as $key => $value) {
											if($value=='1'){
												array_splice($nodeSelect2for13,$key,1);
											}
										}
									}
								}
								
								if(in_array('4',$nodeSelect2for13)) {
									foreach ($nodeSelect2for13 as $key => $value) {
										if($value=='4'){
											array_splice($nodeSelect2for13,$key,1);
										}
									}
								}
								
								if(in_array('5',$nodeSelect2for13)) {
									foreach ($nodeSelect2for13 as $key => $value) {
										if($value=='5'){
											array_splice($nodeSelect2for13,$key,1);
										}
									}
								}
								
								$nodeSelectLen2=sizeof($nodeSelect2for13);
								$nodeSelectIndex2=rand(0,$nodeSelectLen2-1);
								$classList[$nodeSelect2for13[$nodeSelectIndex2]-1][$daySelect[$daySelectIndex]-1]=$gradeSubject[0];
								
								foreach($nodeSelect2 as $key => $value){
									if($value == $nodeSelect2for13[$nodeSelectIndex2]){
										array_splice($nodeSelect2,$key,1);					
									}
								}
								array_splice($nodeSelect2for13,$nodeSelectIndex2,1);
							}elseif($gradeSubject[0]=='1'||$gradeSubject[0]=='2'){
								$nodeSelect2for13=$nodeSelect2;
																
								if(in_array('5',$nodeSelect2for13)) {
									foreach ($nodeSelect2for13 as $key => $value) {
										if($value=='5'){
											array_splice($nodeSelect2for13,$key,1);
										}
									}
								}
								
								if(in_array('6',$nodeSelect2for13)) {
									foreach ($nodeSelect2for13 as $key => $value) {
										if($value=='6'){
											array_splice($nodeSelect2for13,$key,1);
										}
									}
								}
								
								if(in_array('7',$nodeSelect2for13)) {
									foreach ($nodeSelect2for13 as $key => $value) {
										if($value=='7'){
											array_splice($nodeSelect2for13,$key,1);
										}
									}
								}
								
								$nodeSelectLen2=sizeof($nodeSelect2for13);
								$nodeSelectIndex2=rand(0,$nodeSelectLen2-1);
								$classList[$nodeSelect2for13[$nodeSelectIndex2]-1][$daySelect[$daySelectIndex]-1]=$gradeSubject[0];
								
								foreach($nodeSelect2 as $key => $value){
									if($value == $nodeSelect2for13[$nodeSelectIndex2]){
										array_splice($nodeSelect2,$key,1);					
									}
								}
								array_splice($nodeSelect2for13,$nodeSelectIndex2,1);
							}else{
								
								$nodeSelectLen2=sizeof($nodeSelect2);
								$nodeSelectIndex2=rand(0,$nodeSelectLen2-1);
								$classList[$nodeSelect2[$nodeSelectIndex2]-1][$daySelect[$daySelectIndex]-1]=$gradeSubject[0];
								array_splice($nodeSelect2,$nodeSelectIndex2,1);
							}
							
							$gradeSubjectNum[0]-=1;		
							foreach($gradeSubjectNum as $key => $value){
							if($value == '0'){
								array_splice($gradeSubject,0,1); //刪除科目數為0之索引
								array_splice($gradeSubjectNum,0,1);
							}
							}
							$check2+=1;
							if($check2==$nodeSelectCount2){
								foreach($daySelect as $key => $value){
									if($value == '2'){
										array_splice($daySelect,$key,1); //刪除科目數為0之索引
									}
								}
							}
							break;
					case 3:	
							if($gradeSubject[0]=='13') {
								$nodeSelect3for13=$nodeSelect3;
								if($p==5){
									if(in_array('1',$nodeSelect3for13)) {
										foreach ($nodeSelect3for13 as $key => $value) {
											if($value=='1'){
												array_splice($nodeSelect3for13,$key,1);
											}
										}
									}
								}
								
								if(in_array('4',$nodeSelect3for13)) {
									foreach ($nodeSelect3for13 as $key => $value) {
										if($value=='4'){
											array_splice($nodeSelect3for13,$key,1);
										}
									}
								}
								
								if(in_array('5',$nodeSelect3for13)) {
									foreach ($nodeSelect3for13 as $key => $value) {
										if($value=='5'){
											array_splice($nodeSelect3for13,$key,1);
										}
									}
								}
								
								$nodeSelectLen3=sizeof($nodeSelect3for13);
								$nodeSelectIndex3=rand(0,$nodeSelectLen3-1);
								$classList[$nodeSelect3for13[$nodeSelectIndex3]-1][$daySelect[$daySelectIndex]-1]=$gradeSubject[0];
								
								foreach($nodeSelect3 as $key => $value){
									if($value == $nodeSelect3for13[$nodeSelectIndex3]){
										array_splice($nodeSelect3,$key,1);					
									}
								}
								array_splice($nodeSelect3for13,$nodeSelectIndex3,1);
							}elseif($gradeSubject[0]=='1'||$gradeSubject[0]=='2'){
								$nodeSelect3for13=$nodeSelect3;
																
								if(in_array('5',$nodeSelect3for13)) {
									foreach ($nodeSelect3for13 as $key => $value) {
										if($value=='5'){
											array_splice($nodeSelect3for13,$key,1);
										}
									}
								}
								
								if(in_array('6',$nodeSelect3for13)) {
									foreach ($nodeSelect3for13 as $key => $value) {
										if($value=='6'){
											array_splice($nodeSelect3for13,$key,1);
										}
									}
								}
								
								if(in_array('7',$nodeSelect3for13)) {
									foreach ($nodeSelect3for13 as $key => $value) {
										if($value=='7'){
											array_splice($nodeSelect3for13,$key,1);
										}
									}
								}
								
								$nodeSelectLen3=sizeof($nodeSelect3for13);
								$nodeSelectIndex3=rand(0,$nodeSelectLen3-1);
								$classList[$nodeSelect3for13[$nodeSelectIndex3]-1][$daySelect[$daySelectIndex]-1]=$gradeSubject[0];
								
								foreach($nodeSelect3 as $key => $value){
									if($value == $nodeSelect3for13[$nodeSelectIndex3]){
										array_splice($nodeSelect3,$key,1);					
									}
								}
								array_splice($nodeSelect3for13,$nodeSelectIndex3,1);
							}else{
								
								$nodeSelectLen3=sizeof($nodeSelect3);
								$nodeSelectIndex3=rand(0,$nodeSelectLen3-1);
								$classList[$nodeSelect3[$nodeSelectIndex3]-1][$daySelect[$daySelectIndex]-1]=$gradeSubject[0];
								array_splice($nodeSelect3,$nodeSelectIndex3,1);
							}
							
							
							$gradeSubjectNum[0]-=1;
							
							foreach($gradeSubjectNum as $key => $value){
								if($value == '0'){
									array_splice($gradeSubject,0,1); //刪除科目數為0之索引
									array_splice($gradeSubjectNum,0,1);
								}
							}
							$check3+=1;
							if($check3==$nodeSelectCount3){
								foreach($daySelect as $key => $value){
									if($value == '3'){
									array_splice($daySelect,$key,1); //刪除科目數為0之索引
									}
								}
							}
							break;
					case 4:	
							if($gradeSubject[0]=='13') {
								$nodeSelect4for13=$nodeSelect4;
								if($p==4){
									if(in_array('1',$nodeSelect4for13)) {
										foreach ($nodeSelect4for13 as $key => $value) {
											if($value=='1'){
												array_splice($nodeSelect4for13,$key,1);
											}
										}
									}
									
									if(in_array('2',$nodeSelect4for13)) {
										foreach ($nodeSelect4for13 as $key => $value) {
											if($value=='2'){
												array_splice($nodeSelect4for13,$key,1);
											}
										}
									}
									
								}
								
								if(in_array('4',$nodeSelect4for13)) {
									foreach ($nodeSelect4for13 as $key => $value) {
										if($value=='4'){
											array_splice($nodeSelect4for13,$key,1);
										}
									}
								}
								
								if(in_array('5',$nodeSelect4for13)) {
									foreach ($nodeSelect4for13 as $key => $value) {
										if($value=='5'){
											array_splice($nodeSelect4for13,$key,1);
										}
									}
								}
								
								$nodeSelectLen4=sizeof($nodeSelect4for13);
								$nodeSelectIndex4=rand(0,$nodeSelectLen4-1);
								$classList[$nodeSelect4for13[$nodeSelectIndex4]-1][$daySelect[$daySelectIndex]-1]=$gradeSubject[0];
								
								foreach($nodeSelect4 as $key => $value){
									if($value == $nodeSelect4for13[$nodeSelectIndex4]){
										array_splice($nodeSelect4,$key,1);				 	
									}
								}
								array_splice($nodeSelect4for13,$nodeSelectIndex4,1);
							}elseif($gradeSubject[0]=='1'||$gradeSubject[0]=='2'){
								$nodeSelect4for13=$nodeSelect4;
																
								if(in_array('5',$nodeSelect4for13)) {
									foreach ($nodeSelect4for13 as $key => $value) {
										if($value=='5'){
											array_splice($nodeSelect4for13,$key,1);
										}
									}
								}
								
								if(in_array('6',$nodeSelect4for13)) {
									foreach ($nodeSelect4for13 as $key => $value) {
										if($value=='6'){
											array_splice($nodeSelect4for13,$key,1);
										}
									}
								}
								
								if(in_array('7',$nodeSelect4for13)) {
									foreach ($nodeSelect4for13 as $key => $value) {
										if($value=='7'){
											array_splice($nodeSelect4for13,$key,1);
										}
									}
								}
								
								$nodeSelectLen4=sizeof($nodeSelect4for13);
								$nodeSelectIndex4=rand(0,$nodeSelectLen4-1);
								$classList[$nodeSelect4for13[$nodeSelectIndex4]-1][$daySelect[$daySelectIndex]-1]=$gradeSubject[0];
								
								foreach($nodeSelect4 as $key => $value){
									if($value == $nodeSelect4for13[$nodeSelectIndex4]){
										array_splice($nodeSelect4,$key,1);					
									}
								}
								array_splice($nodeSelect4for13,$nodeSelectIndex4,1);
							}else{
								
								$nodeSelectLen4=sizeof($nodeSelect4);
								$nodeSelectIndex4=rand(0,$nodeSelectLen4-1);
								$classList[$nodeSelect4[$nodeSelectIndex4]-1][$daySelect[$daySelectIndex]-1]=$gradeSubject[0];
								array_splice($nodeSelect4,$nodeSelectIndex4,1);
							}
							
							
							$gradeSubjectNum[0]-=1;
							foreach($gradeSubjectNum as $key => $value){
							if($value == '0'){
								array_splice($gradeSubject,0,1);//刪除科目數為0之索引
								array_splice($gradeSubjectNum,0,1);
							}
							}
							$check4+=1;
							if($check4==$nodeSelectCount4){
								foreach($daySelect as $key => $value){
									if($value == '4'){
									array_splice($daySelect,$key,1);//刪除科目數為0之索引
									}
								}
							}
							break;
					case 5:	
							if($gradeSubject[0]=='13') {
								$nodeSelect5for13=$nodeSelect5;
								if($p==3){
									if(in_array('1',$nodeSelect5for13)) {
										foreach ($nodeSelect5for13 as $key => $value) {
											if($value=='1'){
												array_splice($nodeSelect5for13,$key,1);
											}
										}
									}
								}
								
								if(in_array('4',$nodeSelect5for13)) {
									foreach ($nodeSelect5for13 as $key => $value) {
										if($value=='4'){
											array_splice($nodeSelect5for13,$key,1);
										}
									}
								}
								
								if(in_array('5',$nodeSelect5for13)) {
									foreach ($nodeSelect5for13 as $key => $value) {
										if($value=='5'){
											array_splice($nodeSelect5for13,$key,1);
										}
									}
								}
								
								$nodeSelectLen5=sizeof($nodeSelect5for13);
								$nodeSelectIndex5=rand(0,$nodeSelectLen5-1);
								$classList[$nodeSelect5for13[$nodeSelectIndex5]-1][$daySelect[$daySelectIndex]-1]=$gradeSubject[0];
								foreach($nodeSelect5 as $key => $value){
									if($value == $nodeSelect5for13[$nodeSelectIndex5]){
										array_splice($nodeSelect5,$key,1);					
									}
								}
								array_splice($nodeSelect5for13,$nodeSelectIndex5,1);
							}elseif($gradeSubject[0]=='1'||$gradeSubject[0]=='2'){
								$nodeSelect5for13=$nodeSelect5;
																
								if(in_array('5',$nodeSelect5for13)) {
									foreach ($nodeSelect5for13 as $key => $value) {
										if($value=='5'){
											array_splice($nodeSelect5for13,$key,1);
										}
									}
								}
								
								if(in_array('6',$nodeSelect5for13)) {
									foreach ($nodeSelect5for13 as $key => $value) {
										if($value=='6'){
											array_splice($nodeSelect5for13,$key,1);
										}
									}
								}
								
								if(in_array('7',$nodeSelect5for13)) {
									foreach ($nodeSelect5for13 as $key => $value) {
										if($value=='7'){
											array_splice($nodeSelect5for13,$key,1);
										}
									}
								}
								
								$nodeSelectLen5=sizeof($nodeSelect5for13);
								$nodeSelectIndex5=rand(0,$nodeSelectLen5-1);
								$classList[$nodeSelect5for13[$nodeSelectIndex5]-1][$daySelect[$daySelectIndex]-1]=$gradeSubject[0];
								
								foreach($nodeSelect5 as $key => $value){
									if($value == $nodeSelect5for13[$nodeSelectIndex5]){
										array_splice($nodeSelect5,$key,1);					
									}
								}
								array_splice($nodeSelect5for13,$nodeSelectIndex5,1);
							}else{
								$nodeSelectLen5=sizeof($nodeSelect5);
								$nodeSelectIndex5=rand(0,$nodeSelectLen5-1);
								$classList[$nodeSelect5[$nodeSelectIndex5]-1][$daySelect[$daySelectIndex]-1]=$gradeSubject[0];
								array_splice($nodeSelect5,$nodeSelectIndex5,1);
							}
							
							$gradeSubjectNum[0]-=1;
							foreach($gradeSubjectNum as $key => $value){
								if($value == '0'){
									array_splice($gradeSubject,0,1);//刪除科目數為0之索引
									array_splice($gradeSubjectNum,0,1);
								}
							}

							$check5+=1;
							if($check5==$nodeSelectCount5){
								foreach($daySelect as $key => $value){
									if($value == '5'){
									array_splice($daySelect,$key,1);//刪除科目數為0之索引
									}
								}
							}
							break;
				}
			}

            return $classList;
    }

    function printClassList($classList, $p, $q) {
        echo '<br/>';
			echo '<table>';
			for($i=0;$i<7;$i++){
				echo '<tr>';
				for($j=0;$j<5;$j++){
					echo '<td>';
					$sql8="SELECT `subjectName` FROM `subject_info` WHERE `subjectNum`=".$classList[$i][$j];
					$result8=mysql_query($sql8);
					$row8=mysql_fetch_array($result8);
					echo $row8[0];

					$sql7="INSERT INTO `class_time_info` VALUES (0,'". $j ."','". $i ."','".$classList[$i][$j]."','".$p."0".$q."')";
					mysql_query($sql7);	
					echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
					echo '<td>';
				}
				echo '</tr>';				
			}
			echo '</table>';			
			echo '<br/><br/>';
    }
?>