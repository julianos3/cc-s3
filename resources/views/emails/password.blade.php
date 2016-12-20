<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <title>Bem Vindo - Central Condo</title>

    <style type="text/css">
        .ReadMsgBody {width: 100%; background-color: #ffffff;}
        .ExternalClass {width: 100%; background-color: #ffffff;}
        body	 {width: 100%; background-color: #000; margin:0; padding:0; -webkit-font-smoothing: antialiased;font-family: Georgia, Times, serif}
        table {border-collapse: collapse;}
        a *{color: #FFFFff; text-decoration: none;}

        @media only screen and (max-width: 640px)  {
            body[yahoo] .deviceWidth {width:440px!important; padding:0;}
            body[yahoo] .center {text-align: center!important;}
        }

        @media only screen and (max-width: 479px) {
            body[yahoo] .deviceWidth {width:280px!important; padding:0;}
            body[yahoo] .center {text-align: center!important;}
        }

    </style>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" yahoo="fix" style="font-family: Arial;">
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr>
        <td width="100%" valign="top" bgcolor="#d0d0d0" style="padding-top:20px">
            <table width="580" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth" style="margin:0 auto;">
                <tr>
                    <td width="100%" bgcolor="#ffffff">
                        <table border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                            <tr>
                                <td style="padding:20px" class="center">
                                    <a href="http://www.centralcondo.com.br" title="Central Condo">
                                        <img src="http://localhost:8000/portal/assets/images/email/logo.png" style="display: block;" alt="Central Condo" title="Central Condo" border="0" />
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>

            <table width="580"  class="deviceWidth" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#d0d0d0" style="margin:0 auto;">
                <tr>
                    <td valign="middle" align="center" bgcolor="#ffffff">
                        <a href="http://www.centralcondo.com.br" title="Central Condo">
                            <img  class="deviceWidth" src="http://localhost:8000/portal/assets/images/email/recuperacao-senha.png" alt="Recuperação de Senha" title="Recuperação de Senha" border="0" style="display: block;" />
                        </a>
                    </td>
                </tr>
            </table>

            <table width="580" class="deviceWidth" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#d0d0d0" style="margin:0 auto;">
                <tr>
                    <td valign="middle" align="center" style="padding:10px; color: #9a9b9f; font-size: 1.2em;" bgcolor="#ffffff">
                        <p style="font-size: 1.4em;"><strong>Prezado Usuário</strong></p>
                        <p>
                            Conforme sua solicitação, segue abaixo o link<br />
                            para a recuperação de sua senha de acesso.
                        </p>
                    </td>
                </tr>
            </table>

            <table width="580" height="100" class="deviceWidth" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#d0d0d0" style="margin:0 auto;">
                <tr>
                    <td valign="middle" align="center" style="padding:10px; color: #9a9b9f; font-size: 1.2em;" bgcolor="#55ba5e">
                        {{ url('password/reset/'.$token) }}
                    </td>
                </tr>
            </table>

            <table width="580" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth" bgcolor="#ffffff" style="margin:0 auto;">
                <tr bgcolor="#ffffff" height="15">
                    <td></td>
                </tr>
                <tr bgcolor="#55ba5e" height="15">
                    <td></td>
                </tr>
                <tr bgcolor="#3d9e51" height="15">
                    <td></td>
                </tr>
            </table>

            <table width="580" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth" bgcolor="#ffffff" style="margin:0 auto;">
                <tr>
                    <td style="padding:10px 0">
                        <table align="left" width="20%" cellpadding="0" cellspacing="0" border="0" class="deviceWidth">
                            <tr>
                                <td valign="middle" align="left" class="center" style="padding:20px 10px 0 20px">
                                    <a href="http://www.centralcondo.com.br" title="Central Condo">
                                        <img src="http://localhost:8000/portal/assets/images/email/logo-2.png" alt="Central Condo" title="Central Condo" border="0" class="deviceWidth" />
                                    </a>
                                </td>
                            </tr>
                        </table>
                        <table align="right" width="75%" cellpadding="0" cellspacing="0" border="0" class="deviceWidth">
                            <tr>
                                <td style="font-size: 1.2em; line-height: 1.4em; color: #9a9b9f; font-weight: normal; text-align: left; font-family: Arial; vertical-align: top; padding:30px 0 20px 15px">
                                    <p style="mso-table-lspace:0;mso-table-rspace:0; margin:0">
                                        Saudações da Equipe <strong>Central Condo</strong><br/>
                                        (51) 3030.3030 | <a href="http://www.centralcondo.com.br" style="color: #9a9b9f; text-decoration: none;" title="Central Condo">www.centralcondo.com.br</a>
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <br />
        </td>
    </tr>
</table>
</body>
</html>
