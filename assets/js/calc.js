function myFunction() {
  var x = document.getElementById("mySelect").value;
  console.log(x);
  if (x == "1") {
    $('#untuk').html("calculator mencari P(X) binominal");
    var text =
    '<div class="form-group">'+
        '<input type="number" class="form-control" placeholder="Banyaknya Percobaan (n)" value="" name="n" />'+
    '</div>'+
    '<div class="form-group">'+
        '<input type="number" step="0.01" class="form-control" placeholder="Probabilitas sukses (s)" value="" name="s" />'+
    '</div>'+
    '<div class="form-group">'+
        '<input type="number" type="text" class="form-control" placeholder="nilai x" value="" name="x" />'+
    '</div>'+
    '<input type="submit" class="btnRegister" name="type" value="Binominal"/>'
    ;
  }else if (x == "2") {
    $('#untuk').html("calculator mencari P(X) poisson");
    var text =
    '<div class="form-group">'+
        '<input type="number" class="form-control" placeholder="Banyaknya Percobaan (n)" value="" name="n" />'+
    '</div>'+
    '<div class="form-group">'+
        '<input type="number" step="0.01" class="form-control" placeholder="Probabilitas sukses (s)" value="" name="s" />'+
    '</div>'+
    '<div class="form-group">'+
        '<input type="number" type="text" class="form-control" placeholder="nilai x" value="" name="x" />'+
    '</div>'+
    '<input type="submit" class="btnRegister" name="type" value="Poisson"/>'
    ;
  }else if (x == "3") {
    $('#untuk').html("calculator mencari P(X) hipergeometri");
    var text =
    '<div class="form-group">'+
        '<input type="number" class="form-control" placeholder="Banyaknya Percobaan (n)" value="" name="n" />'+
    '</div>'+
    '<div class="form-group">'+
        '<input type="number" class="form-control" placeholder="jumlah populasi (N)" value="" name="NB" />'+
    '</div>'+
    '<div class="form-group">'+
        '<input type="number" step="0.01" class="form-control" placeholder="banyaknya sukses (r)" value="" name="r" />'+
    '</div>'+
    '<div class="form-group">'+
        '<input type="number" type="text" class="form-control" placeholder="nilai x" value="" name="x" />'+
    '</div>'+
    '<input type="submit" class="btnRegister" name="type" value="Hipergeometri"/>'
    ;
  }else if (x == "4") {
    $('#untuk').html("calculator mencari P(X,Y,Z) Polynominal");
    var text =
    '<div class="form-group">'+
        '<input type="number" class="form-control" placeholder="Banyaknya Percobaan (n)" value="" name="n" />'+
    '</div>'+
    '<div class="form-group">'+
        '<input type="number" type="text" class="form-control" placeholder="x1" value="" name="x1" />'+
    '</div>'+
    '<div class="form-group">'+
        '<input type="number" step="0.01" class="form-control" placeholder="p1" value="" name="p1" />'+
    '</div>'+
    '<div class="form-group">'+
        '<input type="number" type="text" class="form-control" placeholder="x2" value="" name="x2" />'+
    '</div>'+
    '<div class="form-group">'+
        '<input type="number" step="0.01" class="form-control" placeholder="p2" value="" name="p2" />'+
    '</div>'+
    '<div class="form-group">'+
        '<input type="number" type="text" class="form-control" placeholder="x3" value="" name="x3" />'+
    '</div>'+
    '<div class="form-group">'+
        '<input type="number" step="0.01" class="form-control" placeholder="p3" value="" name="p3" />'+
    '</div>'+
    '<input type="submit" class="btnRegister" name="type" value="Polynominal"/>'
    ;
  }
  $('#yourDivName').html(text);
}
