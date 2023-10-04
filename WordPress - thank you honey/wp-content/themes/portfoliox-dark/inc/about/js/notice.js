;(function($){
	$(document).ready(function(){
		$('.btnend').on('click',function(){
			var url = new URL(location.href);
			url.searchParams.append('xbnotice',1);
			location.href= url;
		});
	});
})(jQuery);