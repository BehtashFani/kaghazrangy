<?php 
include 'header.php';
$message .= '
	'.EMAIL_GREETING.' '.$data['to_username'].', '.$data['from_username'].' '.EMAIL_MESSAGE_INTRO.'
	<table width="500" align="center" style="margin-top:15px;background:#ececec;padding:20px;border:1px solid #b2b4c4;">
		<tr>
			<td width="86" valign="top">
				<img src="'.$data['from_avatar'].'" width="80" height="80" />
			</td>
			<td width="363">
				<span style="font-family:Helvetica;color:00599e;font-size:16px;">'.$data['from_username'].'</span><br />
				<span style="font-family:Helvetica;color:#414141;font-weight:bold;">'.$data['message_title'].'</span><br />
				<span style="font-family:Helvetica;color:#414141;">'.$data['message'].'</span>
			</td>
		</tr>
		<tr>
			<td>
			</td>
			<td style="text-align:right;">
				<div align="right">
					<div style="background:#d6d5d5;padding:5px;width:150px;text-align:center;border:1px solid #b1b1b1;font-size:14px;margin-top:10px;">
						<a href="'.$data['message_url'].'" style="color:#000;">'.EMAIL_OPEN_MESSAGES.'</a>
					</div>
				</div>
			</td>
		</tr>
	</table>
'; 
include 'footer.php';
?>