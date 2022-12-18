<?php

    session_start();

    /*
        Representación de una calculadora básica
        utilizando PHP.

        @author Adriana R.F. - UO282798
    */
    class Calculadora {

    // Atributos de la calculadora
    protected $pantalla;
    protected $memoria = "";
    protected $operando1 = "";
    protected $operando2 = "";
    protected $operador = "";
    protected $esResultado = false;


    /*
    ---- Constructor
    Sin parámetros
    Reseta la pantalla a su estado inicial (pantalla y memoria, vacías)
    */
    function __construct() { 
        $this->pantalla = "";
        $this->pantalla = "";
        $this->memoria = "";
        $this->operando1 = "";
        $this->operando2 = "";
        $this->operador = "";
        $this->esResultado = false;
    }

    /*
    ------------------------------------------------------------------------------------
    */

    // Borra todo
    public function onc(){
        $this->pantalla = "0";
        $this->operando1 = "";
        $this->operador = "";
        $this->operando2 = "";
        $this->esResultado = false;
        $this->pantalla = "";
    }

    // Borra el último caracter en pantalla
    public function clearError(){
        $p = (string) ($this->pantalla);
        
        if (!$this->esResultado){
            $len = strlen($p);
            if ($len == 1){
                $this->pantalla = "";
            } else {
                $this->pantalla = substr($p,0,$len-1);
            }
        }
    }

    // Cambia el signo del número que aparece en pantalla
    public function cambiarSigno(){
        $p = (string) ($this->pantalla);
        $len = strlen($p);
        if ($len > 0){
            if ($p[0] === "-"){
                $p = (string)($this->pantalla);
                $this->pantalla = "";
                for ($i=1; $i<$len; $i++){
                    $this->pantalla = $this->pantalla. $p[$i];
                }
            } else {
                $this->pantalla = "-". $this->pantalla;
            }
            
        }
    }


     /*
    ------------------------------------------------------------------------------------
    */

    // Escribe un punto (decimal) en pantalla
    public function punto(){
        $this->pantalla = $this->pantalla . ".";
        
    }

    // Escribe un dígito en pantalla
    public function digitos($num) {
        if ($this->esResultado){
            $this->esResultado = false;
        }
        $this->pantalla = $this->pantalla. $num;
        
    }

    /*
    ------------------------------------------------------------------------------------
    */

    // Realiza el cálculo (binario) expresado: suma, resta, multiplicación, división
    // Para el caso de operaciones unarias (raíz, porcentaje)... ya se ha calculado
    public function igual(){
        // --- Operando2 ya calculado para el %
        // En caso de que no haya %, no se calcula
        $len = strlen($this->pantalla);
        if ($len > 0){
            if ($this->pantalla[($len-1)] != "%"){ 
                $this->operando2 = floatval($this->pantalla);
            }
    
            $operacion = (string)($this->operando1) . (string)($this->operador) . (string)($this->operando2);

            try {
                    if ($operacion != "") {
                        $result = floatval(eval("return ". $operacion . ";"));
                        
                        if (is_nan($result))
                            $this->pantalla = "Syntax ERROR";
                        else
                            $this->pantalla = (string)($result);                          
                    }
                } catch(Exception $e){
                    $this->pantalla = "Syntax ERROR";
                    
                    $this->pantalla = "";
                }
    
                $this->esResultado = true;
            }
        }

    

     /*
    ------------------------------------------------------------------------------------
    */

    // Todas estas operaciones guardan el primer operando y realizan el cálculo expresado
    public function suma(){
        $this->operando1 = floatval($this->pantalla);
        $this->operador = "+";
        $this->pantalla = "";
    }
    public function resta(){
        $this->operando1 = floatval($this->pantalla);
        $this->operador = "-";
        $this->pantalla = "";
    }
    public function multiplicacion(){
        $this->operando1 = floatval($this->pantalla);
        $this->operador = "*";
        $this->pantalla = "";
    }
    public function division(){
        $this->operando1 = floatval($this->pantalla);
        $this->operador = "/";
        $this->pantalla = "";
    }

    // Realiza el cálculo de la raíz cuadrada del número en pantalla
    public function sqrt(){
        $this->operando1 = $this->pantalla;
        if ($this->operando1 != ""){
            $result = sqrt(floatval($this->operando1));
            if (is_nan($result))
                $this->pantalla = "Entrada no válida";
            else
                $this->pantalla = $result;
                                 
            $this->esResultado = true;
        }
    }

    // Realiza porcentajes para 4 casos: suma-resta-multiplicación-división
    public function porcentaje(){
        // 3 casos: suma, resta, multiplicación-división
        if ($this->operador === "+"){
            $this->operando2 = $this->operando1 * floatval($this->pantalla/100);
        } else if ($this->operador === "-"){
            $this->operando2 = $this->operando1 / floatval($this->pantalla/100);
        } else if ($this->operador === "*" || $this->operador === "/"){
            $this->operando2 = floatval($this->pantalla) / 100;
        }

        $this->pantalla = $this->pantalla. "%";
        
    }

     /*
    ------------------------------------------------------------------------------------
    */

    // Funciones relativas a memoria
    public function mrc(){ // memoria recall: muestra en pantalla el valor guardado en memoria
        $this->pantalla = $this->memoria;
        
    }
    public function mMas(){ // Suma a memoria el valor en pantalla
        try {
            $this->memoria = floatval($this->memoria) + floatval($this->pantalla);
        } catch(Exception $e){
            $this->pantalla = "Syntax ERROR";
            $this->esResultado = true;
        }
    }
    public function mMenos(){ // Resta de memoria el valor en pantalla
        try {
            $this->memoria = floatval($this->memoria) - floatval($this->pantalla);
            
        } catch(Exception $e){
            $this->pantalla = "Syntax ERROR";
            $this->esResultado = true;
        }
    }


     /*
    ------------------------------------------------------------------------------------
    */

    // Escribir la pantalla en el HTML, usando selectores CSS
    public function escribir(){
        return $this->pantalla;
    }
}

// Definición de una nueva sesión
if (!isset($_SESSION['calculadora'])){
    $calc = new Calculadora();
    $_SESSION['calculadora'] = $calc;        
}
// Interacción con todos los botones
if (count($_POST)>0)
{
    $calc = $_SESSION['calculadora'];

    if (isset($_POST['ON/C'])) $calc->onc();
    if (isset($_POST['CE'])) $calc->clearError();
    if (isset($_POST['+/-'])) $calc->cambiarSigno();
    if (isset($_POST['+'])) $calc->suma();
    if (isset($_POST['√'])) $calc->sqrt();
    if (isset($_POST['%'])) $calc->porcentaje();
    if (isset($_POST['7'])) $calc->digitos(7);
    if (isset($_POST['8'])) $calc->digitos(8);
    if (isset($_POST['9'])) $calc->digitos(9);
    if (isset($_POST['x'])) $calc->multiplicacion();
    if (isset($_POST['÷'])) $calc->division();
    if (isset($_POST['4'])) $calc->digitos(4);
    if (isset($_POST['5'])) $calc->digitos(5);
    if (isset($_POST['6'])) $calc->digitos(6);
    if (isset($_POST['-'])) $calc->resta();
    if (isset($_POST['MRC'])) $calc->mrc();
    if (isset($_POST['1'])) $calc->digitos(1);
    if (isset($_POST['2'])) $calc->digitos(2);
    if (isset($_POST['3'])) $calc->digitos(3);
    if (isset($_POST['M-'])) $calc->mMenos();
    if (isset($_POST['0'])) $calc->digitos(0);
    if (isset($_POST['punto'])) $calc->punto();
    if (isset($_POST['='])) $calc->igual();
    if (isset($_POST['M+'])) $calc->mMas();

    $_SESSION['calculadora'] = $calc;
}

?>
