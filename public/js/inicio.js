function start()
{
  //OBTENER LA HORA
  var today=new Date();
  var h=today.getHours();
  var m=today.getMinutes();
  var s=today.getSeconds();
  m=checkTime(m);
  s=checkTime(s);

  //variable am o pm y formato de 12 hrs
  var sufijo = ' am';
  if(h > 12) {
    h = h - 12;
    sufijo = ' pm';
  }
  document.getElementById('hora').innerHTML=h+":"+m+":"+s+" "+sufijo;
  t=setTimeout(function(){start();},500);

  //OBTENER DIA
  var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
  var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
  var f=new Date();
  document.getElementById('dia').innerHTML=diasSemana[f.getDay()] + ", " + f.getDate() + " de " + meses[f.getMonth()];
  t=setTimeout(function(){dia();}, 500);

  //MOVER IMAGEN DE FONDO
//  document.onmousemove = function(e) {
//    var x = -(e.clientX/10);
//    var y = -(e.clientY/10);
//    this.body.style.backgroundPosition = x + 'px ' + y + 'px';
//  };
}
//añade un 0 en los minutos menores a 10
function checkTime(i)
{
  if (i<10)
    {i="0" + i;}
  return i;
}