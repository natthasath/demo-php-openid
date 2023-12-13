<?php

	// ในกรณีที่ให้ user อยู่หน้า OpenID
	header('Location: http://govid.egov.go.th/Logout.aspx');
	
	//ในกรณีที่ให้ user กลับไปยังระบบเดิม
	//โดย สรอ. จะขอให้ลงทะเบียน domain กับสรอ. ก่อนเพื่อให้มั่นใจได้ว่าเว็บปลายทางนั้นผ่านการ
	//ตรวจสอบโดย สรอ. แล้ว ถ้าเว็บยังไม่ผ่านการตรวจสอบ user จะอยู่ที่หน้า OpenID
	header('Location: http://govid.egov.go.th/Logout.aspx?returnUrl=http://xxxxx.xx.xx');
?>