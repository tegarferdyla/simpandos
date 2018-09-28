// ---------------------------------------------------------------
// ------------------------ To All Dynamic Fields -- -------------
// ---------------------------------------------------------------
var inputDynamic = `
<br><div class="form-control"><input type="file" name="@input-name[@array-index]"></div>
`
// var counter = 0
// function addInputDynamic(){
   

$('.btn-add-input').click(function(){
  var toAppend = inputDynamic
    var counter = $(this).data("counter")
    var tipeFIle = $(this).data("tipefile")
    // var regex = new RegExp(`input-name`)
    toAppend = toAppend.replace(/@input-name/,tipeFIle)
    toAppend = toAppend.replace(/@array-index/,counter)
    counter++
    console.log(counter)
    $(this).data("counter",counter)
    
    $(this).siblings(".form-group").find(".input-div").append(toAppend)
})