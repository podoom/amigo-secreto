<?php
/*
Script simples para sorteio de amigo secreto
Adicione os participantes no Array e rode o script, e voalá :)
*/

$nomes = array(
	array(
		'id' => '1',
		'nome' => 'Fulano',
		'email' => array(
			'fulano@gmail.com',
			'fulano@yahoo.com',
		),
	),
	array(
		'id' => '2',
		'nome' => 'Ciclano',
		'email' => 'ciclano@gmail.com',
	),
);

$participantes = $nomes;

$mensagem = "Ola %nome%\n\nEsse é o email de sorteio do Amigo da Onça do Busão\n\nSeu amigo da onça é \"%nome_amigo%\"\n\n";

function sorteio($id = 0) {
	global $nomes;

	if(count($nomes) > 1) {
		srand((float) microtime() * 10000000);
		$sorteado = array_rand($nomes);

		if($nomes[ $sorteado ]['id'] != $id) {
			$escolhido = $nomes[ $sorteado ];
			unset($nomes[ $sorteado ]);
			return $escolhido;
		}
		else {
			return sorteio($id);
		}
	}
	else {
		foreach ($nomes as $nome) {
			return $nome;
		}
	}
}

$envio = 0;
foreach($participantes AS $participante) {
	$amigo = sorteio($participante['id']);

	$msgEnvio = str_replace("%nome%", $participante['nome'], $mensagem);
	$msgEnvio = str_replace("%nome_amigo%", $amigo['nome'], $msgEnvio);

	if(is_array($participante['email'])) {
		foreach ($participante['email'] as $email) {
			if(mail($email, "Sorteio amigo da Onça - Busão UNG 2013", $msgEnvio, "From: contato@rodrigop.com.br")) {
				$envio++;
			}
		}
	}
	else {
		if(mail($participante['email'], "Sorteio amigo da Onça - Busão UNG 2013", $msgEnvio, "From: contato@rodrigop.com.br")) {
			$envio++;
		}
	}
}

echo "Enviados $envio E-mails";
