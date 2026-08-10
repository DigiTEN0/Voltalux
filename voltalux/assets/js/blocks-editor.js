/**
 * Voltalux editable blocks — editor UI.
 *
 * Dynamic (server-rendered) blocks: the editor shows a live preview via
 * ServerSideRender (the real theme markup) and the content is edited through
 * simple sidebar fields. No build step — uses the wp.* globals WordPress ships.
 *
 * @package Voltalux
 */
( function ( wp ) {
	'use strict';

	if ( ! wp || ! wp.blocks || ! wp.element ) {
		return;
	}

	var el = wp.element.createElement;
	var __ = ( wp.i18n && wp.i18n.__ ) ? wp.i18n.__ : function ( s ) { return s; };
	var registerBlockType = wp.blocks.registerBlockType;
	var InspectorControls = wp.blockEditor.InspectorControls;
	var useBlockProps = wp.blockEditor.useBlockProps;
	var cmp = wp.components;
	var PanelBody = cmp.PanelBody;
	var TextControl = cmp.TextControl;
	var TextareaControl = cmp.TextareaControl;
	var SelectControl = cmp.SelectControl;
	var ToggleControl = cmp.ToggleControl;
	var ServerSideRender = wp.serverSideRender;

	registerBlockType( 'voltalux/section', {
		apiVersion: 2,
		title: __( 'Voltalux — Sectie', 'voltalux' ),
		category: 'voltalux',
		icon: 'layout',
		description: __( 'Bewerkbare pagina-sectie (tekst, vergelijking, kaarten, accent-band).', 'voltalux' ),
		supports: { html: false, reusable: false },
		attributes: {
			type: { type: 'string', default: 'text' },
			eyebrow: { type: 'string', default: '' },
			title: { type: 'string', default: '' },
			lead: { type: 'string', default: '' },
			paras: { type: 'string', default: '' },
			list: { type: 'string', default: '' },
			cols: { type: 'string', default: '' },
			items: { type: 'string', default: '' },
			price: { type: 'string', default: '' },
			sid: { type: 'string', default: '' },
			icon: { type: 'string', default: '' },
			cta: { type: 'boolean', default: false },
			alt: { type: 'string', default: '' }
		},

		edit: function ( props ) {
			var a = props.attributes;
			var set = function ( key ) {
				return function ( value ) {
					var patch = {};
					patch[ key ] = value;
					props.setAttributes( patch );
				};
			};
			var blockProps = useBlockProps ? useBlockProps() : {};

			var typeOptions = [
				{ label: __( 'Tekst (2-koloms)', 'voltalux' ), value: 'text' },
				{ label: __( 'Vergelijking', 'voltalux' ), value: 'compare' },
				{ label: __( 'Kaarten', 'voltalux' ), value: 'cards' },
				{ label: __( 'Veelgestelde vragen', 'voltalux' ), value: 'accordion' },
				{ label: __( 'Accent-band (donker)', 'voltalux' ), value: 'feature' }
			];

			var controls = [
				el( SelectControl, {
					key: 'type',
					label: __( 'Type sectie', 'voltalux' ),
					value: a.type,
					options: typeOptions,
					onChange: set( 'type' )
				} ),
				el( TextControl, { key: 'eyebrow', label: __( 'Bovenkopje (eyebrow)', 'voltalux' ), value: a.eyebrow, onChange: set( 'eyebrow' ) } ),
				el( TextControl, { key: 'title', label: __( 'Kop (H2)', 'voltalux' ), value: a.title, onChange: set( 'title' ) } ),
				el( TextareaControl, { key: 'lead', label: __( 'Introtekst', 'voltalux' ), value: a.lead, onChange: set( 'lead' ) } ),
				el( TextareaControl, {
					key: 'paras',
					label: __( 'Alinea’s', 'voltalux' ),
					help: __( 'Eén alinea per regel.', 'voltalux' ),
					value: a.paras,
					onChange: set( 'paras' )
				} ),
				el( TextareaControl, {
					key: 'list',
					label: __( 'Opsomming (vinkjes)', 'voltalux' ),
					help: __( 'Eén punt per regel.', 'voltalux' ),
					value: a.list,
					onChange: set( 'list' )
				} ),
				el( ToggleControl, { key: 'cta', label: __( 'Toon “Vraag advies aan”-knop', 'voltalux' ), checked: !! a.cta, onChange: set( 'cta' ) } )
			];

			var advanced = [
				el( TextControl, { key: 'sid', label: __( 'Anker-ID (optioneel)', 'voltalux' ), value: a.sid, onChange: set( 'sid' ) } ),
				el( TextControl, { key: 'icon', label: __( 'Icoon-naam (optioneel)', 'voltalux' ), value: a.icon, onChange: set( 'icon' ) } ),
				el( TextareaControl, {
					key: 'cols',
					label: __( 'Vergelijking (data, JSON)', 'voltalux' ),
					help: __( 'Alleen voor type “Vergelijking”. Laat met rust als je twijfelt.', 'voltalux' ),
					value: a.cols,
					onChange: set( 'cols' )
				} ),
				el( TextareaControl, {
					key: 'items',
					label: __( 'Kaarten / vragen (data, JSON)', 'voltalux' ),
					help: __( 'Alleen voor type “Kaarten” of “Veelgestelde vragen”.', 'voltalux' ),
					value: a.items,
					onChange: set( 'items' )
				} ),
				el( TextareaControl, {
					key: 'price',
					label: __( 'Prijs-chips (data, JSON)', 'voltalux' ),
					value: a.price,
					onChange: set( 'price' )
				} )
			];

			return el(
				'div',
				blockProps,
				el(
					InspectorControls,
					{ key: 'inspector' },
					el( PanelBody, { key: 'content', title: __( 'Inhoud', 'voltalux' ), initialOpen: true }, controls ),
					el( PanelBody, { key: 'advanced', title: __( 'Geavanceerd', 'voltalux' ), initialOpen: false }, advanced )
				),
				ServerSideRender
					? el( ServerSideRender, { key: 'preview', block: 'voltalux/section', attributes: a } )
					: el( 'p', { key: 'ph' }, __( 'Voltalux-sectie', 'voltalux' ) )
			);
		},

		save: function () {
			return null; // Dynamic block — rendered in PHP.
		}
	} );
} )( window.wp );
