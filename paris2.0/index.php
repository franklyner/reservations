<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<div align="center">
  <form name="form1" method="post" action="actions/start_session.php">
    <p>
      <input type="hidden" name="month" value="<? echo date("m");?>">
    </p>
    <p>&nbsp; </p>
    <p>&nbsp; </p>
    <table width="30%" border="0" cellspacing="5" cellpadding="5">
      <tr>
        <td>Login:</td>
        <td>
          <input type="text" name="login">
        </td>
      </tr>
      <tr>
        <td>Passwort:</td>
        <td>
          <input type="password" name="password">
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td> 
          <div align="center">
            <input type="submit" name="Submit" value="Submit">
          </div>
        </td>
      </tr>
    </table><p>&nbsp;</p>
  </form>
</div>
</body>
</html>
