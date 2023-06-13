<?php 

    require_once 'funcoes.php';
    use PHPUnit\Framework\TestCase;

    class FuncoesTest extends TestCase {

        //Aqui a função my_file_get_contents pega um dado dentro de uma url
        public function testMyFileGetContents() {
            $site_url = 'https://www.example.com';
            $result   = my_file_get_contents($site_url);            

            $this->assertStringContainsString('Example Domain', $result);
        }

        //Aqui caso a url não exista ele tem que retornar um valor vazio
        public function testMyFileGetContentsUrlNotFound() {
            $site_url   = 'https://www.invalid-url.com';
            $result     = my_file_get_contents($site_url);
        
            $this->assertTrue($result === "");
        }   
        
        public function testGerarAleatorio() {
            date_default_timezone_set('America/Sao_Paulo');

            $dataHoraAtual      = new DateTime();
            $dataHoraFormatada  = date_format($dataHoraAtual, "YmdHis");

            $resultado = gerarAleatorio();

            //Verifico se os numeros apresentados é igual o ano, mes, dia, hora, minuto e segundo
            $this->assertEquals($dataHoraFormatada, $resultado);

            //Aqui verifico se o retorno é uma string com tamanho 14
            $this->assertEquals(14, strlen($resultado));
        }

        //Se a data for menor do horario atual ele retorna true
        public function testCompararDataHoraSmaller() {
            $dataHora = '2023-06-13 08:00:00';
            $result   = compararDataHora($dataHora);

            $this->assertTrue($result === true);
        }

        //Se a data for maior que o horario atual ele retorna false
        public function testCompararDataHoraBig() {
            $dataHora = '2023-06-13 22:00:00';
            $result   = compararDataHora($dataHora);

            $this->assertTrue($result === false);
        }

        //Verifica se o valor da função retorna o mesmo valor da variavel $param1 neste caso 'Teste'
        public function testMethodRequestParamExists() {
            $param1        = 'Teste';
            $_POST['acao'] = $param1;
    
            $resultado = methodRequest($_POST['acao']);
    
            $this->assertEquals($param1, $resultado);
        }

        //Verifica se o parametro não existir ele retorna vazio
        public function testMethodRequestParamNotExists() {
            unset($_POST['acao']); 
    
            $resultado = methodRequest($_POST['acao']);
    
            $this->assertEquals($resultado, '');
        }

        //Pega o valor do index dentro do array do nome na coluna 'name', no exemplo passei 'Jane' e valor do index do array é igual a 1
        public function testArraySearchMultidim() {
            $array = [
                ['id' => 1, 'name' => 'John'],
                ['id' => 2, 'name' => 'Jane'],
                ['id' => 3, 'name' => 'Doe'],
            ];
            
            $column = 'name';
            $key    = 'Jane';
            
            $resultado = array_search_multidim($array, $column, $key);
            
            $this->assertEquals(1, $resultado);
        }

        //Aqui passei o nome que não existe e se ele não achar tem que retornar false
        public function testArraySearchMultidimNotExists() {
            $array = [
                ['id' => 1, 'name' => 'John'],
                ['id' => 2, 'name' => 'Jane'],
                ['id' => 3, 'name' => 'Doe'],
            ];
            
            $column = 'name';
            $key    = 'Exemplo';
            
            $resultado = array_search_multidim($array, $column, $key);

            $this->assertTrue($resultado === false);
        }
    
    }   


?>