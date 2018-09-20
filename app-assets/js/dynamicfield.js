// ---------------------------------------------------------------
// ------------------------ Laporan Swakelola --------------------
// ---------------------------------------------------------------
$(document).ready(function(){
    var next = 1;
    $(".add-swakelola").click(function(e){
        e.preventDefault();
        var addto = "#swakelola" + next;
        var addRemove = "#swakelola" + (next);
        next = next + 1;
        var newIn = '<input autocomplete="off" class="form-control input" id="swakelola'+ next +'" name="'+ next +'" type="text" placeholder="Laporan Swakelola '+ next +'"> ';
        var newInput = $(newIn);
        var removeBtn = '<br><a style="padding-left:29em" id="remove '+(next - 1 )+'" class="text-danger right remove-me"><i class="ft-x"></i> Remove</a> <div class="col-md-3"></div>';
        var removeButton = $(removeBtn);
        $(addto).after(newInput);
        $(addRemove).after(removeButton);
        $("#swakelola" + next).attr('data-source',$(addto).attr('data-source'));
        $("#count").val(next);  
        
            $('.remove-me').click(function(e){
                e.preventDefault();
                var fieldNum = this.id.charAt(this.id.length-1);
                var fieldID = "#swakelola" + fieldNum;
                $(this).remove();
                $(fieldID).remove();
            });
    }); 
});
// ---------------------------------------------------------------
// ------------------------ Start Readiness Criteria -------------
// ---------------------------------------------------------------
// 1. Surat Minat Daerah 
$(document).ready(function(){
    var next = 1;
    $(".add-smd").click(function(e){
        e.preventDefault();
        var addto = "#field" + next;
        var addRemove = "#field" + (next);
        next = next + 1;
        var newIn = '<input autocomplete="off" class="form-control input" id="field'+ next +'" name="smd'+ next +'" type="text" placeholder="Surat Minat Daerah '+ next +'"> ';
        var newInput = $(newIn);
        var removeBtn = '<br><a style="padding-left:29em" id="remove '+(next - 1 )+'" class="text-danger right remove-me"><i class="ft-x"></i> Remove</a> <div class="col-md-3"></div>';
        var removeButton = $(removeBtn);
        $(addto).after(newInput);
        $(addRemove).after(removeButton);
        $("#field" + next).attr('data-source',$(addto).attr('data-source'));
        $("#count").val(next);  
        
            $('.remove-me').click(function(e){
                e.preventDefault();
                var fieldNum = this.id.charAt(this.id.length-1);
                var fieldID = "#field" + fieldNum;
                $(this).remove();
                $(fieldID).remove();
            });
    }); 
});

// 2. Surat Menerima Hibah
$(document).ready(function(){
    var next = 1;
    $(".add-smh").click(function(e){
        e.preventDefault();
        var addto = "#smh" + next;
        var addRemove = "#smh" + (next);
        next = next + 1;
        var newIn = '<input autocomplete="off" class="form-control input" id="smh'+ next +'" name="smh'+ next +'" type="text" placeholder="Surat Minat Hibah '+ next +'"> ';
        var newInput = $(newIn);
        var removeBtn = '<br><a style="padding-left:29em" id="remove '+(next - 1 )+'" class="text-danger right remove-me"><i class="ft-x"></i> Remove</a> <div class="col-md-3"></div>';
        var removeButton = $(removeBtn);
        $(addto).after(newInput);
        $(addRemove).after(removeButton);
        $("#smh" + next).attr('data-source',$(addto).attr('data-source'));
        $("#count").val(next);  
        
            $('.remove-me').click(function(e){
                e.preventDefault();
                var fieldNum = this.id.charAt(this.id.length-1);
                var fieldID = "#smh" + fieldNum;
                $(this).remove();
                $(fieldID).remove();
            });
    }); 
});

/// 3. Surat Kesiapan Lahan
$(document).ready(function(){
    var next = 1;
    $(".add-skl").click(function(e){
        e.preventDefault();
        var addto = "#skl" + next;
        var addRemove = "#skl" + (next);
        next = next + 1;
        var newIn = '<input autocomplete="off" class="form-control input" id="skl'+ next +'" name="skl'+ next +'" type="text" placeholder="Surat Kesiapan Lahan '+ next +'"> ';
        var newInput = $(newIn);
        var removeBtn = '<br><a style="padding-left:29em" id="remove '+(next - 1 )+'" class="text-danger right remove-me"><i class="ft-x"></i> Remove</a> <div class="col-md-3"></div>';
        var removeButton = $(removeBtn);
        $(addto).after(newInput);
        $(addRemove).after(removeButton);
        $("#skl" + next).attr('data-source',$(addto).attr('data-source'));
        $("#count").val(next);  
        
            $('.remove-me').click(function(e){
                e.preventDefault();
                var fieldNum = this.id.charAt(this.id.length-1);
                var fieldID = "#skl" + fieldNum;
                $(this).remove();
                $(fieldID).remove();
            });
    }); 
});

/// 4. Kesepakatan Bersama
$(document).ready(function(){
    var next = 1;
    $(".add-ksb").click(function(e){
        e.preventDefault();
        var addto = "#ksb" + next;
        var addRemove = "#ksb" + (next);
        next = next + 1;
        var newIn = '<input autocomplete="off" class="form-control input" id="ksb'+ next +'" name="ksb'+ next +'" type="text" placeholder="Kesepakatan Bersama '+ next +'"> ';
        var newInput = $(newIn);
        var removeBtn = '<br><a style="padding-left:29em" id="remove '+(next - 1 )+'" class="text-danger right remove-me"><i class="ft-x"></i> Remove</a> <div class="col-md-3"></div>';
        var removeButton = $(removeBtn);
        $(addto).after(newInput);
        $(addRemove).after(removeButton);
        $("#ksb" + next).attr('data-source',$(addto).attr('data-source'));
        $("#count").val(next);  
        
            $('.remove-me').click(function(e){
                e.preventDefault();
                var fieldNum = this.id.charAt(this.id.length-1);
                var fieldID = "#ksb" + fieldNum;
                $(this).remove();
                $(fieldID).remove();
            });
    }); 
});
// 5. Perjanjian Kerja Sama
$(document).ready(function(){
    var next = 1;
    $(".add-pks").click(function(e){
        e.preventDefault();
        var addto = "#pks" + next;
        var addRemove = "#pks" + (next);
        next = next + 1;
        var newIn = '<input autocomplete="off" class="form-control input" id="pks'+ next +'" name="pks'+ next +'" type="text" placeholder="Kesepakatan Bersama '+ next +'"> ';
        var newInput = $(newIn);
        var removeBtn = '<br><a style="padding-left:29em" id="remove '+(next - 1 )+'" class="text-danger right remove-me"><i class="ft-x"></i> Remove</a> <div class="col-md-3"></div>';
        var removeButton = $(removeBtn);
        $(addto).after(newInput);
        $(addRemove).after(removeButton);
        $("#pks" + next).attr('data-source',$(addto).attr('data-source'));
        $("#count").val(next);  
        
            $('.remove-me').click(function(e){
                e.preventDefault();
                var fieldNum = this.id.charAt(this.id.length-1);
                var fieldID = "#pks" + fieldNum;
                $(this).remove();
                $(fieldID).remove();
            });
    }); 
});

// ---------------------------------------------------------------
// -------------------------- KONTRAK ----------------------------
// ---------------------------------------------------------------
// 1. SPPBJ
$(document).ready(function(){
    var next = 1;
    $(".add-SPPBJ").click(function(e){
        e.preventDefault();
        var addto = "#SPPBJ" + next;
        var addRemove = "#SPPBJ" + (next);
        next = next + 1;
        var newIn = '<input autocomplete="off" class="form-control input" id="SPPBJ'+ next +'" name="SPPBJ'+ next +'" type="text" placeholder="SPPBJ '+ next +'"> ';
        var newInput = $(newIn);
        var removeBtn = '<br><a style="padding-left:29em" id="remove '+(next - 1 )+'" class="text-danger right remove-me"><i class="ft-x"></i> Remove</a> <div class="col-md-3"></div>';
        var removeButton = $(removeBtn);
        $(addto).after(newInput);
        $(addRemove).after(removeButton);
        $("#SPPBJ" + next).attr('data-source',$(addto).attr('data-source'));
        $("#count").val(next);  
        
            $('.remove-me').click(function(e){
                e.preventDefault();
                var fieldNum = this.id.charAt(this.id.length-1);
                var fieldID = "#SPPBJ" + fieldNum;
                $(this).remove();
                $(fieldID).remove();
            });
    }); 
});

// 2. SPMK
$(document).ready(function(){
    var next = 1;
    $(".add-SPMK").click(function(e){
        e.preventDefault();
        var addto = "#SPMK" + next;
        var addRemove = "#SPMK" + (next);
        next = next + 1;
        var newIn = '<input autocomplete="off" class="form-control input" id="SPMK'+ next +'" name="SPMK'+ next +'" type="text" placeholder="SPMK '+ next +'"> ';
        var newInput = $(newIn);
        var removeBtn = '<br><a style="padding-left:29em" id="remove '+(next - 1 )+'" class="text-danger right remove-me"><i class="ft-x"></i> Remove</a> <div class="col-md-3"></div>';
        var removeButton = $(removeBtn);
        $(addto).after(newInput);
        $(addRemove).after(removeButton);
        $("#SPMK" + next).attr('data-source',$(addto).attr('data-source'));
        $("#count").val(next);  
        
            $('.remove-me').click(function(e){
                e.preventDefault();
                var fieldNum = this.id.charAt(this.id.length-1);
                var fieldID = "#SPMK" + fieldNum;
                $(this).remove();
                $(fieldID).remove();
            });
    }); 
});
// 3. Naskah Kontrak
$(document).ready(function(){
    var next = 1;
    $(".add-naskon").click(function(e){
        e.preventDefault();
        var addto = "#naskon" + next;
        var addRemove = "#naskon" + (next);
        next = next + 1;
        var newIn = '<input autocomplete="off" class="form-control input" id="naskon'+ next +'" name="naskon'+ next +'" type="text" placeholder="Naskah Kontrak '+ next +'"> ';
        var newInput = $(newIn);
        var removeBtn = '<br><a style="padding-left:29em" id="remove '+(next - 1 )+'" class="text-danger right remove-me"><i class="ft-x"></i> Remove</a> <div class="col-md-3"></div>';
        var removeButton = $(removeBtn);
        $(addto).after(newInput);
        $(addRemove).after(removeButton);
        $("#naskon" + next).attr('data-source',$(addto).attr('data-source'));
        $("#count").val(next);  
        
            $('.remove-me').click(function(e){
                e.preventDefault();
                var fieldNum = this.id.charAt(this.id.length-1);
                var fieldID = "#naskon" + fieldNum;
                $(this).remove();
                $(fieldID).remove();
            });
    }); 
});
// 4. Rencana Mutu Kontrak
$(document).ready(function(){
    var next = 1;
    $(".add-rmk").click(function(e){
        e.preventDefault();
        var addto = "#rmk" + next;
        var addRemove = "#rmk" + (next);
        next = next + 1;
        var newIn = '<input autocomplete="off" class="form-control input" id="rmk'+ next +'" name="rmk'+ next +'" type="text" placeholder="Rencana Mutu Kontrak '+ next +'"> ';
        var newInput = $(newIn);
        var removeBtn = '<br><a style="padding-left:29em" id="remove '+(next - 1 )+'" class="text-danger right remove-me"><i class="ft-x"></i> Remove</a> <div class="col-md-3"></div>';
        var removeButton = $(removeBtn);
        $(addto).after(newInput);
        $(addRemove).after(removeButton);
        $("#rmk" + next).attr('data-source',$(addto).attr('data-source'));
        $("#count").val(next);  
        
            $('.remove-me').click(function(e){
                e.preventDefault();
                var fieldNum = this.id.charAt(this.id.length-1);
                var fieldID = "#rmk" + fieldNum;
                $(this).remove();
                $(fieldID).remove();
            });
    }); 
});