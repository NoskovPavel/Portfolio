(function( $ ) {
	'use strict';
	var afwp_accordion={

		Snipits: {

			Shortcode_Generator(formData){
				var formValues = {};
				for(var i=0; i<formData.length; i++){
					formValues[formData[i].name] = formData[i].value;
				}
				var shortcodes = '[';
				shortcodes += formValues.afwp_tab_or_accordion;
				switch(formValues.afwp_tab_or_accordion){
					case "afwp_tab":
						delete formValues.afwp_active_dp_icon;
						$('#afwp_active_dp_icon').closest('.afwp-field-container').css('display', 'none');
						break;
					case "afwp_accordion":
						$('#afwp_active_dp_icon').closest('.afwp-field-container').css('display', 'table-row');
						break;
					default:
						break;

				}

				delete formValues.afwp_tab_or_accordion;

				for(var key in formValues){
					if(formValues[key]){
						shortcodes += ' '+key+'="' + formValues[key] + '"';
					}
				}
				shortcodes += ']';
				
				console.log(formValues);
				$('.afwp_generated_shortcode').html(shortcodes);
			},

			Color_Icon_Picker: function(){
				var colorpicker, icon_picker;
				colorpicker = {
					change: function(evt, ui){
						$(evt.target).val(ui.color.toString()).trigger('change');
					}
				};
				icon_picker = {
					hideOnSelect: true
				};

				$('.widget-liquid-right .afwp_color_picker, .afwp_generater_wraper .afwp_color_picker').wpColorPicker(colorpicker);
				$('.afwp_icon_picker').iconpicker(icon_picker);
				$(document).on('widget-updated widget-added', function(e, widget){
                	widget.find('.afwp_color_picker').wpColorPicker(colorpicker);
                	widget.find('.afwp_icon_picker').iconpicker(icon_picker);

            	}); 

            	$(document).on('widget-added', function(e, widget){
                	widget.find('.afwp-widget-post-type').trigger('change');

            	}); 

            	$(document).on('iconpickerSelected', '.afwp_icon_picker', function(event){
  					$(this).trigger('change');
				});

				$(document).on('change', '.afwp_icon_picker', function(){

					var previous_class, current_class, has_attr, afwp_icon;
					current_class	= this.value;
					afwp_icon = $(this).siblings('.afwp_icon');
					has_attr = $(this).attr('data-previous');
					if(has_attr!="undefined"){
						previous_class	= $(this).attr('data-previous');
					}else{
						previous_class	= this.defaultValue;
					}
					$(this).attr('data-previous', current_class);
					afwp_icon.removeClass(previous_class).removeClass(function(idx, cls){
						return (cls.match(/\bfa-\S+/g) || []).join(' ');
					});
					console.log(current_class);
					afwp_icon.addClass(current_class);

				});

			},

			Accordion_Widget: {

				Ajax_Data: function(accordion_data, append_to){
					var accordion_ajax_url = window.location.origin+ajaxurl;
					$.post(accordion_ajax_url,{
							'action': 'afwp_accordion_widget',
							'data':   accordion_data
						},
						function(response){
							var change_html = afwp_accordion.Snipits.Accordion_Widget.Change_Widget_Data;
							change_html(append_to, response);
						}
					);
				},

				Change_Data: function(selector){
					var data, ajax_result,
						append_to=selector.data('accordion-change-id'),
						accordion_widget = afwp_accordion.Snipits.Accordion_Widget;
					data = {
						data_value: selector.val(),
						data_type: selector.data('accordion-value'),
					};
					accordion_widget.Ajax_Data(data, append_to);
				},

				Change_Widget_Data: function(append_to, ajax_result){
					var options, data_obj;
					data_obj=JSON.parse(ajax_result);
					options+='<option value="" selected="selected">No Filter</option>';
					$.each(data_obj, function(key, value){
						options+='<option value="'+value.slug+'">'+value.name+'</option>';
					});
					$(append_to).html(options);
					$(append_to).val('').trigger('change');
				},

			},

		},

		MouseEvents: function(){
			var _this=afwp_accordion, widget=_this.Snipits.Accordion_Widget;
			$(document).on('change', '.afwp-widget-post-type, .afwp-widget-taxonomy', function(evt){
				widget.Change_Data($(this));
			});
			$(document).on('click', '.afwp-tab-list .nav-tab', function(evt){
				if(!$(this).hasClass('nav-tab-active')){
					var tab_wraper, tab_id;
					tab_id = $(this).data('id');
					tab_wraper = $(this).closest('.afwp-tab-wraper');
					$(this).addClass('nav-tab-active').siblings('.nav-tab').removeClass('nav-tab-active');
					tab_wraper.find('.afwp-tab-content').removeClass('afwp-content-active');
					tab_wraper.find(tab_id).addClass('afwp-content-active');
				}
			});
			$('#afwp_generate_button').on('click', function(){
				var formData = $(this).closest('form').serializeArray();
				afwp_accordion.Snipits.Shortcode_Generator(formData);
			});

			$('#afwp_shortcode_generator_form').on('change', function(){
				$('#afwp_generate_button').trigger('click');
			});
		},

		Ready: function(){
			var _this=afwp_accordion;
			_this.Snipits.Color_Icon_Picker();
			_this.MouseEvents();
		},

		Load: function(){
			var _this=afwp_accordion;

		},

		Scroll: function(){
			var _this=afwp_accordion;

		},

		Resize: function(){
			var _this=afwp_accordion;

		},

		Init: function(){
			var ready, load, scroll, resize, _this=afwp_accordion;
			ready=_this.Ready, load=_this.Load, resize=_this.Resize;
			$(document).ready(ready);
			$(window).load(load);
			$(window).resize(resize);
			$(window).scroll(scroll);
		}

	};

	afwp_accordion.Init();


})( jQuery );
