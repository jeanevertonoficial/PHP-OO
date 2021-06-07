<?php 

class Conta
{
    private $titular;
    private $saldo;
    private static $numeroDeContas = 0;

    public function __construct(Titular $titular)
    {
        $this->titular = $titular;
        $this->saldo = 0;
        
        self::$numeroDeContas++;
    }

    public function __destruct()
    {
        self::$numeroDeContas--;
    }

    public function sacar(float $valorASacar)
    {
        if ($valorASacar > $this->saldo) {
            echo "saldo indisponível"  .'<br>';
            return;
        } 
            $this->saldo -=$valorASacar;
        
    }
    public function depositar(float $valorADepositar): void
    {
        if ($valorADepositar < 0) {
            echo "Valor precisa ser positivo". '<br>';
            return;
        } 
            $this->saldo += $valorADepositar;
        
    }
    public function transferir(float $valorATransferir, Conta $contaDestino): void
    {
        if ($valorATransferir > $this->saldo) {
            echo "Saldo indisponível" . '<br>';
            return;
        } 
            $this->sacar($valorATransferir);
            $contaDestino->depositar($valorATransferir);
        
    }
    public function recuperarSaldo(): string
    {
        return $this-> saldo . '<br>';
        
    }


    public function recuperarCpfTitular(): string
    {
        return $this->titular->recuperaCpf(). '<br>';
    }

    public function recuperarNomeTitular(): string
    {
       return $this->titular->recuperaNome(). '<br>';
    }
 /*
    public static function recuperaStatic(): int
    {
        return Conta::$numerosDeContas;  // medoto de recuperação da vizualização dos numeros de contas 
    }
*/
    public static function recuperaNumeroDeContas(): int
    {
        return self::$numeroDeContas;
    }
}