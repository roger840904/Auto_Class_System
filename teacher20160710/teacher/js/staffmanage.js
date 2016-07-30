function deleteTeacherInfo(id) {
	let xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            if (xhttp.responseText == 'fail') {
                alert('刪除失敗');
            } else {
                alert('刪除成功');
                window.location.reload();
            }
        }
	};
	xhttp.open('POST', 'staff_info_delete.php', true);
	xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhttp.send('tid=' + id);
}

function updateTeacherInfo(dataCol, dataRow, newValue) {
	let xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function () {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			if (xhttp.responseText == 'fail') {
				alert('更新失敗');
				window.location.reload();
			}
		}
	};
	xhttp.open('POST', 'staff_info_update.php', true);
	xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhttp.send('dataCol=' + dataCol + '&dataRow=' + dataRow + '&value=' + newValue);
}