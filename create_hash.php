<?php

$senha = 'jubilut123'; 

if (php_sapi_name() !== 'cli') {
    echo "Este script deve ser executado a partir da linha de comando.";
    exit;
}

if (empty($senha)) {
    echo "Por favor, defina uma senha na variável \$senha dentro do script.\n";
    exit;
}

$hash = password_hash($senha, PASSWORD_DEFAULT);

echo "Senha original: " . $senha . "\n";
echo "Hash gerado: " . $hash . "\n";
echo "Copie o hash acima e insira no seu banco de dados.\n";