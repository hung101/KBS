<?php
/**
 * Sample service desk emulator / integration for demo purposes
 *
 * PHP versions 4 and 5
 *
 * LICENSE: This source file is subject to version 3.0 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_0.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category   Tutorial
 * @package    de.fnt.pai.servicedeskemulator
 * @author     Thomas Rauch <thomas.rauch@fntsoftware.com>
 * @copyright  2014-2015 FNT GmbH
 * @license    http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version    1.2
 */
?>
<html>
<head>
	<title>Servicedesk Emulator</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<link href="screen.css" type="text/css" rel="stylesheet" media="screen">
	<link href="print.css" type="text/css" rel="stylesheet" media="print">
	<link rel="shortcut icon" href="favicon.ico">
<link rel="icon" href="favicon.ico" type="image/x-icon">
</head>
<body>
	<img src="fnt.jpg" width="260" alt="FNT">
	<br/>
	<h3>Servicedesk Emulator</h3><br/>
<?php

class LoginInType
{
	// Name of a valid user
    public $username;   
	// Password of the user
	public $password;	
}

class SetActiveMandantInType
{	
    public $sessionId;   	
	public $mandantId;	
	public $userGroupId;	
	public $ugType;	
}

class CreateObjectInType 
{
	public $sessionId; 	
	public $className;	
	public $objectAttributes;
}

class CreateLinkInType 
{
	public $sessionId; 	
	public $parentElid;	
	public $childElid;	
	public $linkTableName;
}


class SearchObjectsInType
{	
    public $sessionId;   	
	public $table;	
	public $caseSensitive;	
	public $limitedResult;	
	public $restrictions;	
	public $resultColumns;	
	public $sortColumns;	
}

class ciClasses
{	
    public $tableName;   	
	public $className;		
}


class LogoutInType {

	// ID of a valid and active session
	public $sessionId;
}


function login ($username, $password, $instance)
{	
	try {
		$client = new SoapClient((String) $instance.'/axis/services/UserApiWS?wsdl');
		$loginIn = new LoginInType();
		$loginIn->username = $username;
		$loginIn->password = $password;
		
		$result = $client->login($loginIn);
		$sessionId = $result["outParam"]->sessionId; 			
		
		return $sessionId;
	} catch (SoapFault $e) {
		print($e->detail->cmdException->enc_value->errorMessage);
	}
}

function setActiveMandant ($sessionId, $mandantId, $userGroupId, $ugType, $instance) {

	// set active mandant	
	$setActiveMandantIn = new SetActiveMandantInType();
	$setActiveMandantIn->sessionId = (String) $sessionId;
	$setActiveMandantIn->mandantId = (String) $mandantId;
	$setActiveMandantIn->userGroupId = (String) $userGroupId;
	$setActiveMandantIn->ugType = (String) $ugType;

	//$client = new SoapClient($_POST['endpoint']);
	$client = new SoapClient((String) $instance.'/axis/services/UserApiWS?wsdl');

	try {
		$result = $client->setActiveMandant($setActiveMandantIn);
	} catch (SoapFault   $e) {
		print($e->detail->cmdException->enc_value->errorMessage);				
	}		
}

function getCiClasses ($sessionId, $instance) {

	$arr = array();
	try {
		$setSearchObjectsIn = new SearchObjectsInType();

		$setSearchObjectsIn->sessionId = (String) $sessionId; 	
		$setSearchObjectsIn->table = (String) 'STCSCM_TABLE c';	
		$setSearchObjectsIn->caseSensitive = (String) 'false';	
		$setSearchObjectsIn->limitedResult = (String) 'false';	
		$setSearchObjectsIn->restrictions[0]['attributeName']= (String) 'c.CI_CLASS';
		$setSearchObjectsIn->restrictions[0]['restriction']['operator'] = (String) '=';
		$setSearchObjectsIn->restrictions[0]['restriction']['value'] = (String) 'Y';
		$setSearchObjectsIn->resultColumns[0] = (String) 'c.table_name, (select msg_text from stfsys_msg_catalog  where catalog_name = c.catalog_name and msg_id = c.msg_id and lang = \'en_US\') table_desc';	
		$setSearchObjectsIn->sortColumns[0]['columnName'] = (String) 'table_desc';	
		$setSearchObjectsIn->sortColumns[0]['order'] = (String) 'asc';	
		
		$client = new SoapClient((String) $_POST['command'].'/axis/services/GenericApiWS?wsdl');	
		$result = $client->searchObjects($setSearchObjectsIn);		

		$i = 0;	
		foreach ($result['outParam']->result as $value) {
			$arr[$i]['tableName'] = $value->columnData[0] ;
			$arr[$i]['tableDesc'] = $value->columnData[1] ;					
			$i++;
		}
		
	} catch (SoapFault   $e) {
		print($e->detail->cmdException->enc_value->errorMessage);
	}
	return $arr;
}

function getCis ($sessionId, $instance, $tenant) {

	$arr = array();
	try {
		$setSearchObjectsIn = new SearchObjectsInType();

		$setSearchObjectsIn->sessionId = (String) $sessionId; 	
		$setSearchObjectsIn->table = (String) 'META_CI_ALL c left join META_ELEMENT e on (c.INTERNAL_ID = e.ELID)';	
		$setSearchObjectsIn->caseSensitive = (String) 'false';	
		$setSearchObjectsIn->limitedResult = (String) 'false';	
		$setSearchObjectsIn->restrictions[0]['attributeName']= (String) 'c.TABLE_NAME';
		$setSearchObjectsIn->restrictions[0]['restriction']['operator'] = (String) '=';
		$setSearchObjectsIn->restrictions[0]['restriction']['value'] = (String) $_POST['ciClass'];
		$setSearchObjectsIn->restrictions[1]['attributeName']= (String) 'e.MAN_ID';
		$setSearchObjectsIn->restrictions[1]['restriction']['operator'] = (String) '=';
		$setSearchObjectsIn->restrictions[1]['restriction']['value'] = $tenant;
		
		$setSearchObjectsIn->resultColumns[0] = (String) 'c.INTERNAL_ID';	
		$setSearchObjectsIn->resultColumns[1] = (String) 'c.ID';	

		$setSearchObjectsIn->sortColumns[0]['columnName'] = (String) 'c.ID';	
		$setSearchObjectsIn->sortColumns[0]['order'] = (String) 'asc';	

		$client = new SoapClient((String) $_POST['command'].'/axis/services/GenericApiWS?wsdl');	
		$result = $client->searchObjects($setSearchObjectsIn);		

		$i = 0;	
		foreach ($result['outParam']->result as $value) {
			$arr[$i]['id'] = $value->columnData[1] ;
			$arr[$i]['elid'] = $value->columnData[0] ;					
			$i++;
		}
		
		return $arr;
	} 
	catch (SoapFault   $e) {
		print($e->detail->cmdException->enc_value->errorMessage);
	}
}

function getDataDictionaryId ($sessionId, $instance, $name) {

	try {
		$setSearchObjectsIn = new SearchObjectsInType();

		$setSearchObjectsIn->sessionId = (String) $sessionId; 	
		$setSearchObjectsIn->table = (String) 'stfcfg_dd_main';	
		$setSearchObjectsIn->caseSensitive = (String) 'false';	
		$setSearchObjectsIn->limitedResult = (String) 'false';	
		$setSearchObjectsIn->restrictions[0]['attributeName']= (String) 'dd_name';
		$setSearchObjectsIn->restrictions[0]['restriction']['operator'] = (String) '=';
		$setSearchObjectsIn->restrictions[0]['restriction']['value'] = (String) $name;
		$setSearchObjectsIn->resultColumns[0] = (String) 'DDID';	
		
		$client = new SoapClient((String) $_POST['command'].'/axis/services/GenericApiWS?wsdl');	
		$result = $client->searchObjects($setSearchObjectsIn);		
		$ddid = $result['outParam']->result[0]->columnData[0] ;
	
		return $ddid;		
		
	} catch (SoapFault   $e) {
		print($e->detail->cmdException->enc_value->errorMessage);
	}
}
function getDataDictionaryEntries ($sessionId, $instance, $dataDictionaryId)  {
	
	try {
		$ddid = getDataDictionaryId ($sessionId, $instance, $dataDictionaryId);
	
		$setSearchObjectsIn = new SearchObjectsInType();

		$setSearchObjectsIn->sessionId = (String) $sessionId; 	
		$setSearchObjectsIn->table = (String) 'stfcfg_dd_value c';	
		$setSearchObjectsIn->caseSensitive = (String) 'false';	
		$setSearchObjectsIn->limitedResult = (String) 'false';	
		$setSearchObjectsIn->restrictions[0]['attributeName']= (String) 'c.DDID';
		$setSearchObjectsIn->restrictions[0]['restriction']['operator'] = (String) '=';
		$setSearchObjectsIn->restrictions[0]['restriction']['value'] = (String) $ddid;
		$setSearchObjectsIn->resultColumns[0] = (String) 'c.dd_value, (select msg_text from stfsys_msg_catalog  where catalog_name = c.catalog_name and msg_id = c.msg_id and lang = \'en_US\') statustext';	
		$setSearchObjectsIn->sortColumns[0]['columnName'] = (String) 'statustext';	
		$setSearchObjectsIn->sortColumns[0]['order'] = (String) 'asc';	
		
		$client = new SoapClient((String) $_POST['command'].'/axis/services/GenericApiWS?wsdl');	
		$result = $client->searchObjects($setSearchObjectsIn);		
	
		$i = 0;	
		foreach ($result['outParam']->result as $value) {
			$ddStatus[$i]['num'] = $value->columnData[0] ;
			$ddStatus[$i]['text'] = $value->columnData[1] ;					
			$i++;
		}
		return $ddStatus;
		
	} catch (SoapFault   $e) {
		print($e->detail->cmdException->enc_value->errorMessage);
	}
}

function createTicket ($ticketId, $ticketType, $ticketStatus, $description, $reporter, $ciElid, $sessionId, $instance) {
	try {
	
		$createObjectIn = new CreateObjectInType();

		$createObjectIn->sessionId = (String) $sessionId; 	
		$createObjectIn->className = (String) 'STCCBA_EXTERNAL_TICKET';	
		$createObjectIn->objectAttributes[0]['key'] = (String) 'VISIBLE_ID';
		$createObjectIn->objectAttributes[0]['value'] = (String) $ticketId;
		$createObjectIn->objectAttributes[1]['key'] = (String) 'ID';
		$createObjectIn->objectAttributes[1]['value'] = (String) $ticketId;
		$createObjectIn->objectAttributes[2]['key'] = (String) 'DESCRIPTION';
		$createObjectIn->objectAttributes[2]['value'] = (String) $description;
		$createObjectIn->objectAttributes[3]['key'] = (String) 'EXTERNAL_SYSTEM';
		$createObjectIn->objectAttributes[3]['value'] = (String) 'SERVICEDESK';
		$createObjectIn->objectAttributes[4]['key'] = (String) 'TYPE';
		$createObjectIn->objectAttributes[4]['value'] = (String) $ticketType;
		$createObjectIn->objectAttributes[5]['key'] = (String) 'TICKET_STATUS';
		$createObjectIn->objectAttributes[5]['value'] = (String) $ticketStatus;
		$createObjectIn->objectAttributes[6]['key'] = (String) 'REPORTER';
		$createObjectIn->objectAttributes[6]['value'] = (String) $reporter;
		
		$client = new SoapClient((String) $_POST['command'].'/axis/services/GenericApiWS?wsdl');	
		
		$result = $client->createObject($createObjectIn);				
		$ticketElid = $result["outParam"]->objectElid; 					
		
		
	} catch (SoapFault   $e) {
		print($e->detail->cmdException->enc_value->errorMessage);
	}
	
	try {
	
		$createLinkIn = new CreateLinkInType();

		$createLinkIn->sessionId = (String) $sessionId; 	
		$createLinkIn->parentElid = (String) $ciElid;	
		$createLinkIn->childElid = (String) $ticketElid;
		$createLinkIn->linkTableName = (String) 'STLCBA_LCM_LINK';
		
		$client = new SoapClient((String) $_POST['command'].'/axis/services/GenericApiWS?wsdl');	

		$result = $client->createLink($createLinkIn);				
		
		
	} catch (SoapFault   $e) {
		print($e->detail->cmdException->enc_value->errorMessage);
	}
	
	return $ticketElid;
}	

function logout ($sessionId, $instance) {	
	try {
		$client = new SoapClient((String) $instance.'/axis/services/UserApiWS?wsdl');
		$logoutIn = new LogoutInType();
		$logoutIn->sessionId = (String) $sessionId;	
		$result = $client->logout($logoutIn);		
	} catch (SoapFault   $e) {
		print($e->detail->cmdException->enc_value->errorMessage);
	}	
}

if ($_POST!=null){

	if ($_POST['side']=='ciClasses') {
	
		// get instance and sessionId
		$instance = (String) $_POST['command'];
		$sessionId = login((String) $_POST['username'], (String) $_POST['password'], $instance);
		$tenant = (String) $_POST['tenant'];
		if ($sessionId!=null) {
			
			setActiveMandant((String) $sessionId, (String) $_POST['tenant'], (String) $_POST['usergroup'], (String) 'G', $instance);			
			$arr = getCiClasses ($sessionId, $instance);
			
			echo "<form id=\"ciSearch\" action=\"servicedesk_emulator.php\" method=\"post\">";		  
			echo "<br/>";
			
			// headline
			echo "Please choose a ci class";
			
			echo "<br/>";
			echo "<br/>";
			echo "<table>";
			
			// ci classes
			echo "<tr><td width=\"100\">CI Class:</td><td><select id=\"ciClass\" name=\"ciClass\">";			
			foreach ($arr as $value) {					
				  echo "<option value=\"".$value['tableName']."\">".$value['tableDesc']."</option>";
			}			
			echo "</select></td></tr>";
			
			echo "</table>";
			echo "<br/>";
			
			// submit button
			echo "<input id=\"submit\" name=\"submit\" type=\"submit\" value=\"Next\" />";
			
			// hidden fields
			echo "<input id=\"sessionId\" name=\"sessionId\" type=\"hidden\" value=\"".$sessionId."\" />";
			echo "<input id=\"tenant\" name=\"tenant\" type=\"hidden\" value=\"".$tenant."\" />";
			echo "<input id=\"side\" name=\"side\" size=\"80\" type=\"hidden\" value=\"ticketData\" />";
			echo "<input id=\"command\" name=\"command\" type=\"hidden\" value=\"".$_POST['command']."\" />";
			
			echo "</form>";
				
		}
	}
	else if ($_POST['side']=='ticketData') {
	
		// get instance and sessionId
		$sessionId = $_POST['sessionId'];
		$instance = (String) $_POST['command'];

		$tenant = (String) $_POST['tenant'];
		$ciArr = getCis($sessionId, $instance, $tenant);

		// get ticket status		
		$ddStatus = getDataDictionaryEntries ($sessionId, $instance, 'SDDLCM_EXTERNAL_TICKET_STATUS');
		$ddTypes = getDataDictionaryEntries ($sessionId, $instance, 'SDDLCM_EXTERNAL_TICKET_TYPES');


		echo "<form id=\"ciSearch\" action=\"servicedesk_emulator.php\" method=\"post\">";

		echo "<br/>";
		
		// headline
		echo "Please enter your ticket details.";
		echo "<br/>";
		echo "<br/>";
		echo "<table>";
		
		// cis
		echo "<tr><td width=\"100\">CI:</td><td><select id=\"ci\" name=\"ci\">";			
		foreach ($ciArr as $value) {					
			echo "<option value=\"".$value['id']."\">".$value['elid']."</option>";
		}
		echo "</select></td></tr>";
		
		// ticket id
		echo "<tr><td>Ticket ID:</td><td><input id=\"ticketId\" name=\"ticketId\" size=\"80\" type=\"text\" value=\"TICKET-001\" /></td></tr>";

		// ticket types
		echo "<tr><td width=\"100\">Ticket type:</td><td><select id=\"ticketType\" name=\"ticketType\">";	
		foreach ($ddTypes as $value) {					
			echo "<option value=\"".$value['num']."\">".$value['text']."</option>";
		}
		echo "</select></td></tr>";

		// ticket status
		echo "<tr><td width=\"100\">Ticket status:</td><td><select id=\"ticketStatus\" name=\"ticketStatus\">";	
		foreach ($ddStatus as $value) {					
			echo "<option value=\"".$value['num']."\">".$value['text']."</option>";
		}
		echo "</select></td></tr>";
		
		// reporter
		echo "<tr><td>Reporter:</td><td><input id=\"reporter\" name=\"reporter\" size=\"80\" type=\"text\" value=\"\" /></td></tr>";
		
		// description
		echo "<tr><td>Description:</td><td><input id=\"description\" name=\"description\" size=\"80\" type=\"text\" value=\"\" /></td></tr>";
		
		// hidden fields
		echo "<input id=\"externalSystem\" name=\"externalSystem\" type=\"hidden\" value=\"SERVICEDESK\" />";
		echo "<input id=\"sessionId\" name=\"sessionId\" type=\"hidden\" value=\"".$sessionId."\" />";
		echo "<input id=\"tenant\" name=\"tenant\" type=\"hidden\" value=\"".$tenant."\" />";		
		echo "<input id=\"side\" name=\"side\" size=\"80\" type=\"hidden\" value=\"create\" />";
		echo "<input id=\"command\" name=\"command\" type=\"hidden\" value=\"".$_POST['command']."\" />";
		
		echo "</table>";
		echo "<br/>";

		// submit button
		echo "<input id=\"submit\" name=\"submit\" type=\"submit\" value=\"Next\" />";

		echo "</form>";
				
	}	
	else {	
		// get instance and sessionId
		$sessionId = $_POST['sessionId'];
		$instance = (String) $_POST['command'];
		$ciElid = $_POST['ci'];

		$ticketElid = createTicket ($_POST['ticketId'], $_POST['ticketType'], $_POST['ticketStatus'], $_POST['description'], $_POST['reporter'], $ciElid, $sessionId, $instance);
		
		echo "<a href=".$instance."/axis/servlet/CommandLauncher?elid=".$ticketElid."&action=lcm".">Open new ticket in Command >></a>";
		
		// logout
		logout($sessionId, $_POST['command']);		
	}
}
else {
	if($_GET!=null) {
	echo "This page would open the ticket:<br/><br/> <b>".$_GET['sys_taskref']."</b>";
}
else {

?>
  <form id="commandlogin" action="servicedesk_emulator.php" method="post">
    Please enter your username and password.
	<br/><br/>
	<table>
	<tr><td width="100">Username:</td><td><input id="username" name="username" size="30" type="text" value="command" /></td></tr>
    <tr><td>Password:</td><td><input id="password" name="password" size="30" type="text" value="command" /></td></tr>
    <tr><td>Tenant id:</td><td><input id="tenant" name="tenant" size="30" type="text" value="1001" /></td></tr>
 	<tr><td>Usergroup:</td><td><input id="usergroup" name="usergroup" size="30" type="text" value="Administrator" /></td></tr>
	<tr><td>Command:</td><td><input id="command" name="command" size="30" type="text" value="http://localhost:8080" /></td></tr>
 	<input id="side" name="side" size="80" type="hidden" value="ciClasses" />
 	
	</table>
	
	<br/>

	<input id="submit" name="submit" type="submit" value="Next" />
  </form>
<?php
}
}
?>
  </body>
  </html>
