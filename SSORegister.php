<?session_start();
			include("../kcontrol/lib/config.php");	
			//require_once("../kcontrol/lib/connect.php");
			//require_once("../kcontrol/lib/function.php")
			 //echo $ses_accessToken;
			 //exit();
			require_once("Thaigov_SSOLibrary.php"); 		
			require_once("common.php");
			$memberType = 1; 

			$profile = GetMemberInfo($_SESSION['ses_accessToken'],$OpenIdProviderUrl); 	
//exit();
				$_SESSION["sreg_email"]=$profile->email;
				$_SESSION["sreg_firstname"]=$profile->firstname;
				$_SESSION["sreg_lastname"]=$profile->lastname;
				$_SESSION["sreg_occupation"]=$profile->occupation;
				$_SESSION["sreg_province"]=$profile->address->province;
				$_SESSION["sreg_district"]=$profile->address->district;
				$_SESSION["sreg_subdistrict"]=$profile->address->subdistrict;
				$_SESSION["sreg_geocode"]=$profile->address->geocode;
				$_SESSION["sreg_membertype"]=$profile->membertype;


				$_SESSION["sreg_title"]=$profile->title;
				$_SESSION["sreg_dateofbirth"]=$profile->dateofbirth;
				$_SESSION["sreg_sex"]=$profile->sex;
				$_SESSION["sreg_nationality"]=$profile->nationality;
				$_SESSION["sreg_telephone"]=$profile->telephone;
				$_SESSION["sreg_mobile"]=$profile->mobile;
				$_SESSION["sreg_fax"]=$profile->fax;

			
				$_SESSION["sreg_housenumber"]=$profile->address->housenumber;
				$_SESSION["sreg_village"]=$profile->address->village;
				$_SESSION["sreg_soi"]=$profile->address->soi;
				$_SESSION["sreg_road"]=$profile->address->road;
				$_SESSION["sreg_soi"]=$profile->address->soi;
				$_SESSION["sreg_postcode"]=$profile->address->postcode;

				$_SESSION["sreg_identification_code"]=$profile->identification->code;
				$_SESSION["sreg_identification_issuedby"]=$profile->identification->issuedby;
				$_SESSION["sreg_identification_issueddate"]=$profile->identification->issueddate;
				$_SESSION["sreg_identification_expirydate"]=$profile->identification->expirydate;

			    session_register("sreg_firstname");
				session_register("sreg_lastname");
				session_register("sreg_email");
				session_register("sreg_occupation");
				session_register("sreg_province");
				session_register("sreg_district");
				session_register("sreg_subdistrict");
				session_register("sreg_geocode");
				session_register("sreg_membertype");

				session_register("sreg_title");
				session_register("sreg_dateofbirth");
				session_register("sreg_sex");
				session_register("sreg_nationality");
				session_register("sreg_telephone");
				session_register("sreg_mobile");
				session_register("sreg_fax");

				session_register("sreg_housenumber");
				session_register("sreg_village");
				session_register("sreg_soi");
				session_register("sreg_road");
				session_register("sreg_postcode");

				session_register("sreg_identification_code");
				session_register("sreg_identification_issuedby");
				session_register("sreg_identification_issueddate");
				session_register("sreg_identification_expirydate");
							// print_r($_SESSION);					
							//	   exit();
			/////////////////////////////////////////////////////////////////
			$conn=mysql_connect($System_DataBase_HostName,$System_DataBase_UserName,$System_DataBase_Password);
			mysql_select_db($System_DataBase_Name,$conn);
			mysql_query("SET NAMES TIS620");
			 $sql="select   *   from bangkok_mod_member  where bangkok_mod_member_CardNo ='".$profile->identification->code."' ";
			$result=mysql_query($sql);
			$num=mysql_num_rows($result);  
			//echo $num;
			if ($num > 0)
			{																									
												$Row=mysql_fetch_array($result);
												$ActivateStatus=$Row["bangkok_mod_member_ActivateStatus"];
												$Status=$Row["bangkok_mod_member_Status"];												
											
												if(($ActivateStatus=="Enable")&&($Status=="Enable")){
															$_SESSION["session_webmember_id"]=$Row["bangkok_mod_member_ID"];
															$_SESSION["session_webmember_fullname"]=$Row["bangkok_mod_member_FirstName"]."  ".$Row["bangkok_mod_member_LastName"];
													echo 		$_SESSION["session_webmember_username"]=trim($Row["bangkok_mod_member_Username"]);
															$_SESSION["session_webmember_logerror"]="";
														header("location:../th/home/registered_list.php");
												}
												else
												{
													header("location:../th/home/registered_list.php");											
												}
			}
			else if ($num==0)
			{
				
												 // register												
												 ?>
												 <script>
												     location.href='http://tp.bangkok.go.th/th/member/register_member2.php';
												 </script>
												 <?
			}
			/////////////////////////////////////////////////////////////////


/*	require_once("Thaigov_SSOLibrary.php"); 		
	$memberType = 1; 
	$profile = GetMemberInfo($ses_accessToken, $memberType); 	
	echo $profile->firstname;
	echo $profile->lastname;
	echo $profile->identification->code
*/

?> 
