<?php
/*
Plugin Name: Petty Plugin
*/
//require_once('taxonomies.php');
//require_once('post-types.php');
require_once('campos-acesso-camera.php');

//require_once(plugin_dir_url(__FILE__) . 'campos-acesso-camera.php');

/* REGISTRAR SCRIPTS */
function petty_scripts($hook) {
	global $post;

	if($post->post_type != 'acesso_camera')
	{
		return;
	}

    wp_enqueue_script( 'petty_plugin_js', plugin_dir_url(__FILE__) . '/js/petty.js');
}

add_action( 'admin_enqueue_scripts', 'petty_scripts' );

function petty_front_scripts() {
	wp_enqueue_script( 'petty_plugin_front_js', plugin_dir_url(__FILE__) . '/js/contador.js', ['jquery'], '123' ,true);	
}

add_action( 'wp_enqueue_scripts', 'petty_front_scripts' );

/* GERAR SENHA AO SALVAR */
add_action( 'acf/save_post', 'acesso_camera_save', 30);

function acesso_camera_save($post_id) {

	if($_POST['post_type'] != 'acesso_camera')
	{
		return false;
	}

    $senha = get_field( "senha_acesso");

    if(!$senha)
    {
    	update_field( 'senha_acesso', petty_gerar_senha(12),$post_id);
    }

}

function petty_gerar_senha($length) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $password = substr( str_shuffle( $chars ), 0, $length );
    return $password ;
}

function petty_field_id($fieldName) {

	$fields['senha_acesso'] = 'field_59369f0b430d2';
	$fields['enviado'] = 'field_59399ba62eb67';

	if(!isset($fields[$fieldName]))
	{
		throw new Exception($fieldName . ' não está registrado!');
	}

	return $fields[$fieldName];

}

/* [FIM] GERAR SENHA AO SALVAR */

/* REMOVER METABOX YOAST */
add_action( 'add_meta_boxes' , 'remove_yoast_acesso_camera' , 12);
 
/**
 * Remove Remove MetaBox Yoast No acesso_camera
 */
function remove_yoast_acesso_camera() {
    remove_meta_box( 'wpseo_meta' , 'acesso_camera' , 'normal' ); 
}

/* [FIM] REMOVER METABOX YOAST */


/* CRIAR METABOX DE ACOES CAMERA */
function wpdocs_register_meta_boxes() {

	if ( isset($_GET['action'])  && $_GET['action'] === 'edit' )
	{
		add_meta_box( 'acoes-acesso', __( 'Ações', 'textdomain' ), 'petty_render_box_acao_metabox', 'acesso_camera','side','high' );
	}
    
}

add_action( 'add_meta_boxes', 'wpdocs_register_meta_boxes' );
 
/**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post object.
 */
function petty_render_box_acao_metabox( $post ) {
    // Display code/markup goes here. Don't forget to include nonces!
    ?>
    <a href="#" onclick="confirmaEnvio(<?= $post->ID ?>);return false;" name="save" class="button button-primary button-large" >Enviar e-mail</a>
    <?php
}
 
/**
 * Save meta box content.
 *
 * @param int $post_id Post ID
 */
function wpdocs_save_meta_box( $post_id ) {

}

add_action( 'save_post_acesso_camera', 'wpdocs_save_meta_box' );


function petty_acao_lista_email($actions, $post)
{
	$acesso = new PettyAcessoCamera($post);

    if ($post->post_type=='acesso_camera')
    {
        $actions['enviar_email'] = '<a href="#" onclick="confirmaEnvio('.$post->ID.'); return false;" title="Clique aqui para enviar e-mail com dados de acesso para o cliente" rel="permalink">Enviar e-mail</a>';
    }

    return $actions;
}

add_filter('post_row_actions', 'petty_acao_lista_email', 10, 2);


/* Ação de enviar e-mail! */
add_action( 'wp_ajax_enviar_email', 'petty_enviar_email_cliente' );

function petty_enviar_email_cliente() {

	$post_id = $_REQUEST['postId'];
	

	//Obter email cliente
	$emailCliente = get_field('field_5935a3f21283c',$post_id);

	//Obter TEmplate do E-mail
	$titulo = get_theme_mod('pettyEmailTitulo');
	$corpo = nl2br(get_theme_mod('pettyEmailCorpo'));

	//Obter URL com Senha
	$corpo = str_replace('[link_acesso]','<a href="">Link do e-mail</a>',$corpo);
	//Fazer Parse do texto do e-mail

	//var_dump($titulo,$email,$corpo);
 	//$envio = wp_mail( $emailCliente, $titulo, $corpo, ['Content-Type: text/html; charset=UTF-8']);	
 	//var_dump($envio);
 	$envio = 1;
	update_field( petty_field_id('enviado'), $envio,$post_id);
 	

 	echo json_encode(['envio' => true, 'email' => $emailCliente]);
	wp_die();
}

/* Listing Tables */
function petty_seta_colunas( $columns ) {

	unset( $columns['wpseo-score'],
		   $columns['wpseo-score-readability'],
		   $columns['date']
	   );

	$new_columns = array(
		'email' => __('Email', 'sage').'</a>',
		'enviado' => __('Foi enviado?', 'sage').'</a>',
		'inicio' => __('Inicio', 'sage') . ' ' . '<a href="'. admin_url('edit.php?post_status=publish&post_type=acesso_camera&orderby=inicio&order=asc') .'"> (Ordenar)</a>',
		'fim' => __('Fim', 'sage'),
		'date' => __('Criado em:', 'sage')
	);
    return array_merge($columns, $new_columns);	

	return $columns;
}

add_filter( 'manage_acesso_camera_posts_columns' , 'petty_seta_colunas', 20 );


function petty_dados_colunas( $column, $post_id ) {

	$acesso = new PettyAcessoCamera(get_post($post_id));
	switch ( $column ) {
		case 'email':
			echo $acesso->getEmail();
			break;
		case 'enviado':
			echo $acesso->getEnviado() ? 'Sim' : 'Não';
			break;			
		case 'inicio':
			echo $acesso->formatar($acesso->getInicio());
			break;
		case 'fim':
			echo $acesso->formatar($acesso->getFim());
			break;			
	}
}
add_action( 'manage_acesso_camera_posts_custom_column' , 'petty_dados_colunas', 10, 2 );



/* Cria Shortcodes */
// Add Shortcode
function petty_contador( $atts ) {
var_dump($atts);
	// Attributes

	if(!isset($atts['post_id']))
	{
		throw new Exception('post_id não definido!!!');
	}

	if(!isset($atts['senha_url']))
	{
		throw new Exception('senha_url não definida!!!');
	}

	$acesso = PettyAcessoCamera::get(get_post($atts['post_id']));
	$senhaUrl = $atts['senha_url'];
	//var_dump($acesso);
	ob_start();
	
	if( $acesso->senhaCorreta($senhaUrl) )
	{
		if($acesso->aberto())
		{
			?>
				<div id="video-holder" class="camera__holder">
					<h1 class="camera__titulo">Sessão em andamento:</h1>
					<div class="camera__video">
						<iframe width="1280" height="720" src="https://www.youtube.com/embed/hTWKbfoikeg?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
					</div>
					<p class="camera__nota">
						Sessão irá terminar em: <span data-fim="<?= $acesso->formatar($acesso->getFim()); ?>"></span>
					</p>
				</div>
			<?php
		}					
		else if( !$acesso->iniciou())
		{
			?>
				<div class="camera__holder">
					<h1 class="camera__titulo">Sua seção irá iniciar em...</h1>
					<div class="camera__contador" data-inicio="<?= $acesso->formatar($acesso->getInicio()); ?>"></div>
				</div>
			<?php
		}
		else if( $acesso->terminou())
		{
			?>
			<div class="camera__holder">
				<h1 class="camera__titulo">Sessão terminada em:</h1>
				<div class="camera__contador"><?= $acesso->formatar($acesso->getFim()); ?></div>
			</div>		
			<?php
		}
		
	}
	else {
		?>
		<div class="camera__holder">
			<h1 class="camera__titulo">Sessão inválida!</h1>
		</div>
		<?php		
	}
	?>

	<div id="msg-sessao-terminada" class="camera__holder" style="display:none;">
		<h1 class="camera__titulo">Sessão terminada </h1>
		<div class="camera__contador">Obrigado por estar conosco!</div>
	</div>
	
	<?php

	return ob_get_clean();
}

add_shortcode( 'petty_contador', 'petty_contador' );


class PettyAcessoCamera {

	public $post;
	private $agora;

	public function __construct($post) {
		$this->post = $post;
		$this->agora = floatval(current_time('timestamp'));
	}

	public function getInicio() {
		return floatval(get_field('inicio',$this->post->ID));
	}

	public function getFim() {
		return floatval(get_field('fim',$this->post->ID));
	}

	public function getSenha() {
		return get_field('senha_acesso',$this->post->ID);
	}
	
	public function getEmail() {
		return get_field('email_do_cliente',$this->post->ID);
	}

	public function getEnviado() {
		return get_field('enviado',$this->post->ID);
	}	

	public function aberto() {
		return ($this->iniciou() && !$this->terminou());
	}

	public function iniciou() {
		return ($this->agora >= $this->getInicio());
	}

	public function terminou() {
		return $this->agora >= $this->getFim();
	}

	public function senhaCorreta($senha) {
		return ($senha == $this->getSenha());
	}	

	public function formatar($timestamp) {
		return date("Y/m/d H:i", $timestamp);
	}

	public static function get($post) {
		return new PettyAcessoCamera($post);
	}
}
