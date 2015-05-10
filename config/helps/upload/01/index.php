<?
require_once "class_upload.php";
$upload = new Upload();
$upload->setLargura(600);
$upload->setThumbs(1);
$upload->setLarguraT(200);
$upload->Envia_Arquivo();
?>
<html>
<head>
<title>Upload</title>
<script>

   function Contador(field,MaxLength) {
      obj = document.all(field);
      if (MaxLength !=0) {
         if (obj.value.length > MaxLength)  {
            obj.value = obj.value.substring(0, MaxLength);
            }
      }
      document.form1.contador.value = obj.value.length + '/300';
   }

</script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<form action="index.php" method="post" enctype="multipart/form-data" name="form1">
  <textarea name="mensagem" method = "post" cols="41" rows="7" class="frm_input" id="descricao" style="caixa" onKeyUp="return  Contador('descricao',300);"></textarea><BR>
  <input name="contador" type="text" disabled="disabled" class="caixa2" id="contador" size="7" maxlength="7">
  <input type="file" name="arquivo">
  <input type="submit" name="Submit" value="Enviar">
</form>
</body>
</html>