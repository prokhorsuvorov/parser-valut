<?php
/**
 * Додаємо новий віджет PS_Widget.
 */
class PS_Widget extends WP_Widget {
	
	public $ps_parser;
	public $w_mass_valut = array();
	
	/**
	 * Створюємо віджет
	 * 
	 * @param array w_mass_valut масив валют
	 */ 
	function __construct() {
		
		parent::__construct( 'ps-parser-valut', 'Заголовок parser-valut', array('description'=>'Опис віджета parser-valut') );
		
		$this->ps_parser = new PS_Parser();
		$this->w_mass_valut = $this->ps_parser->foreach_valuta_privatbank();
		$this->w_mass_valut = $this->ps_parser->get_valuta_nbu();
	}

	/**
	 * Виводимо віджет в фронт-енді 
	 *
	 * @param array $args   аргументи віджета
	 * @param array $instance збережені дані з настройок
	 */
	function widget( $args, $instance ){
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $args['before_widget'];

		if( $title )
			echo $args['before_title'] . $title . $args['after_title'];

		echo '<table><thead>Курс валют НБУ</thead>';
		echo "<tbody><tr><td>Доллар США</td><td>{$this->w_mass_valut['usd_nbu']}</td></tr>";
		echo "<tr><td>Євро</td><td>{$this->w_mass_valut['eur_nbu']}</tr>";
		echo "<tr><td>Російський рубль</td><td>{$this->w_mass_valut['rub_nbu']}</td></tr></tbody></table>";
		echo '<br />';
		echo '<table><thead>Курс валют Приватбанк</thead>';
		echo "<tbody><tr><td>Доллар США</td><td>{$this->w_mass_valut['usd_privat']}</td></tr>";
		echo "<tr><td>Євро</td><td>{$this->w_mass_valut['eur_privat']}</tr>";
		echo "<tr><td>Російський рубль</td><td>{$this->w_mass_valut['rur_privat']}</td></tr></tbody></table>";

		echo $args['after_widget'];
	}

	/**
	 * Зберігаємо настройки віджета. Тут дані повинні бути очищені і повернуті для збереження в базу даних.
	 * 
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance нові настройки
	 * @param array $old_instance попередні настройки
	 *
	 * @return array дані які будуть збережені
	 */
	function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}

	/**
	 * Адмін-частина віджета
	 *
	 * @param array $instance збережені дані з настройок
	 */
	function form( $instance ) {
		$title = @ $instance['title'] ?: 'Заголовок за замовчуванням';

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
	}
} // кінець класу PS_Widget

/* Реєстрація класу PS_Widget в WordPress */
add_action( 'widgets_init', 'ps_register_widgets' );
function ps_register_widgets() {
	register_widget( 'PS_Widget' );
}
