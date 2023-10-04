( function( api ) {

	// Extends our custom "portfoliox-pro" section.
	api.sectionConstructor['portfoliox-pro'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
