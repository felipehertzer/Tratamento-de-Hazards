<?php
/**
 * Welcome controller
 *
 * @author David Carr - dave@daveismyname.com
 * @version 2.2
 * @date June 27, 2014
 * @date updated Sept 19, 2015
 */

namespace Controllers;

use Core\View;
use Core\Controller;

class Welcome extends Controller
{

    /**
     * Call the parent construct
     */
    public function __construct()
    {
        parent::__construct();
        $this->language->load('Welcome');
    }

    public function index()
    {
        $data['title'] = "Tratamento de Hazards";

        View::renderTemplate('header', $data);
        View::render('welcome/welcome', $data);
        View::renderTemplate('footer', $data);
    }

	public function array_insert(&$array, $position, $insert)
	{
		if (is_int($position)) {
			array_splice($array, $position, 0, $insert);
		} else {
			$pos   = array_search($position, array_keys($array));
			$array = array_merge(
				array_slice($array, 0, $pos),
				$insert,
				array_slice($array, $pos)
			);
		}
	}

    public function calcular()
    {
        $operacoes = array(1 => "add", "addi", "addu", "sub", "lw", "sw", "bne", "beq", "j", "NOP");
        $variaveis = array();
        $resultado = array();
        $nops = "";
        $cpi = 4;

        foreach($_POST['operacao'] as $linha => $op){
            switch($op){
                case "1":
                case "2":
                case "3":
                case "4":
                case "7":
                case "8":
                    if(empty($_POST['rd'][$linha]) || empty($_POST['rs1'][$linha]) || empty($_POST['rs2'][$linha])){
                        echo json_encode(array("resultado" => "O MIPS informado está incorreto", "cpi" => ""));
                        exit;
                    }
                    break;
                case "5":
                case "6":
                    if((empty($_POST['rd'][$linha]) || empty($_POST['rs1'][$linha])) || !empty($_POST['rs2'][$linha])){
                        echo json_encode(array("resultado" => "O MIPS informado está incorreto", "cpi" => ""));
                        exit;
                    }
                    break;
                case "9":
                    if(empty($_POST['rd'][$linha]) || (!empty($_POST['rs1'][$linha]) || !empty($_POST['rs2'][$linha]))){
                        echo json_encode(array("resultado" => "O MIPS informado está incorreto", "cpi" => ""));
                        exit;
                    }
                    break;
                case "10":
                    if(!empty($_POST['rd'][$linha]) || !empty($_POST['rs1'][$linha]) || !empty($_POST['rs2'][$linha])){
                        echo json_encode(array("resultado" => "O MIPS informado está incorreto", "cpi" => ""));
                        exit;
                    }
                    break;
            }
			for($i = 0; $i <= 3; $i++){
				$row = $linha - $i;
				if(isset($variaveis[$row]) && (!empty($_POST['rd'][$linha]) && (in_array($_POST['rd'][$linha], $variaveis[$row]))  || (!empty($_POST['rs1'][$linha]) && in_array($_POST['rs1'][$linha], $variaveis[$row]))  || (!empty($_POST['rs2'][$linha]) && in_array($_POST['rs2'][$linha], $variaveis[$row])))) {
					array_push($resultado, "NOP");
					break;
				}
			}
			
            $res = (!empty($_POST['funcao'][$linha]) ? $_POST['funcao'][$linha].": " : "" ).$operacoes[$op]." ".(!empty($_POST['rd'][$linha]) ? $_POST['rd'][$linha].($op != 9 ? ", " : "") : "" ).(!empty($_POST['rs1'][$linha]) ? $_POST['rs1'][$linha].($op != 5 && $op != 6 ? ", " : "") : "" ).(!empty($_POST['rs2'][$linha]) ? $_POST['rs2'][$linha] : "" );
            $cpi++;
            array_push($resultado, $res);
            array_push($variaveis, array($_POST['rd'][$linha], $_POST['rs1'][$linha], $_POST['rs2'][$linha]));
        }
		// Ordenação
		if($_POST['otimizar'] == "on"){
	        foreach($resultado as $line => $row){
				if($row == "NOP"){
					// A = 3 + 2 = 5 | 3 + 5 = 7 
					for($i = $line + 2; $i <= $line + 6; $i++){
						
						if($resultado[$i] == "NOP"){
							$i++;
						} elseif(trim($resultado[$i]) == "") {
							break;
						} else {
							$aux = $resultado[$i];	
							unset($resultado[$line]);
							self::array_insert($resultado,$line, $aux);
							unset($resultado[$i]);
							$resultado = array_values($resultado);
							break;
						}
					}
				}
			}
		}
        echo json_encode(array("resultado" => implode($resultado, "<br>"), "cpi" => $cpi / ($cpi - 4)));
    }
}
