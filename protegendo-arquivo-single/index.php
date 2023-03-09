<?php
//pagina exemplo de requisicao ajax exclusiva para usuarios logados
$data['info'] = 'informacao exlusiva apenas para usuarios logados';


die(json_encode($data));
?>