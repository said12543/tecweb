
function getDatos(){
    var nombre = prompt("Nombre: ", "");

    var edad = prompt("Edad: ", 0);

    var div1 = document.getElementById('nombre');
    div1.innerHTML = '<h3> Nombre: '+nombre+'</h3>';

    var div2 = document.getElementById('edad');
    div2.innerHTML = '<h3> Edad: '+edad+'</h3>';
}

function ejemplo1_pag8(){
    document.write('Hola Mundo');
}

function ejemplo2_pag6(){
    var nombre = 'Juan';
    var edad = 10;
    var altura = 1.92;
    var casado = false;
    document.write( nombre );
    document.write( '<br>' );
    document.write( edad );
    document.write( '<br>' );
    document.write( altura );
    document.write( '<br>' );
    document.write( casado );
}

function ejemplo3_pag12(){
    var nombre;
    var edad;
    nombre = prompt('Ingresa tu nombre:', '');
    edad = prompt('Ingresa tu edad:', '');
    document.write('Hola ');
    document.write(nombre);
    document.write(' así que tienes ');
    document.write(edad);
    document.write(' años');
}

function ejemplo4_pag3(){
    var valor1;
    var valor2;
    valor1 = prompt('Introducir primer número:', '');
    valor2 = prompt('Introducir segundo número', '');
    var suma = parseInt(valor1)+parseInt(valor2);
    var producto = parseInt(valor1)*parseInt(valor2);
    document.write('La suma es ');
    document.write(suma);
    document.write('<br>');
    document.write('El producto es ');
    document.write(producto);
}

function ejemplo5_pag8(){
    var nombre;
    var nota;
    nombre = prompt('Ingresa tu nombre:', '');
    nota = prompt('Ingresa tu nota:', '');
    if (nota>=4) {
        document.write(nombre+' esta aprobado con un '+nota);
    }
}

function ejemplo6_pag11(){
    var num1,num2;
    num1 = prompt('Ingresa el primer número:', '');
    num2 = prompt('Ingresa el segundo número:', '');
    num1 = parseInt(num1);
    num2 = parseInt(num2);
    if (num1>num2) {
    document.write('el mayor es '+num1);
    }
    else {
    document.write('el mayor es '+num2);
    }
}

function ejemplo7_pag15(){
    var nota1,nota2,nota3;

    nota1 = prompt('Ingresa 1ra. nota:', '');
    nota2 = prompt('Ingresa 2da. nota:', '');
    nota3 = prompt('Ingresa 3ra. nota:', '');

    //Convertimos los 3 string en enteros
    nota1 = parseInt(nota1);
    nota2 = parseInt(nota2);
    nota3 = parseInt(nota3);

    var pro;
    pro = (nota1+nota2+nota3)/3;
    if (pro>=7) {
        document.write('aprobado');
    }
    else {
        if (pro>=4) {
            document.write('regular');
        }
        else {
            document.write('reprobado');
        }
    }    
}

function ejemplo8_pag18(){
    var valor;
    valor = prompt('Ingresar un valor comprendido entre 1 y 5:', '' );
    //Convertimos a entero
    valor = parseInt(valor);
    switch (valor) {
        case 1: document.write('uno');
        break;
        case 2: document.write('dos');
        break;
        case 3: document.write('tres');
        break;
        case 4: document.write('cuatro');
        break;
        case 5: document.write('cinco');
        break;
        default:document.write('debe ingresar un valor comprendido entre 1 y 5.');
    }
}

function ejemplo9_pag21(){
    var col;
    col = prompt('Ingresa el color con que quierar pintar el fondo de la ventana (rojo, verde, azul)' , '' );
    switch (col) {
        case 'rojo': document.bgColor='#ff0000';
        break;
        case 'verde': document.bgColor='#00ff00';
        break;
        case 'azul': document.bgColor='#0000ff';
        break;
    }
}