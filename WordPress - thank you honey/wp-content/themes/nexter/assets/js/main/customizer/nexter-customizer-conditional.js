/**
 * Customizer controls conditional
 *
 * @package	Nexter
 * @since	1.0.0
 */
(function ($) {
    'use strict';

    var api = wp.customize;

    var nexterConditional = {

        controls: {},

        init: function () {
            var $this = this;
            $this.checkAllConditional();
            $this.sectionsConditions();

            api.bind('change', function ( option, data ) {

                var check = false;

				$.each(nexter.config, function (index, val) {

					if( !_.isUndefined( val.conditions ) ) {

						var conditions = val.conditions;

						$.each( conditions, function (index, value) {

							var control = value[0];

							if( option.id == control ) {
								check = true;
								return;
							}
						});

					} else {

						var control = val[0];

						if( option.id == control ) {
							check = true;
							return;
						}
					}

				});

                if( check ) {
                    
                    $this.checkAllConditional();
                    $this.sectionsConditions();
                    
                }
            });
        },

        checkAllConditional: function () {
            var $this = this;
            var values = api.get();
            $this.inspect_controls = {};

            _.each(values, function (value, option) {
                var control = api.control(option);

                $this.checkVisibleControls( control, option );

            });
        },

        checkVisibleControls: function (control, option) {

            var $this = this;
            var getValues = api.get();

            if ( !_.isUndefined( control ) ) {

				if ( typeof nexter.config[option] != 'undefined' ) {
					var display = false,
						optionField = nexter.config[option],
						operator = (!_.isUndefined(optionField.operator)) ? optionField.operator : 'AND',
						conditions = (!_.isUndefined(optionField.conditions)) ? optionField.conditions : optionField;

					if ( typeof conditions !== 'undefined' ) {
						display = $this.checkConditions(conditions, getValues, operator);

						this.inspect_controls[option] = display;

						if (!display) {
							control.container.addClass('nxt-hide');
						} else {
							control.container.removeClass('nxt-hide');
						}
					}
				}
            }
        },
		
		sectionsConditions: function () {

			$('ul.accordion-section.control-section-nxt_section').each(function () {

                var sectionId = $(this).attr('id'),
					controls = $(this).find(' > .customize-control'),
					control_sec = $('.control-section[aria-owns="' + sectionId + '"]'),
					visibleControl = false;

                if ( controls.length > 0 ) {

                    controls.each(function () {

                        if ( $(this).css('display') != 'none' && ! $(this).hasClass('nxt-hide') ) {
                            visibleControl = true;
                        }
                    });

                    if (!visibleControl) {
                        control_sec.addClass('nxt-hide');
                    } else {
                        control_sec.removeClass('nxt-hide');
                    }
                }
            });
        },
		
        checkConditions: function (conditions, values, compare_operator) {

            var $this = this,
				current_cond = conditions[0],
				check = true,
				defaultNow = false;

            if ( _.isString( current_cond ) ) {
				//Single Conditions
                var cond = conditions[1],
					cond_val = conditions[2],
					value;

                if ( !_.isUndefined( nexter.config[current_cond] ) ) {

					var operator = (!_.isUndefined(nexter.config[current_cond]['operator'])) ? nexter.config[current_cond]['operator'] : 'AND',
						conditions = (!_.isUndefined(nexter.config[current_cond]['conditions'])) ? nexter.config[current_cond]['conditions'] : nexter.config[current_cond];
                    

                    if ( !_.isUndefined( conditions ) ) {

                        if ( ! $this.checkConditions( conditions, values, operator ) ) {
                            defaultNow = true;
                            check = false;
                            if( compare_operator == 'AND' ) {
                                return;
                            }
                        } else {
                            var controlObj = api.control(current_cond);
                            controlObj.container.removeClass('nxt-hide');
                        }
                    }
                }

                if ( !_.isUndefined( values[current_cond] ) && !defaultNow && check ) {
                    value = values[current_cond];
                    check = $this.conditionCompareVal( value, cond, cond_val );
                }
                

            } else if ( _.isArray( current_cond ) ) {
				//Array Multiple Conditions
                $.each( conditions, function ( index, val ) {

                    var cond_key = val[0];
                    var cond_cond = val[1];
                    var cond_val = val[2];
                    var currentValue = (!_.isUndefined( values[cond_key] )) ? values[cond_key] : ''; 

                    if ( typeof nexter.config[cond_key] !== 'undefined' ) {
						var operator = (!_.isUndefined(nexter.config[cond_key]['operator'])) ? nexter.config[cond_key]['operator'] : 'AND',
							conditions = (!_.isUndefined(nexter.config[cond_key]['conditions'])) ? nexter.config[cond_key]['conditions'] : nexter.config[cond_key];

                        if ( !_.isUndefined( conditions ) ) {

                            if ( ! $this.checkConditions( conditions, values, operator ) ) {
								check = false;
                                if( compare_operator == 'AND' ) {
                                    return;
                                }
                            } else {
                                check = true;
                                var controlObj = api.control(cond_key);
                                controlObj.container.removeClass('nxt-hide');
                            }
                        }
                    } else {
                        check = true;
                    }

                    if( check ) {
                        if ( compare_operator == 'AND' ) {
                            if ( ! $this.conditionCompareVal( currentValue, cond_cond, cond_val ) ) {
                                check = false;
                                return false;
                            }
                        } else {
                            if ( $this.conditionCompareVal( currentValue, cond_cond, cond_val ) ) {
                                defaultNow = true;
                                check = true;
                            } else {
                                check = false;
                            }
                        }
                    }
                });

                if ( defaultNow && compare_operator == 'OR' ) {
                    check = true;
                }
            }

            return check;
        },

        conditionCompareVal: function (currentValue, cond, value2) {
            var display = false;
			if(cond == '==='){
				display = (currentValue === value2) ? true : false;
			}else if(cond == '>'){
				display = (currentValue > value2) ? true : false;
			}else if(cond == '>='){
				display = (currentValue >= value2) ? true : false;
			}else if(cond == '<'){
				display = (currentValue < value2) ? true : false;
			}else if(cond == '<='){
				display = (currentValue <= value2) ? true : false;
			}else if(cond == '!='){
				display = (currentValue != value2) ? true : false;
			}else if(cond == 'empty'){
				var cloneVal = _.clone(currentValue);
				if (_.isObject(cloneVal) || _.isArray(cloneVal)) {
					_.each(cloneVal, function (val, i) {
						if (_.isEmpty(val)) {
							delete cloneVal[i];
						}
					});
					display = (_.isEmpty(cloneVal)) ? true : false;
				} else {
					display = (_.isNull(cloneVal) || cloneVal == '') ? true : false;
				}
			}else if(cond == 'not_empty'){
				var cloneVal = _.clone(currentValue);
				if (_.isObject(cloneVal) || _.isArray(cloneVal)) {
					_.each(cloneVal, function (val, i) {
						if (_.isEmpty(val)) {
							delete cloneVal[i];
						}
					})
				}
				display = _.isEmpty(cloneVal) ? false : true;
			}else if(cond == 'contains'){
				if (_.isArray(currentValue)) {
					if ($.inArray(value2, currentValue) !== -1) {
						display = true;
					}
				}
			}else{
				if (_.isArray(value2)) {
					if (!_.isEmpty(value2) && !_.isEmpty(currentValue)) {
						display = _.contains(value2, currentValue);
					} else {
						display = false;
					}
				} else {
					display = (currentValue == value2) ? true : false;
				}
			}
			
            return display;
        },
    };

    $(function () { nexterConditional.init(); });

})(jQuery);