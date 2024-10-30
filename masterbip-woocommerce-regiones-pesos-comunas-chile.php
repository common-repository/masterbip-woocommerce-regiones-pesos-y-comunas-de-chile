<?php
/**
* Plugin Name: MasterBip Regiones Comunas y Pesos de Chile
* Plugin URI: https://www.masterbip.cl
* Description: Plugin para agregar REGIONES, COMUNAS y PESOS de CHILE a Woocommerce, y su correcta compatibilidad con Paypal.
* Version: 1.2

* Author: MasterBip
* Author URI: https://www.masterbip.cl/
* Requires at least: 4.0+
* Tested up to: 5.8
* WC requires at least: 3.0.x
* WC tested up to: 4.0.1
*
* Text Domain: masterbip
*
* License: GPLv3
*
* MasterBip Regiones Comunas y Pesos de Chile free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* any later version.
*
* MasterBip Regiones Comunas y Pesos de Chile is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
*/

// Agregamos pesos Chilenos
function mb_woo_add_pesos_chilenos_currency($currencies) {
    $currencies["CLP"] = 'Pesos Chilenos';
    return $currencies;
}
add_filter('woocommerce_currencies', 'mb_woo_add_pesos_chilenos_currency', 10, 1);

// Agregamos simbolo de pesos Chilenos
function mb_woo_pesos_chilenos_symbol($currency_symbol, $currency) {
    switch ($currency) {
        case 'CLP': $currency_symbol = '$';
            break;
    }
    return $currency_symbol;
}
add_filter('woocommerce_currency_symbol', 'mb_woo_pesos_chilenos_symbol', 10, 2);

// Habilitamos Pesos Chilenos como válidos para Paypal
function mb_woo_pesos_chilenos_valid_paypal_currency($currencies) {
    array_push($currencies, 'CLP');
    return $currencies;
}
add_filter('woocommerce_paypal_supported_currencies', 'mb_woo_pesos_chilenos_valid_paypal_currency');


// Cambiamos Label Comuna
function mb_woo_cambiamos_label($address_fields){
    $address_fields['city']['label']='Comuna';
    return $address_fields;
}
add_filter('woocommerce_default_address_fields','mb_woo_cambiamos_label');

// Agregamos las comunas
function mb_woo_comunas_en_city_field( $fields ) {
	$city_args = wp_parse_args( array(
		'type' => 'select',
		'options' => array(
			'Algarrobo'=>'Algarrobo',
			'Alhué'=>'Alhué',
			'Alto Biobío'=>'Alto Biobío',
			'Alto del Carmen'=>'Alto del Carmen',
			'Alto Hospicio'=>'Alto Hospicio',
			'Ancud'=>'Ancud',
			'Andacollo'=>'Andacollo',
			'Angol'=>'Angol',
			'Antártica'=>'Antártica',
			'Antofagasta'=>'Antofagasta',
			'Antuco'=>'Antuco',
			'Arauco'=>'Arauco',
			'Arica'=>'Arica',
			'Aysén'=>'Aysén',
			'Buin'=>'Buin',
			'Bulnes'=>'Bulnes',
			'Cabildo'=>'Cabildo',
			'Cabo de Hornos'=>'Cabo de Hornos',
			'Cabrero'=>'Cabrero',
			'Calama'=>'Calama',
			'Calbuco'=>'Calbuco',
			'Caldera'=>'Caldera',
			'Calera de Tango'=>'Calera de Tango',
			'Calle Larga'=>'Calle Larga',
			'Camarones'=>'Camarones',
			'Camiña'=>'Camiña',
			'Canela'=>'Canela',
			'Cañete'=>'Cañete',
			'Carahue'=>'Carahue',
			'Cartagena'=>'Cartagena',
			'Casablanca'=>'Casablanca',
			'Castro'=>'Castro',
			'Catemu'=>'Catemu',
			'Cauquenes'=>'Cauquenes',
			'Cerrillos'=>'Cerrillos',
			'Cerro Navia'=>'Cerro Navia',
			'Chaitén'=>'Chaitén',
			'Chanco'=>'Chanco',
			'Chañaral'=>'Chañaral',
			'Chépica'=>'Chépica',
			'Chiguayante'=>'Chiguayante',
			'Chile Chico'=>'Chile Chico',
			'Chillán'=>'Chillán',
			'Chillán Viejo'=>'Chillán Viejo',
			'Chimbarongo'=>'Chimbarongo',
			'Cholchol'=>'Cholchol',
			'Chonchi'=>'Chonchi',
			'Cisnes'=>'Cisnes',
			'Cobquecura'=>'Cobquecura',
			'Cochamó'=>'Cochamó',
			'Cochrane'=>'Cochrane',
			'Codegua'=>'Codegua',
			'Coelemu'=>'Coelemu',
			'Coihueco'=>'Coihueco',
			'Coinco'=>'Coinco',
			'Colbún'=>'Colbún',
			'Colchane'=>'Colchane',
			'Colina'=>'Colina',
			'Collipulli'=>'Collipulli',
			'Coltauco'=>'Coltauco',
			'Combarbalá'=>'Combarbalá',
			'Concepción'=>'Concepción',
			'Conchalí'=>'Conchalí',
			'Concón'=>'Concón',
			'Constitución'=>'Constitución',
			'Contulmo'=>'Contulmo',
			'Copiapó'=>'Copiapó',
			'Coquimbo'=>'Coquimbo',
			'Coronel'=>'Coronel',
			'Corral'=>'Corral',
			'Coyhaique'=>'Coyhaique',
			'Cunco'=>'Cunco',
			'Curacautín'=>'Curacautín',
			'Curacaví'=>'Curacaví',
			'Curaco de Vélez'=>'Curaco de Vélez',
			'Curanilahue'=>'Curanilahue',
			'Curarrehue'=>'Curarrehue',
			'Curepto'=>'Curepto',
			'Curicó'=>'Curicó',
			'Dalcahue'=>'Dalcahue',
			'Diego de Almagro'=>'Diego de Almagro',
			'Doñihue'=>'Doñihue',
			'El Bosque'=>'El Bosque',
			'El Carmen'=>'El Carmen',
			'El Monte'=>'El Monte',
			'El Quisco'=>'El Quisco',
			'El Tabo'=>'El Tabo',
			'Empedrado'=>'Empedrado',
			'Ercilla'=>'Ercilla',
			'Estación Central'=>'Estación Central',
			'Florida'=>'Florida',
			'Freire'=>'Freire',
			'Freirina'=>'Freirina',
			'Fresia'=>'Fresia',
			'Frutillar'=>'Frutillar',
			'Futaleufú'=>'Futaleufú',
			'Futrono'=>'Futrono',
			'Galvarino'=>'Galvarino',
			'General Lagos'=>'General Lagos',
			'Gorbea'=>'Gorbea',
			'Graneros'=>'Graneros',
			'Guaitecas'=>'Guaitecas',
			'Hijuelas'=>'Hijuelas',
			'Hualaihué'=>'Hualaihué',
			'Hualañé'=>'Hualañé',
			'Hualpén'=>'Hualpén',
			'Hualqui'=>'Hualqui',
			'Huara'=>'Huara',
			'Huasco'=>'Huasco',
			'Huechuraba'=>'Huechuraba',
			'Illapel'=>'Illapel',
			'Independencia'=>'Independencia',
			'Iquique'=>'Iquique',
			'Isla de Maipo'=>'Isla de Maipo',
			'Isla de Pascua'=>'Isla de Pascua',
			'Juan Fernández'=>'Juan Fernández',
			'La Calera'=>'La Calera',
			'La Cisterna'=>'La Cisterna',
			'La Cruz'=>'La Cruz',
			'La Estrella'=>'La Estrella',
			'La Florida'=>'La Florida',
			'La Granja'=>'La Granja',
			'La Higuera'=>'La Higuera',
			'La Ligua'=>'La Ligua',
			'La Pintana'=>'La Pintana',
			'La Reina'=>'La Reina',
			'La Serena'=>'La Serena',
			'La Unión'=>'La Unión',
			'Lago Ranco'=>'Lago Ranco',
			'Lago Verde'=>'Lago Verde',
			'Laguna Blanca'=>'Laguna Blanca',
			'Laja'=>'Laja',
			'Lampa'=>'Lampa',
			'Lanco'=>'Lanco',
			'Las Cabras'=>'Las Cabras',
			'Las Condes'=>'Las Condes',
			'Lautaro'=>'Lautaro',
			'Lebu'=>'Lebu',
			'Licantén'=>'Licantén',
			'Limache'=>'Limache',
			'Linares'=>'Linares',
			'Litueche'=>'Litueche',
			'Llanquihue'=>'Llanquihue',
			'Llay-Llay'=>'Llay-Llay',
			'Lo Barnechea'=>'Lo Barnechea',
			'Lo Espejo'=>'Lo Espejo',
			'Lo Prado'=>'Lo Prado',
			'Lolol'=>'Lolol',
			'Loncoche'=>'Loncoche',
			'Longaví'=>'Longaví',
			'Lonquimay'=>'Lonquimay',
			'Los Álamos'=>'Los Álamos',
			'Los Andes'=>'Los Andes',
			'Los Ángeles'=>'Los Ángeles',
			'Los Lagos'=>'Los Lagos',
			'Los Muermos'=>'Los Muermos',
			'Los Sauces'=>'Los Sauces',
			'Los Vilos'=>'Los Vilos',
			'Lota'=>'Lota',
			'Lumaco'=>'Lumaco',
			'Machalí'=>'Machalí',
			'Macul'=>'Macul',
			'Máfil'=>'Máfil',
			'Maipú'=>'Maipú',
			'Malloa'=>'Malloa',
			'Marchihue'=>'Marchihue',
			'María Elena'=>'María Elena',
			'María Pinto'=>'María Pinto',
			'Mariquina'=>'Mariquina',
			'Maule'=>'Maule',
			'Maullín'=>'Maullín',
			'Mejillones'=>'Mejillones',
			'Melipeuco'=>'Melipeuco',
			'Melipilla'=>'Melipilla',
			'Molina'=>'Molina',
			'Monte Patria'=>'Monte Patria',
			'Mostazal'=>'Mostazal',
			'Mulchén'=>'Mulchén',
			'Nacimiento'=>'Nacimiento',
			'Nancagua'=>'Nancagua',
			'Natales'=>'Natales',
			'Navidad'=>'Navidad',
			'Negrete'=>'Negrete',
			'Ninhue'=>'Ninhue',
			'Nogales'=>'Nogales',
			'Nueva Imperial'=>'Nueva Imperial',
			'Ñiquén'=>'Ñiquén',
			'Ñuñoa'=>'Ñuñoa',
			'O\'Higgins'=>'O\'Higgins',
			'Olivar'=>'Olivar',
			'Ollagüe'=>'Ollagüe',
			'Olmué'=>'Olmué',
			'Osorno'=>'Osorno',
			'Ovalle'=>'Ovalle',
			'Padre Hurtado'=>'Padre Hurtado',
			'Padre Las Casas'=>'Padre Las Casas',
			'Paihuano'=>'Paihuano',
			'Paillaco'=>'Paillaco',
			'Paine'=>'Paine',
			'Palena'=>'Palena',
			'Palmilla'=>'Palmilla',
			'Panguipulli'=>'Panguipulli',
			'Panquehue'=>'Panquehue',
			'Papudo'=>'Papudo',
			'Paredones'=>'Paredones',
			'Parral'=>'Parral',
			'Pedro Aguirre Cerda'=>'Pedro Aguirre Cerda',
			'Pelarco'=>'Pelarco',
			'Pelluhue'=>'Pelluhue',
			'Pemuco'=>'Pemuco',
			'Pencahue'=>'Pencahue',
			'Penco'=>'Penco',
			'Peñaflor'=>'Peñaflor',
			'Peñalolén'=>'Peñalolén',
			'Peralillo'=>'Peralillo',
			'Perquenco'=>'Perquenco',
			'Petorca'=>'Petorca',
			'Peumo'=>'Peumo',
			'Pica'=>'Pica',
			'Pichidegua'=>'Pichidegua',
			'Pichilemu'=>'Pichilemu',
			'Pinto'=>'Pinto',
			'Pirque'=>'Pirque',
			'Pitrufquén'=>'Pitrufquén',
			'Placilla'=>'Placilla',
			'Portezuelo'=>'Portezuelo',
			'Porvenir'=>'Porvenir',
			'Pozo Almonte'=>'Pozo Almonte',
			'Primavera'=>'Primavera',
			'Providencia'=>'Providencia',
			'Puchuncaví'=>'Puchuncaví',
			'Pucón'=>'Pucón',
			'Pudahuel'=>'Pudahuel',
			'Puente Alto'=>'Puente Alto',
			'Puerto Montt'=>'Puerto Montt',
			'Puerto Octay'=>'Puerto Octay',
			'Puerto Varas'=>'Puerto Varas',
			'Pumanque'=>'Pumanque',
			'Punitaqui'=>'Punitaqui',
			'Punta Arenas'=>'Punta Arenas',
			'Puqueldón'=>'Puqueldón',
			'Purén'=>'Purén',
			'Purranque'=>'Purranque',
			'Putaendo'=>'Putaendo',
			'Putre'=>'Putre',
			'Puyehue'=>'Puyehue',
			'Queilén'=>'Queilén',
			'Quellón'=>'Quellón',
			'Quemchi'=>'Quemchi',
			'Quilaco'=>'Quilaco',
			'Quilicura'=>'Quilicura',
			'Quilleco'=>'Quilleco',
			'Quillón'=>'Quillón',
			'Quillota'=>'Quillota',
			'Quilpué'=>'Quilpué',
			'Quinchao'=>'Quinchao',
			'Quinta de Tilcoco'=>'Quinta de Tilcoco',
			'Quinta Normal'=>'Quinta Normal',
			'Quintero'=>'Quintero',
			'Quirihue'=>'Quirihue',
			'Rancagua'=>'Rancagua',
			'Ránquil'=>'Ránquil',
			'Rauco'=>'Rauco',
			'Recoleta'=>'Recoleta',
			'Renaico'=>'Renaico',
			'Renca'=>'Renca',
			'Rengo'=>'Rengo',
			'Requínoa'=>'Requínoa',
			'Retiro'=>'Retiro',
			'Rinconada'=>'Rinconada',
			'Río Bueno'=>'Río Bueno',
			'Río Claro'=>'Río Claro',
			'Río Hurtado'=>'Río Hurtado',
			'Río Ibáñez'=>'Río Ibáñez',
			'Río Negro'=>'Río Negro',
			'Río Verde'=>'Río Verde',
			'Romeral'=>'Romeral',
			'Saavedra'=>'Saavedra',
			'Sagrada Familia'=>'Sagrada Familia',
			'Salamanca'=>'Salamanca',
			'San Antonio'=>'San Antonio',
			'San Bernardo'=>'San Bernardo',
			'San Carlos'=>'San Carlos',
			'San Clemente'=>'San Clemente',
			'San Esteban'=>'San Esteban',
			'San Fabián'=>'San Fabián',
			'San Felipe'=>'San Felipe',
			'San Fernando'=>'San Fernando',
			'San Gregorio'=>'San Gregorio',
			'San Ignacio'=>'San Ignacio',
			'San Javier'=>'San Javier',
			'San Joaquín'=>'San Joaquín',
			'San José de Maipo'=>'San José de Maipo',
			'San Juan de la Costa'=>'San Juan de la Costa',
			'San Miguel'=>'San Miguel',
			'San Nicolás'=>'San Nicolás',
			'San Pablo'=>'San Pablo',
			'San Pedro'=>'San Pedro',
			'San Pedro de Atacama'=>'San Pedro de Atacama',
			'San Pedro de La Paz'=>'San Pedro de La Paz',
			'San Rafael'=>'San Rafael',
			'San Ramón'=>'San Ramón',
			'San Rosendo'=>'San Rosendo',
			'San Vicente'=>'San Vicente',
			'Santa Bárbara'=>'Santa Bárbara',
			'Santa Cruz'=>'Santa Cruz',
			'Santa Juana'=>'Santa Juana',
			'Santa María'=>'Santa María',
			'Santiago'=>'Santiago',
			'Santo Domingo'=>'Santo Domingo',
			'Sierra Gorda'=>'Sierra Gorda',
			'Talagante'=>'Talagante',
			'Talca'=>'Talca',
			'Talcahuano'=>'Talcahuano',
			'Taltal'=>'Taltal',
			'Temuco'=>'Temuco',
			'Teno'=>'Teno',
			'Teodoro Schmidt'=>'Teodoro Schmidt',
			'Tierra Amarilla'=>'Tierra Amarilla',
			'Til Til'=>'Til Til',
			'Timaukel'=>'Timaukel',
			'Tirúa'=>'Tirúa',
			'Tocopilla'=>'Tocopilla',
			'Toltén'=>'Toltén',
			'Tomé'=>'Tomé',
			'Torres del Paine'=>'Torres del Paine',
			'Tortel'=>'Tortel',
			'Traiguén'=>'Traiguén',
			'Treguaco'=>'Treguaco',
			'Tucapel'=>'Tucapel',
			'Valdivia'=>'Valdivia',
			'Vallenar'=>'Vallenar',
			'Valparaíso'=>'Valparaíso',
			'Vichuquén'=>'Vichuquén',
			'Victoria'=>'Victoria',
			'Vicuña'=>'Vicuña',
			'Vilcún'=>'Vilcún',
			'Villa Alegre'=>'Villa Alegre',
			'Villa Alemana'=>'Villa Alemana',
			'Villarrica'=>'Villarrica',
			'Viña del Mar'=>'Viña del Mar',
			'Vitacura'=>'Vitacura',
			'Yerbas Buenas'=>'Yerbas Buenas',
			'Yumbel'=>'Yumbel',
			'Yungay'=>'Yungay',
			'Zapallar'=>'Zapallar',
		),
	), $fields['shipping']['shipping_city'] );

	$fields['shipping']['shipping_city'] = $city_args; // Para Envío
	$fields['billing']['billing_city'] = $city_args; // Para Comprobante

	wc_enqueue_js("
	$(document).ready(function() {
		$('#billing_city').select2();
	});
	");

	return $fields;

}
add_filter( 'woocommerce_checkout_fields', 'mb_woo_comunas_en_city_field' );


// Regiones de Chile
function mb_woo_regiones_en_states($states) {
    $states['CL'] = array(
        'Tarapacá' => 'Tarapacá',
        'Antofagasta' => 'Antofagasta',
        'Atacama' => 'Atacama',
        'Coquimbo' => 'Coquimbo',
        'Valparaíso' => 'Valparaíso',
        'Libertador General Bernardo O’Higgins' => 'Libertador General Bernardo O’Higgins',
        'Maule' => 'Maule',
        'Bío Bío' => 'Bío Bío',
        'Araucanía' => 'Araucanía',
        'Los Lagos' => 'Los Lagos',
        'Aysén del General Carlos Ibáñez del Campo' => 'Aysén del General Carlos Ibáñez del Campo',
        'Magallanes y Antártica Chilena' => 'Magallanes y Antártica Chilena',
        'Metropolitana de Santiago' => 'Metropolitana de Santiago',
        'Los Ríos' => 'Los Ríos',
        'Arica y Parinacota' => 'Arica y Parinacota',
        'Ñuble' => 'Ñuble'
    );
    return $states;
}
add_filter('woocommerce_states', 'mb_woo_regiones_en_states');

// Labels de Regiones
function mb_woo_cambiamos_fields_para_regiones( $fields ) {

	$fields['billing']['billing_state']['placeholder'] = 'Seleccione una Región';
	$fields['billing']['billing_state']['label'] = 'Región';

	$fields['shipping']['shipping_state']['placeholder'] = 'Seleccione una Región';
	$fields['shipping']['shipping_state']['label'] = 'Región';

	return $fields;
}
add_filter('woocommerce_checkout_fields' , 'mb_woo_cambiamos_fields_para_regiones');


// Codigo postal NO OBLIGATORIO
function mb_zip_no_obligatorio($address_fields) {
    $address_fields['postcode']['required'] = false;
    return $address_fields;
}
add_filter('woocommerce_default_address_fields', 'mb_zip_no_obligatorio');

// Codigo postal OCULTO
function mb_woo_hide_zip($fields){
	unset($fields['billing']['billing_postcode']); // Para Envío
	unset($fields['shipping']['shipping_postcode']); // Para Comprobante
	return $fields;
}
add_filter( 'woocommerce_checkout_fields' , 'mb_woo_hide_zip' );