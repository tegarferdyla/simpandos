<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Test Mode</title>
	<link rel="stylesheet" href="">
</head>
<body>
	<form method="post" action="<?php echo site_url('ppk/testinput') ?>" enctype="multipart/form-data">
		  <input  style="color:#ffffff;" class="name required" type="button" onclick="addInputsmd()" value="Add smd" />
          <input name="name" style="color:#ffffff;" class="name required" type="button" onclick="addInputsmh()" value="Add smh" />
		  <div id="jenis">
		  	
		  </div>
		<div id="text">
		</div>
		<input type="submit" name="" value="Input">
	</form>
</body>
<script language="javascript">
fields = 0;
pNR = 0;
err = 0;

function addInputsmd() {
    var firstInput;
    var text = document.getElementById("text");
    if (fields != 40) {
        firstInput  = document.createElement("input");
        firstInput.name  = "smd["+pNR+"]" ;
        firstInput.type = "file";

        text.appendChild(firstInput);
        text.appendChild(document.createElement("br"));
        fields += 1;
        pNR += 1;
    } else {
        if (err == 0) {
            text.appendChild(document.createElement("br"))
            text.appendChild(document.createTextNode("Adaugati maxim 40 ingrediente."));
            err = 1;
        }
        document.form.add.disabled = true;
    }
}
function addInputsmh() {
    var firstInput;
    var text = document.getElementById("text");
    var jen = document.getElementById("jenis");
    if (fields != 40) {
        firstInput  = document.createElement("input");
        firstInput.name  = "smh["+pNR+"]" ;
        firstInput.type = "file";
        firstInput.class ="form-control"
        
        text.appendChild(firstInput);
        text.appendChild(document.createElement("br"));
        fields += 1;
        pNR += 1;
    } else {
        if (err == 0) {
            text.appendChild(document.createElement("br"))
            text.appendChild(document.createTextNode("Adaugati maxim 40 ingrediente."));
            err = 1;
        }
        document.form.add.disabled = true;
    }
}
</script>
</html>